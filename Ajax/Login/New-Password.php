<?php

require_once '../../Developers/Config.php';


$Post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED);
$PostFilters = array_map('strip_tags', $Post);

$message = null;
 

//VERIFICA SE O EMAIL É VALIDO

$Email = $PostFilters['login_email'];
$password = $PostFilters['login_password'];
$reType = $PostFilters['login_retype'];

if ( empty($Email) ) {

    $message = [
        'status' => 'info', 'message' => 'Seu email não é válido!',
        'redirect' => ''
    ];
    echo json_encode($message);
    return;
}

//CONSULTA DE BASE DE DADOS SOBRE O E-MAIL

$Read = $pdo->prepare('SELECT * FROM users WHERE user_email = :user_email');
$Read->bindValue(':user_email', $Email);
$Read->execute();

 $linhas = $Read->rowCount();
if ($linhas == 0)  {
  
        $message = [
            'status' => 'info', 'message' => 'Seu e-mail é inválidou ou está incorreto!',
            'redirect' => ''
        ];
        echo json_encode($message);
        return;
    }

//VERIFICA SE A SENHA E NOVA SENHA SAO IGUAIS
if($password != $reType){
    $message = [
        'status' => 'info', 'message' => 'Oops, a senha não é a mesma para ambos os campos',
        'redirect' => ''
    ];
    echo json_encode($message);
    return;
}
//CRIPITOGRAFIA DA SENHA

$newPassword = password_hash($password,PASSWORD_DEFAULT );

//ATUALIZA NO BANCO DE DADOS
$update = $pdo->prepare('UPDATE users SET user_password = :user_password WHERE user_email = :user_email');
$update->bindValue(':user_password',$newPassword);
$update->bindValue(':user_email',$Email);
$update->execute();
if($update){

    $message = [
        'status' => 'success', 'message' => 'Sua senha foi redefinida!',
        'redirect' => 'login.php'
    ];
    echo json_encode($message);
    return;
}else{
    $message = [
        'status' => 'error', 'message' => 'OOPS ,ocorreu um problema tente novamente!',
        'redirect' => ''
    ];
    echo json_encode($message);
    return;
}

