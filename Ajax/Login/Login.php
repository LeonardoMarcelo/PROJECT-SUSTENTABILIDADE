<?php

require_once '../../Developers/Config.php';

$Post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED);
$PostFilters = array_map('strip_tags', $Post);
$pdo = Conn::conectar();
$message = null;

// Dica 1 - Verifica se a origem da requisição é do mesmo domínio da aplicação
if (
    (isset($_SERVER['HTTP_REFERER']) &&
        $_SERVER['HTTP_REFERER'] !=
            'http://localhost/project-sustentabilidade-main/index.php') &&
    $_SERVER['HTTP_REFERER'] != 'http://localhost/project-sustentabilidade-main/'
):
    $message = [
        'status' => 'info',
        'message' => 'Origem da requisição não autorizada!',
        'redirect' => '',
    ];
    echo json_encode($message);
    return;
endif;

//VERIFICA SE O EMAIL É VALIDO

$Email = $PostFilters['login_email'];

if (!$Email || empty($Email)) {
    $message = [
        'status' => 'info',
        'message' => 'Seu email não é válido!',
        'redirect' => '',
    ];
    echo json_encode($message);
    return;
}

// Dica 4 - Verifica se o usuário já excedeu a quantidade de tentativas erradas do dia
$sql =
    'SELECT count(*) AS tentativas, MINUTE(TIMEDIFF(NOW(), MAX(data_hora))) AS minutos ';
$sql .=
    "FROM tab_log_tentativa WHERE ip = ? and DATE_FORMAT(data_hora,'%Y-%m-%d') = ? AND bloqueado = ?";
$stm = $pdo->prepare($sql);
$stm->bindValue(1, $_SERVER['SERVER_ADDR']);
$stm->bindValue(2, date('Y-m-d'));
$stm->bindValue(3, 'SIM');
$stm->execute();
$retorno = $stm->fetch(PDO::FETCH_OBJ);

if (
    !empty($retorno->tentativas) &&
    intval($retorno->minutos) <= MINUTOS_BLOQUEIO
):
    $message = [
        'status' => 'error',
        'message' =>
            'Você excedeu o limite de ' .
            TENTATIVAS_ACEITAS .
            ' tentativas, login bloqueado por ' .
            MINUTOS_BLOQUEIO .
            ' minutos!',
        'redirect' => '',
    ];
    echo json_encode($message);
    return;
endif;

// Dica 5 - Válida os dados do usuário com o banco de dados
$sql = 'SELECT * FROM users WHERE user_email = ?  LIMIT 1';
$stm = $pdo->prepare($sql);
$stm->bindValue(1, $Email);
// $stm->bindValue(2, );
$stm->execute();
$retorno = $stm->fetch(PDO::FETCH_OBJ);

// Dica 6 - Válida a senha utlizando a API Password Hash
if (
    !empty($retorno) &&
    password_verify($PostFilters['login_password'], $retorno->user_password)
):
    //CRIA AS SESSÕES DE ACESSO
    $_SESSION['user_id'] = $retorno->user_id;
    $_SESSION['user_turma_id'] = $retorno->user_turma_id;
    $_SESSION['user_email'] = $retorno->user_email;
    $_SESSION['user_level'] = $retorno->user_level;
    $_SESSION['user_token'] = $retorno->user_token;
    $_SESSION['tentativas'] = 0;
    $_SESSION['logged'] = 1;

    // Dica 7 - Grava a tentativa independente de falha ou não
else:
    $_SESSION['logged'] = 0;
    $_SESSION['tentativas'] = isset($_SESSION['tentativas'])
        ? ($_SESSION['tentativas'] += 1)
        : 1;
    $bloqueado = $_SESSION['tentativas'] == TENTATIVAS_ACEITAS ? 'SIM' : 'NAO';

    $sql =
        'INSERT INTO tab_log_tentativa (ip, email, origem, bloqueado) VALUES (:ip, :email, :origem, :bloqueado)';
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':ip', $_SERVER['SERVER_ADDR']);
    $stm->bindValue(':email', $Email);
    $stm->bindValue('origem', $_SERVER['HTTP_REFERER']);
    $stm->bindValue('bloqueado', $bloqueado);
    $stm->execute();
endif;
// Se logado envia código 1, senão retorna mensagem de erro para o login
if ($_SESSION['logged'] == 1):
    if ($retorno->user_level >=  LEVEL_SUPER) {
        $message = [
            'status' => 'success',
            'message' => 'Login realizado com sucesso aguarde...',
            'redirect' => 'Admin/user_adm/admin.php',
        ];
        echo json_encode($message);
        return;
    } else {
        $message = [
            'status' => 'success',
            'message' => 'Login realizado com sucesso aguarde...',
            'redirect' => 'Admin/user_representante/representante.php',
        ];
        echo json_encode($message);
        return;
    }
else:
    if ($_SESSION['tentativas'] == TENTATIVAS_ACEITAS):
        $message = [
            'status' => 'error',
            'message' =>
                'Você excedeu o limite de ' .
                TENTATIVAS_ACEITAS .
                ' tentativas, login bloqueado por ' .
                MINUTOS_BLOQUEIO .
                ' minutos!',
            'redirect' => '',
        ];
        echo json_encode($message);
        return;
    else:
        $message = [
            'status' => 'warning',
            'message' =>
                'Email ou senha INCORRETOS! ' .
                (TENTATIVAS_ACEITAS - $_SESSION['tentativas']) .
                ' tentativa(s) antes do bloqueio!',
            'redirect' => '',
        ];
        echo json_encode($message);
        return;
    endif;
endif;
