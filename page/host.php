<?php

include ('../php/server.php');

$KEY = $_SESSION['KEY'];
$TOKEN = $_SESSION['TOKEN'];
$BOARD_ID = $_GET['board_ID'];
$EMAILS = $_SESSION['emails'];

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include('../html/header.html'); ?>
    <title>Poker</title>
</head>
<body class="transition text-white dark:bg-black bg-white">
<?php

$UUID = new UUID();
$API = new API();
$InitializeDatabase = new InitializeDatabase();
$return = json_decode($API->get_all_cards($KEY, $TOKEN, $BOARD_ID));

if (!$return) {
    echo "no cards in todo list";
    die();
} else {
    $labels = $API->preparing_labels($KEY, $TOKEN, $BOARD_ID);
    $POKERID = $InitializeDatabase->Checker($BOARD_ID, $return, $labels);
    if (!$POKERID) {
        var_dump('there was an error');
    }
}

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $link = "https";
else $link = "http";
$link .= "://";
$link .= $_SERVER['HTTP_HOST'];

//die();

$database = new database();
$db = $database->connect();

foreach ($EMAILS as $email) {
    $PLAYERID = $UUID->generateUUID();
    $sql = "INSERT INTO players(`playerID`, `pokerID`) VALUES ('$PLAYERID', '$POKERID')";

    $result = mysqli_query($db, $sql);

    if (!$result) {
        var_dump("a error appeared");
    }

    $UL = $link."/trelloker/page/player.php?ID=$PLAYERID";
    $MAIL = new mail();
    $MAIL->sendEmail($email, $UL);
//    var_dump($UL);
}



//$link .= "/trelloker/page/player?PID=$POKERID&ID=$PLAYERID";


//var_dump($BOARD_ID);
//var_dump($labels);
//var_dump($return);

// use $labels[0]->id

?>

<div>

</div>

</body>
</html>
