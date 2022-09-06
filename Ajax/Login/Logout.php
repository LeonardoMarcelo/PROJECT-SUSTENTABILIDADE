<?php

require_once '../../Developers/Config.php';


$get = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRIPPED);
$get = strip_tags($get);
 
$message = null;

if (!$get || $get == '' || $get == null) {

    $message = [
        'status' => 'warning', 'message' => 'Oops, nenhuma ção pode ser realizada',
        'redirect' => '../Admin/crud/index.php'
    ];
    echo json_encode($message);
    return;
} else {
    
    unset($_SESSION['user_name']);
    unset($_SESSION['user_level']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_id']);
    unset($_SESSION['user_token']);
    unset($_SESSION['logged']);

    $_SESSION['logout'] =1;
    $message = [
        'status' => 'success', 'message' => 'Logout realizado com sucesso',
        'redirect' => '../index.php'
    ];
    echo json_encode($message);
    return;
}
