<?php

session_start();

include ('autoloader.php');

$database = new database();
$db = $database->connect();

$url = $_SERVER['PHP_SELF'];
if (!strpos($url, '/index.php')) {
    if (!isset($_SESSION['TOKEN'])) {
        header('Location: ../page/index.php');
    }
}

if(isset($_POST['authorize'])) {
    $oath = new oAuth();
//    $KEY = $oath->authorization();
    $oath->authorization();
//    var_dump($KEY);
}

if(isset($_POST['play'])) {
    $ID = ($_POST['play']);
    $parameters = array(
        'board_ID' => $ID,
    );
    $url = http_build_query($parameters);
    header('Location: ../page/host.php?'.$url);
}

if(isset($_POST['StartTrelloker'])) {
    $emails = $_POST['emails'];
    $mailFunction = new mail();

    foreach ($emails as $email) {
        $mailFunction->sendEmail($email, );
    }
    var_dump($emails);
}