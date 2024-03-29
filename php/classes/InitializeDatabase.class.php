<?php

class InitializeDatabase
{

    private $DB;

    function Checker($BOARD_ID, $CARDS, $LABELS) {

        require_once ('database.class.php');
        $database = new database();
        $this->DB = $database->connect();

        $TrelloID = $_SESSION['TrelloID'];
        $sql = "SELECT * FROM `poker` WHERE `boardID` = '$BOARD_ID' and `active` = 'TRUE'";
        $result = mysqli_query($this->DB, $sql);

        if (!$result->num_rows == 0) {
            $POKERID = mysqli_fetch_assoc($result)['pokerID'];
            include_once('host.class.php');
            $HOST = new host();
            $HOST->DIE($POKERID, $BOARD_ID, $this->DB);
        }

        $POKERID = $this->InitializePoker($BOARD_ID, $TrelloID);
        if ($POKERID) {
            $complete = $this->InitializeCards($CARDS, $POKERID);
            if ($complete) {
                $labelsAdded = $this->InitializeLabels($LABELS);
                if ($labelsAdded) {
                    return $POKERID;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }

//        if ($result->num_rows == 0) {
//            $POKERID = $this->InitializePoker($BOARD_ID, $TrelloID);
//            if ($POKERID) {
//                $complete = $this->InitializeCards($CARDS, $POKERID);
//                if ($complete) {
//                    $labelsAdded = $this->InitializeLabels($LABELS);
//                    if ($labelsAdded) {
//                        return $POKERID;
//                    } else {
//                        return false;
//                    }
//                } else {
//                    return false;
//                }
//            } else {
//                return false;
//            }
//        } else {
//            return mysqli_fetch_assoc($result)['pokerID'];
//        }
    }

    private function InitializePoker($BOARD_ID, $TrelloID) {

        $POKERID = Uniqid();

        require_once ('UUID.class.php');
        $POKERID = new UUID();
        $POKERID = $POKERID->generateUUID();

        $sql = "INSERT INTO poker(`TrelloID`, `pokerID`, `boardID`, `active`) VALUES ('$TrelloID', '$POKERID', '$BOARD_ID', 'TRUE')";

        $result = mysqli_query($this->DB, $sql);

//        var_dump($result);
//
//        var_dump($POKERID);

        if ($result) {
            return $POKERID;
        } else {
            return false;
        }

    }

    private function InitializeCards($CARDS, $POKERID): bool
    {

        foreach ($CARDS as $card) {

//            var_dump($card);

            $cardID = $card->id;
            $cardName = $card->name;
            $cardDesc = $card->desc;

            $sql = "SELECT * FROM cards WHERE `cardID` = '$cardID'";
            $result = mysqli_query($this->DB, $sql);

            if ($result->num_rows == 0) {
                $sql = "INSERT INTO cards(`pokerID`, `cardID`, `card`, `description`) VALUES ('$POKERID', '$cardID', '$cardName', '$cardDesc')";

                $result = mysqli_query($this->DB, $sql);

                if (!$result) {
                    var_dump("error in adding card");
                    return false;
                }
            }


        }

        return true;
    }

    private function InitializeLabels($LABELS): bool
    {
        foreach ($LABELS as $label) {

//            $labelID = $label['id'];
//            $labelName = $label['name'];
//            $labelColor = $label['color'];
//            $labelBoardID = $label['idBoard'];

            $labelID = $label->id;
            $labelName = $label->name;
            $labelColor = $label->color;
            $labelBoardID = $label->idBoard;

            $sql = "SELECT * FROM labels WHERE `boardID` = '$labelBoardID' and `labelID` = '$labelID'";
            $result = mysqli_query($this->DB, $sql);

//            var_dump($result);

            if ($result->num_rows == 0) {

//                var_dump($result);

                $sql = "INSERT INTO labels(`boardID`, `labelID`, `labelName`, `labelColor`) VALUES ('$labelBoardID', '$labelID', '$labelName', '$labelColor')";
//                $sql = "INSERT INTO cards(`pokerID`, `cardID`, `card`, `description`) VALUES ('$POKERID', '$cardID', '$cardName', '$cardDesc')";


                $result = mysqli_query($this->DB, $sql);

//                var_dump($result);

                if (!$result) {
                    var_dump("error in adding labels");
                    return false;
                }
            }


        }
        return true;
    }

}
