<?php

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $url = "https://";
else
    $url = "http://";
// Append the host(domain name, ip) to the URL.
$url.= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the URL
$url.= $_SERVER['REQUEST_URI'];

//print $url;

$token = $_GET['token'];

if ($token == '') {
    $error = $_GET['error'];
    var_dump($error);
} else {
//    var_dump($token);
    print $token;
}
