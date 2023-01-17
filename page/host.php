<?php

include ('../php/server.php');

$KEY = $_SESSION['KEY'];
$TOKEN = $_SESSION['TOKEN'];
$BOARD_ID = $_GET['board_ID'];

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
<body>
<?php

$API = new API();
$InitializeDatabase = new InitializeDatabase();
$return = json_decode($API->get_all_cards($KEY, $TOKEN, $BOARD_ID));

if (!$return) {
    echo "no cards in todo list";
} else {
    $labels = $API->preparing_labels($KEY, $TOKEN, $BOARD_ID);
    $databaseOnline = $InitializeDatabase->Checker($BOARD_ID, $return, $labels);
    if ($databaseOnline) {
        var_dump('DONE');
    }
}
//var_dump($BOARD_ID);
//var_dump($labels);
//var_dump($return);

// use $labels[0]->id

?>
</body>
</html>
