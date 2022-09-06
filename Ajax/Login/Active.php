<?php

// require_once '../../Developers/Config.php';


// $message = null;


// //VERIFICA SE O EMAIL É VALIDO

// $Email = $_COOKIE['LE'];

// if ( empty($Email) ) {
//     $message = [
//         'status' => 'error', 'message' => 'Seu e-mail é invalido.',
//         'redirect' => ''
//     ];
//     echo json_encode($message);
//     return;
// }

// //CONSULTA DE BASE DE DADOS SOBRE O E-MAIL

// $Read = $pdo->prepare('SELECT user_id, user_email, user_password,user_level, user_firstname, user_lastname, user_token FROM users WHERE user_email = :user_email');
// $Read->bindValue(':user_email', $Email);
// $Read->execute();

// $linhas = $Read->rowCount();
// if ($linhas == 0) {
//     $message = [
//         'status' => 'info', 'message' => 'Seu e-mail ou senha estão incorretos.',
//         'redirect' => ''
//     ];
//     echo json_encode($message);
//     return;
// }
// //RECUPERANDO OS DADOS
// foreach ($Read as $Show) {
// }

// //VERIFICAR SENHA
// $VerifyPass = password_verify($_COOKIE['LP'], $Show['user_password']);

// //VERIFICA SE O MÓDULO DE LEMBRAR SENHA ESRÁ ATIVO
// if ($VerifyPass) {

//     //CRIA AS SESSÕES DE ACESSO
//     $_SESSION['user_id'] = $Show['user_id'];
//     $_SESSION['user_name'] = $Show['user_firstname'] . ' ' . $Show['user_lastname'];
//     $_SESSION['user_email'] = $Show['user_email'];
//     $_SESSION['user_level'] = $Show['user_level'];
//     $_SESSION['user_token'] = $Show['user_token'];
//     $_SESSION['logged'] =  1;

//     unset($_SESSION['counter']);
//     header('Location: ../../Admin/home.php');
// } else {
//     $message = [
//         'status' => 'error', 'message' => 'Ocorreu um erro e-mail ou senha incorretos.',
//         'redirect' => 'Admin/home.php'
//     ];
//     echo json_encode($message);
//     return;
// }
