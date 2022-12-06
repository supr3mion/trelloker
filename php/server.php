<?php

include ('autoloader.php');

$database = new database();
$db = $database->connect();

if(isset($_POST['authorize'])) {
    $oath = new oAuth();
//    $KEY = $oath->authorization();
    $oath->authorization();
//    var_dump($KEY);
}