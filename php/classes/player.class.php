<?php

class player
{
    function init($PLAYERID, $DB) {
        $sql = "SELECT * FROM `players` WHERE `playerID` = '$PLAYERID'";
        $result = mysqli_query($DB, $sql);
        if (!$result->num_rows == 0) {
            return mysqli_fetch_assoc($result)['pokerID'];
        } else {
            return false;
        }
    }

    function updater($POKERID, $DB) {
        $sql = "SELECT * FROM `cards` WHERE `pokerID` = '$POKERID' and `active` = 'false'";
        $result = mysqli_query($DB, $sql);
        if (!$result->num_rows == 0) {
            $result = mysqli_fetch_assoc($result);
            $card = $result['card'];
            $description = $result['description'];
            $cardID = $result['cardID'];
            return array('card' => $card, 'desc' => $description, 'cardID' => $cardID);
        } else {
            return false;
        }
    }

    function submitAnswer($PLAYERID, $DB) {
        $VALUE = $_COOKIE['answerValue'];
        if ($VALUE == "empty") {
            $sql = "UPDATE `players` SET `Answer`='' WHERE `playerID` = '$PLAYERID'";
        } else {
            $sql = "UPDATE `players` SET `Answer`='$VALUE' WHERE `playerID` = '$PLAYERID'";
        }
        $result = mysqli_query($DB, $sql);
        var_dump($result);
        return $result;
    }
}