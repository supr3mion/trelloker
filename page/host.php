<?php

include ('../php/server.php');

$KEY = $_SESSION['KEY'];
$TOKEN = $_SESSION['TOKEN'];
$BOARD_ID = $_SESSION['board_ID'] = $_GET['board_ID'];
$EMAILS = $_SESSION['emails'];

$API = new API();
$InitializeDatabase = new InitializeDatabase();
$return = json_decode($API->get_all_cards($KEY, $TOKEN, $BOARD_ID));

if (!$return) {
    echo "no cards in todo list";
    $POKERID = false;
} else {
    $labels = $API->preparing_labels($KEY, $TOKEN, $BOARD_ID);
    $POKERID = $InitializeDatabase->Checker($BOARD_ID, $return, $labels);
    if (!$POKERID) {
        var_dump('there was an error');
        $POKERID = false;
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

$HOST = new host();

if ($POKERID) {
    $PLAYERID = $HOST->mailer($EMAILS, $POKERID, $link, $db);
} else {
    $PLAYERID = false;
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include('../html/header.html'); ?>
    <title>poker</title>
</head>
<body class="transition text-white dark:bg-black bg-white overflow-hidden">
        <div class="relative h-screen">
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-[70%] h-[70%] mx-[15%] dark:border-white border-black my-5 border-x-4 rounded overflow-y-auto relative">
                    <div id="completePlayerObject" class="absolute left-[50%] translate-x-[-50%] grid grid-cols-2 gap-4 text-2xl w-[80%]">
                        <div class="col-span-2 text-center rounded bg-onyx p-2 max-h-64">
                            <div id="BOARD_ID" class="hidden"><?php echo $BOARD_ID ?></div>
                            <div id="card" >
                                <?php

                                if ($POKERID) {

                                    $DATA = $HOST->getCard($POKERID, $db);

                                    if(!$DATA) {
                                        ?>

                                        <p id="noCard" class="text-3xl">Momenteel geen actieve kaart</p>

                                        <?php
                                    } else {
                                        ?>

                                        <p class="text-3xl"><?php echo $DATA['card']?></p>
                                        <p class="text-base"><?php echo $DATA['desc']?></p>
                                        <div id="cardID" class="hidden"><?php echo $DATA['cardID'] ?></div>

                                        <?php
                                    }
                                } elseif ($ToDo = 'error') {
                                    ?>

                                    <p class="text-3xl">Er was een error tijdens het starten</p>
                                    <p class="text-xl">Indien deze error vaker tegenkomt, meld dit dan bij de admin</p>

                                    <?php
                                }

                                ?>

                            </div>
                        </div>

                        <div id="playerAnswers" class="rounded bg-onyx p-2 col-span-2 row-span-4 hidden text-center grid grid-cols-5 gap-2 text-center overflow-y-auto">
                        </div>

                        <button id="answerButton" class="rounded p-36 col-span-2 hidden text-center"></button>
                        <div id="answerPermanent" class="rounded p-10 col-span-2 row-span-4 hidden text-center"></div>

                        <button id="levelButton" value="SS" class="rounded bg-SS p-4">SS</button>
                        <button id="levelButton" value="S" class="rounded bg-S p-4">S</button>
                        <button id="levelButton" value="SM" class="rounded bg-SM p-4">SM</button>
                        <button id="levelButton" value="M" class="rounded bg-M p-4">M</button>
                        <button id="levelButton" value="ML" class="rounded bg-ML p-4">ML</button>
                        <button id="levelButton" value="L" class="rounded bg-L p-4">L</button>
                        <button id="levelButton" value="XL" class="col-span-2 bg-XL rounded p-4">XL</button>

                        <button id="submitAnswer" class="rounded dark:text-white text-black dark:border-white border-black border-2 hidden p-4 col-span-2">Verstuur antwoord</button>
                        <button id="showAnswers" class="rounded dark:text-white text-black dark:border-white border-black border-2 hidden p-4 col-span-2">Laat antwoorden zien</button>
                        <button id="nextCard" class="rounded dark:text-white text-black dark:border-white border-black border-2 hidden p-4 col-span-2">volgende</button>

                        <div id="PLAYERID" class="hidden"><?php echo $PLAYERID ?></div>
                        <div id="POKERID" class="hidden"><?php echo $POKERID ?></div>
                    </div>
                </div>
                    <div id="saveAndQuitObject" class="absolute w-fit left-[50%] translate-x-[-50%] top-[50%] translate-y-[-50%] hidden">
                        <button id="saveAndQuitButton" class="rounded dark:border-white border-black border-4 p-4 text-center text-4xl hover:bg-black
                        hover:dark:bg-white text-black dark:text-white hover:text-white dark:hover:text-black transition">Opslaan en Afsluiten</button>
                    </div>
                </div>
            </div>
        <button id="switch_theme" class="hover:bg-black hover:text-white bg-white text-black border-black dark:hover:bg-white dark:hover:text-black dark:bg-black dark:text-white dark:border-white
            fixed top-0 right-0 w-32 py-2 m-3 hover:cursor-pointer hover:duration-300 duration-1000 transition text-xl border-2 text-center rounded"></button>
        <form action="host.php" method="post">
            <label class="hidden">
                <input name="POKERID" type="text" value="<?php echo $POKERID ?>">
                <input name="board_ID" type="text" value="<?php echo $BOARD_ID ?>">
            </label>
            <button name="quitPoker" value="DIE" class="hover:bg-black hover:text-white bg-white text-black border-black dark:hover:bg-white dark:hover:text-black dark:bg-black dark:text-white dark:border-white
    fixed top-0 left-0 w-32 py-2 m-3 hover:cursor-pointer transition text-xl border-2 text-center rounded">Stoppen</button>
        </form>

        <div class="hidden overflow-hidden bg-SS bg-S bg-SM bg-M bg-ML bg-L bg-XL animate-spin"></div>

<script src="../js/host.js"></script>

</body>
</html>
