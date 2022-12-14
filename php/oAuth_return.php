<?php

include ('../php/server.php');

$token = $_GET['token'];

if ($token == '') {
    $error = $_GET['error'];
    $_SESSION['ERROR'] = $error;

    $url = '../page/index.php';
    $error = array('ERROR' => $error);
    $url_query = $url.http_build_query($error);

    header('Location: '.$url_query);
} else {
    $_SESSION['TOKEN'] = $token;
    header('Location: ../page/boards.php');
}


