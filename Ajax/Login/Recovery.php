<?php

require_once '../../Developers/Config.php';


$post = filter_input_array(INPUT_POST , FILTER_SANITIZE_STRIPPED);
$PostFilters = array_map('strip_tags', $post);

$message = null;

//VERIFICA SE O EMAIL É VALIDO

$Email = $PostFilters['login_email'];

if (empty($Email)) {

    $message = [
        'status' => 'info', 'message' => 'Seu email não é válido!',
        'redirect' => ''
    ];
    echo json_encode($message);
    return;
}
//RECUPERA O  TOKEN DIGITADO NO FORM
$token = $PostFilters['login_token'];

//CONSULTA DE BASE DE DADOS SOBRE O E-MAIL E O TOKEN

$Read = $pdo->prepare('SELECT  user_email, user_token FROM users WHERE user_email = :user_email AND user_token = :user_token');
$Read->bindValue(':user_email', $Email);
$Read->bindValue(':user_token', $token);
$Read->execute();

$linhas = $Read->rowCount();
//NOTIFICA O USER QUE O EMAIL OU TOKEN ESTÁ ERRADO
if ($linhas == 0) {
    $message = [
        'status' => 'info', 'message' => 'E-mail ou Token  estão incorretos ou não cadastrados!',
        'redirect' => ''
    ];
    echo json_encode($message);
    return;
}
//VERIFICA SE O TOKEN INSERIDO É O MESMO DA BASE DE DADOS

if (strlen($token) >= 10) {
    $valid = 'Confirmed';
} else {
    $message = [
        'status' => 'info', 'message' => 'Seu token é inválido ou está errado!',
        'redirect' => ''
    ];
    echo json_encode($message);
    return;
}
//EM CASO AFIRMATIVO EM RELAÇÃO AS OUTRAS CONDIÇÕES, VAMOS REDIRECIONAR O USER PARA PAGINA DE NOVA SENHA
// if ($valid == 'Confirmed' && $linhas == 1) {
//     $message = [
//         'status' => 'success', 'message' => 'Muito bem verificamos a autenticidade, aguarde...',
//         'redirect' => 'new-password.php?email=' . $Email . ''
//     ];
//     echo json_encode($message);
//     return;
// } else {
//     $message = [
//         'status' => 'error', 'message' => 'Seu token ou e-mail é invalido ou estão errados!',
//         'redirect' => ''
//     ];
//     echo json_encode($message);
//     return;
// }


//PHPMailer

$Subject = '[Team LAG dev] Recuperação de Senha';
$Body = "<h1>Recuperação de Senha</h1>

<p>Você solicitou a recuperação de senha, por gentileza, clique no link para cadastrar sua nova senha.</p>
<p><a href='http://localhost/project-backend/new-password.php?email=".$Email."&token=".$token."' target='_blank'>CLIQUE PARA MUDAR SENHA</a></p>
<p>Caso não tenha sido você desconsidere esse e-mail e entre em contato com o administrador.</p>

<p>Atenciosamente,</p>
<p><b>TeamLAG </b></p>
";

require "../../Developers/PHPMailer/class.phpmailer.php";
require "../../Developers/PHPMailer/class.smtp.php";

$mail = new PHPMailer();
$mail->Host  =  MAIL_HOST;
$mail->SMTPAuth  =  true;
$mail->SMTPSecure  =  MAIL_SECURE;
$mail->Username  =  MAIL_USER;
$mail->Password  =  MAIL_PASS;
$mail->Port  =  MAIL_PORT;
$mail->IsHTML(true);
$mail->CharSet = "utf-8";

$mail->AddReplyTo(MAIL_RESPONSE);

$mail->From = MAIL_RESPONSE;
$mail->Sender = MAIL_RESPONSE;
$mail->FromName = "Team LAG dev";

$mail->AddAddress($Email,'Fulano da Silva');
$mail->AddBCC(MAIL_RESPONSE);

$mail->Subject  = $Subject;

$mail->Body = $Body;


$sender = $mail->Send();

 
if ($sender) {
    $message = [
        'status' => 'success', 'message' => 'Foi encaminhado um e-mail com seu link!',
        'redirect' => ''
    ];
    echo json_encode($message);
    return;
}else {
    $message = [
        'status' => 'error', 'message' => 'Error, ao enviar o e-mail!',
        'redirect' => ''
    ];
    echo json_encode($message);
    return;
}
