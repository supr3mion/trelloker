<?php

include_once ('classes/database.class.php');

$database = new database();
$DB = $database->connect();

include_once ('classes/API.class.php');
$API = new API();

session_start();

if(isset($_GET['submitAnswer'])){
    $level = filter_var($_GET['level'], FILTER_SANITIZE_STRING);
    $PLAYERID = filter_var($_GET['PLAYERID'], FILTER_SANITIZE_STRING);
    $sql = "UPDATE `players` SET `Answer`='$level' WHERE `playerID` = '$PLAYERID'";

    mysqli_query($DB, $sql);

} elseif (isset($_GET['showAnswers'])) {
    $POKERID = filter_var($_GET['POKERID'], FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM `players` WHERE `pokerID` = '$POKERID' AND `Answer` != ''";
    $result = mysqli_query($DB, $sql);

    $data = array(
        'status' => 'success',
        'answers' => mysqli_fetch_all($result)
    );

//    mysqli_fetch_all($result)

    $json = json_encode($data);

    echo $json;

} elseif (isset($_GET['saveAndContinue'])) {
    $cardID = filter_var($_GET['cardID'], FILTER_SANITIZE_STRING);
    $level = filter_var($_GET['level'], FILTER_SANITIZE_STRING);
    $BOARD_ID = filter_var($_GET['BOARD_ID'], FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM `labels` WHERE `boardID` = '$BOARD_ID' AND `labelName` = '$level'";
    $result = mysqli_query($DB, $sql);

    if ($result->num_rows > 0) {
        $labelID = mysqli_fetch_assoc($result)['labelID'];


        $sql = "UPDATE `cards` SET `labelID` = '$labelID', `active` = 'false' WHERE `cardID` = '$cardID'";
        $result = mysqli_query($DB, $sql);

        if ($result) {
            $sql = "UPDATE `cards` SET `active` = 'true' WHERE `active` = 'false' AND `labelID` = '' ORDER BY `ID` LIMIT 1";
            $result = mysqli_query($DB, $sql);
            if ($result) {

                $data = array(
                    'status' => 'success',
                    'done' => 'false'
                );

            } else {
                $data = array(
                    'status' => 'success',
                    'done' => 'true'
                );
            }
            echo json_encode($data);
            die();
        }
    } else {
        $data = array(
            'status' => 'fail',
            'done' => $result->num_rows,
            'cardID' => $cardID,
            'level' => $level,
            'board id' => $BOARD_ID

        );

        echo json_encode($data);
        die();
    }

} elseif (isset($_GET['saveAndQuitObject'])) {
    $POKERID = filter_var($_GET['POKERID'], FILTER_SANITIZE_STRING);
    $KEY = $_SESSION['KEY'];
    $TOKEN = $_SESSION['TOKEN'];

    $sql = "SELECT * FROM `cards` WHERE `pokerID` = '$POKERID'";
    $result = mysqli_query($DB, $sql);


    while ($card = mysqli_fetch_assoc($result)) {
        $API->setLabelsToCards($KEY, $TOKEN, $card['cardID'], $card['labelID']);
    }


    include_once ("../php/classes/host.class.php");

    $HOST = new host();
    $done = $HOST->DIE($_POST['POKERID'], $_POST['board_ID'], $DB);

    echo 'success';
    die();

} elseif (isset($_GET['NextCard'])) {
    $POKERID = filter_var($_GET['POKERID'], FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM `cards` WHERE `pokerID` = '$POKERID' and `active` = 'true' ORDER BY `ID` LIMIT 1";
    $result = mysqli_query($DB, $sql);
    if (!$result->num_rows == 0) {
        $result = mysqli_fetch_assoc($result);

        $data = array(
            'status' => 'success',
            'card' => $result['card'],
            'description' => $result['description'],
            'cardID' => $result['cardID']
        );

    } else {
        $data = array(
            'status' => 'success',
            'card' => 'no card'
        );
    }
    echo json_encode($data);
    die();
} elseif (isset($_GET['checkPlayerID'])) {
    $PLAYERID = filter_var($_GET['PLAYERID'], FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM `players` WHERE `playerID` = '$PLAYERID'";
    $result = mysqli_query($DB, $sql);

    if ($result->num_rows == 0) {
        $data = array(
            'status' => 'success',
            'player' => 'false'
        );
    } else {
        $data = array(
            'status' => 'success',
            'player' => 'true'
        );
    }

    echo json_encode($data);
    die();

} else {
    $error = array('status' => 'error', 'message' => 'an error occurred');
    echo json_encode($error);
}
die();