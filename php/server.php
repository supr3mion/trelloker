<?php

session_start();

include ('autoloader.php');

$database = new database();
$db = $database->connect();

$HOST = new host();

$url = $_SERVER['PHP_SELF'];
if (!strpos($url, '/index.php')) {
    if (!isset($_SESSION['TOKEN'])) {
        if(!strpos($url, '/player.php')) {
            header('Location: ../page/index.php');
        }
    }
}

if(isset($_POST['authorize'])) {
    $oath = new TrelloAuth();
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
    header('Location: ../page/prep.php?'.$url);
}

if(isset($_POST['StartTrelloker'])) {
    $emails = $_POST['emails'];

    $parameters = array(
        'board_ID' => $_GET['board_ID'],
    );
    $url = http_build_query($parameters);

    $_SESSION['emails'] = $emails;
    header('Location: ../page/host.php?'.$url);
}

if(isset($_POST['quitPoker'])) {
    $done = $HOST->DIE($_POST['POKERID'], $_POST['board_ID'], $db);
    if ($done) {
        header('location: ../page/boards.php');
    }
}