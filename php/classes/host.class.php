<?php

class host
{
    function getCard($POKERID, $DB) {
        $sql = "SELECT * FROM `cards` WHERE `pokerID` = '$POKERID' and `active` = 'true' ORDER BY `ID` LIMIT 1";
        $result = mysqli_query($DB, $sql);
        if (!$result->num_rows == 0) {
            $result = mysqli_fetch_assoc($result);
            $card = $result['card'];
            $description = $result['description'];
            $cardID = $result['cardID'];
            return array('card' => $card, 'desc' => $description, 'cardID' => $cardID);
        } else {
            $sql = "SELECT * FROM `cards` WHERE `pokerID` = '$POKERID' and `active` = 'false' and `labelID` = '' ORDER BY `ID` LIMIT 1";
            $result = mysqli_query($DB, $sql);
            if (!$result->num_rows == 0) {
                $result = mysqli_fetch_assoc($result);
                $card = $result['card'];
                $description = $result['description'];
                $cardID = $result['cardID'];

                $sql = "UPDATE `cards` SET `active`='true' WHERE `cardID` = '$cardID'";
                $result = mysqli_query($DB, $sql);
//                var_dump($result);
                return array('card' => $card, 'desc' => $description, 'cardID' => $cardID);
            } else {
                return false;
            }

        }
    }

    function DIE($POKERID, $board_ID, $DB): bool
    {
        $sql = "DELETE FROM `poker` WHERE `pokerID` = '$POKERID'";
        mysqli_query($DB, $sql);

        $sql = "DELETE FROM `labels` WHERE `boardID` = '$board_ID'";
        mysqli_query($DB, $sql);

        $sql = "DELETE FROM `players` WHERE `pokerID` = '$POKERID'";
        mysqli_query($DB, $sql);

        $sql = "DELETE FROM `cards` WHERE `pokerID` = '$POKERID'";
        mysqli_query($DB, $sql);

        return true;
    }


    function addLabel($labelName, $board_ID, $cardID, $DB): bool
    {
        $sql = "SELECT * FROM `labels` WHERE `labelName` = '$labelName' and `boardID` = '$board_ID'";
        $result = mysqli_query($DB, $sql);
        if ($result->num_rows == 0) {
            $label_ID = mysqli_num_rows($result)['labelID'];
            $sql = "UPDATE `cards` SET `labelID`='$label_ID' WHERE `cardID` = '$cardID'";
            $result = mysqli_query($DB, $sql);
            if ($result->num_rows == 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function mailer($EMAILS, $POKERID, $LINK, $DB) {

        include_once ('UUID.class.php');
        include_once ('mail.class.php');

        $UUID = new UUID();
        $MAIL = new mail();

        foreach ($EMAILS as $email) {
            $sql = "SELECT * FROM `players` WHERE `email` = '$email' AND `pokerID` = '$POKERID'";
            $result = mysqli_query($DB, $sql);

            if ($result->num_rows == 0) {
                $PLAYERID = $UUID->generateUUID();
                $sql = "INSERT INTO players(`playerID`, `pokerID`, `email`) VALUES ('$PLAYERID', '$POKERID', '$email')";

                $result = mysqli_query($DB, $sql);

                if (!$result) {
                    var_dump("a error appeared");
                }

                $UL = $LINK."/trelloker/page/player.php?ID=$PLAYERID";
                $MAIL->sendEmail($email, $UL);
            } else {
                $result = mysqli_fetch_assoc($result);
                $email = $result['email'];
                $PLAYERID = $result['playerID'];
                $UL = $LINK."/trelloker/page/player.php?ID=$PLAYERID";
            }

            echo "<script>console.log('E-mail:    " . $email . "' );</script>";
            echo "<script>console.log('URL:       " . $UL . "' );</script>";

        }

        $sql = "SELECT * FROM `players` WHERE `email` = 'host' AND `pokerID` = '$POKERID'";
        $result = mysqli_query($DB, $sql);

        if ($result->num_rows == 0) {
            $PLAYERID = $UUID->generateUUID();
            $sql = "INSERT INTO players(`playerID`, `pokerID`, `email`) VALUES ('$PLAYERID', '$POKERID', 'host')";

            $result = mysqli_query($DB, $sql);

            if (!$result) {
                var_dump("a error appeared");
            }
        } else {
            $result = mysqli_fetch_assoc($result);
            $PLAYERID = $result['playerID'];
        }

        return $PLAYERID;

    }

}