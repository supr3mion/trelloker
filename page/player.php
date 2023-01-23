<?php

include ("../php/server.php");

$_SESSION['PLAYERID'] = $_GET['ID'];
$player = new player();

$_SESSION['POKERID'] = $player->init($_SESSION['PLAYERID'], $db);
if (!$_SESSION['POKERID']) {
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
    <script src="../js/player.js"></script>
    <title>PLayer</title>
</head>
<body class="transition text-white dark:bg-black bg-white" onload="refreshCard()">

    <div class="relative h-screen">
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="w-[100%] h-[70%] dark:border-white border-black my-5 border-x-4 rounded">
                <div class="relative">
                    <div class="absolute left-[50%] translate-x-[-50%] grid grid-cols-2 gap-4 text-2xl w-[80%]">
                        <div class="col-span-2 text-center rounded bg-onyx p-2 max-h-64">
                            <div id="card" >
                                <?php

                                $DATA = $player->updater($_SESSION['POKERID'], $db);

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
                        <div id="answerObject" class="rounded p-36 col-span-2 row-span-4 hidden text-center"></div>
                        <div id="answerValue" class="hidden">
                            <?php $player->submitAnswer($_SESSION['PLAYERID'], $db); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        const Card = document.getElementById("card");
        let prevCard = Card.innerHTML;

        const answerObject = document.getElementById("answerObject");

        const buttons = document.querySelectorAll("#levelButton")


        function refreshCard() {

            $('#card').load(' #card', function(){
                if(prevCard !== Card.innerHTML) {
                    prevCard = Card.innerHTML
                    console.log(Card.innerHTML)

                    if(!Card.innerHTML.includes("noCard")) {
                        buttons.forEach(function (element) {
                            element.classList.remove("hidden")
                        })
                    }

                    answerObject.classList.remove('bg-SS', 'bg-S', 'bg-SM', 'bg-M', 'bg-ML', 'bg-L', 'bg-XL')
                    answerObject.classList.add('hidden')
                    answerObject.innerHTML = ''

                    deleteCookies()
                }
            })

            setTimeout(refreshCard, 1000)
        }

        const date = new Date();

        for (let i = 0; i < buttons.length; i++) {
            buttons[i].addEventListener("click", function() {

                date.setTime(date.getTime() + 1 * 24 * 60 * 60 * 1000)
                let expires = "; expires=" + date.toUTCString();

                console.log(this.value)
                document.cookie = "answerValue=" + this.value + expires + "; path=/";

                const answerValue = document.getElementById("answerValue");
                // answerValue.innerHTML = this.value;

                $('#answerValue').load(' #answerValue');

                buttons.forEach(function (element) {
                    element.classList.add("hidden")
                })

                switch (buttons[i].classList[1]) {
                    case "bg-SS":
                        answerObject.classList.add('bg-SS')
                        answerObject.classList.remove('hidden')
                        answerObject.innerHTML = this.value;
                        return;

                    case "bg-S":
                        answerObject.classList.add('bg-S')
                        answerObject.classList.remove('hidden')
                        answerObject.innerHTML = this.value;
                        return;

                    case "bg-SM":
                        answerObject.classList.add('bg-SM')
                        answerObject.classList.remove('hidden')
                        answerObject.innerHTML = this.value;
                        return;

                    case "bg-M":
                        answerObject.classList.add('bg-M')
                        answerObject.classList.remove('hidden')
                        answerObject.innerHTML = this.value;
                        return;

                    case "bg-ML":
                        answerObject.classList.add('bg-ML')
                        answerObject.classList.remove('hidden')
                        answerObject.innerHTML = this.value;
                        return;

                    case "bg-L":
                        answerObject.classList.add('bg-L')
                        answerObject.classList.remove('hidden')
                        answerObject.innerHTML = this.value;
                        return;

                    case "bg-XL":
                        answerObject.classList.add('bg-XL')
                        answerObject.classList.remove('hidden')
                        answerObject.innerHTML = this.value;
                        return;
                }

            });
        }

        function deleteCookies() {
            date.setTime(date.getTime() + 1 * 24 * 60 * 60 * 1000)
            let expires = "; expires=" + date.toUTCString();

            document.cookie = "answerValue=empty"+ expires + "; path=/";

            $('#answerValue').load(' #answerValue');
        }

        deleteCookies()

    </script>

<button id="switch_theme" class="bg-white text-black border-black dark:bg-black dark:text-white dark:border-white
    fixed top-0 right-0 w-32 py-2 m-3 text-xl border-2 text-center rounded overflow-hidden"></button>

</body>
</html>
