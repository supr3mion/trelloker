<?php

include ("../php/server.php");

//$_SESSION['PLAYERID'] = $_GET['ID'];
//var_dump($_GET['ID']);
$player = new player();

//$_SESSION['POKERID'] = $player->init($_SESSION['PLAYERID'], $db);
//$_SESSION['POKERID'] = $player->init($_GET['ID'], $db);

$PLAYERID = $_GET['ID'];
$POKERID = $player->init($PLAYERID, $db);
if (!$POKERID) {
    $active = false;
} else {
    $active = true;
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
    <title>player</title>
</head>
<body class="transition text-white dark:bg-black bg-white">
    <div class="relative h-screen">
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="w-[100%] h-[70%] dark:border-white border-black my-5 border-x-4 rounded">
                <div class="relative">
                    <div class="absolute left-[50%] translate-x-[-50%] grid grid-cols-2 gap-4 text-2xl w-[80%]">
                        <div class="col-span-2 text-center rounded bg-onyx p-2 max-h-64">
                            <div id="card" >
                                <?php

                                if ($active) {
                                    $DATA = $player->updater($POKERID, $db);
                                } else {
                                    $DATA = false;
                                }

                                if(!$DATA) {
                                    ?>

                                    <p id="noCard" class="text-3xl">Momenteel geen actieve kaart</p>

                                    <?php
                                } else {
                                    ?>

                                    <p class="text-3xl"><?php echo $DATA['card']?></p>
                                    <p class="text-base"><?php echo $DATA['desc']?></p>

                                    <?php
                                }

                                ?>

                            </div>
                        </div>


                        <button id="levelButton" value="SS" class="rounded bg-SS p-4">SS</button>
                        <button id="levelButton" value="S" class="rounded bg-S p-4">S</button>
                        <button id="levelButton" value="SM" class="rounded bg-SM p-4">SM</button>
                        <button id="levelButton" value="M" class="rounded bg-M p-4">M</button>
                        <button id="levelButton" value="ML" class="rounded bg-ML p-4">ML</button>
                        <button id="levelButton" value="L" class="rounded bg-L p-4">L</button>
                        <button id="levelButton" value="XL" class="col-span-2 bg-XL rounded p-4">XL</button>

                        <button id="answerButton" class="rounded p-36 col-span-2 row-span-4 hidden text-center"></button>
                        <div id="answerPermanent" class="rounded p-36 col-span-2 row-span-4 hidden text-center"></div>

                        <button id="submitAnswer" class="rounded dark:border-white border-black border-2 hidden p-4 col-span-2">Verstuur antwoord</button>
                        <div id="PLAYERID" class="hidden"><?php echo $PLAYERID ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/player.js"></script>

<button id="switch_theme" class="bg-white text-black border-black dark:bg-black dark:text-white dark:border-white
    fixed top-0 right-0 w-32 py-2 m-3 text-xl border-2 text-center rounded overflow-hidden"></button>

    <script>

    </script>

</body>
</html>
