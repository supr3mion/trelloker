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
        $sql = "SELECT * FROM `cards` WHERE `pokerID` = '$POKERID' and `active` = 'TRUE'";
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

    function submitAnswer($PLAYERID, $DB, $HOST=false) {

        var_dump(isset($_COOKIE['answerValue']));

        if (isset($_COOKIE['answerValue'])) {
            $VALUE = $_COOKIE['answerValue'];
        } else {
            var_dump("FUCK U");
            return false;
        }


        if (empty($VALUE)) {
            if ($HOST) {
                $sql = "UPDATE `players` SET `Answer`='' WHERE `playerID` = '$PLAYERID' and `email` = 'host'";
            } else {
                $sql = "UPDATE `players` SET `Answer`='' WHERE `playerID` = '$PLAYERID'";
            }
        } else {
            if ($HOST) {
                $sql = "UPDATE `players` SET `Answer`='$VALUE' WHERE `playerID` = '$PLAYERID' and `email` = 'host'";
            } else {
                $sql = "UPDATE `players` SET `Answer`='$VALUE' WHERE `playerID` = '$PLAYERID'";
            }
        }
        return mysqli_query($DB, $sql);
    }

    function resetAnswer($PLAYERID, $DB) {
        $sql = "UPDATE `players` SET `Answer`='' WHERE `playerID` = '$PLAYERID'";
        $result = mysqli_query($DB, $sql);
        var_dump($result);
        return $result;
    }
}