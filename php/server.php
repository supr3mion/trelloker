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