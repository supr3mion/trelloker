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

    $api_key = $_SESSION['KEY'];
    $api_token = $_SESSION['TOKEN'];

    $url = "https://api.trello.com/1/members/me?key=$api_key&token=$api_token";

    $context = stream_context_create(array('http'=>array('protocol_version'=>'1.1')));
    $response = file_get_contents($url, false, $context);

    $data = json_decode($response, true);
    $username = $data['username'];
    $TrelloID = $data['id'];

    $_SESSION['TrelloID'] = $TrelloID;

//    header("Content-Type: application/json");
//    var_dump($data);
//    var_dump($_SESSION['TrelloID']);
//    die();

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $sql = "INSERT INTO Login(`TrelloID`, `Username`, `userAgent`) VALUES ('$TrelloID', '$username', '$user_agent')";

    $result = mysqli_query($db, $sql);

    if (!$result) {
        unset($_SESSION['TOKEN']);
        unset($_SESSION['TrelloID']);
        echo "An error occurred, try again later";
        die();
    } else {
        header('Location: ../page/boards.php');
    }

//    var_dump($db);
//
//    header("Content-Type: application/json");
//    var_dump($result);
//    var_dump($username);
//    var_dump($user_agent);
//
//    die();

    header('Location: ../page/boards.php');
}


