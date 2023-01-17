<?php

include ('../php/server.php');

$KEY = $_SESSION['KEY'];
$TOKEN = $_SESSION['TOKEN'];



//$API = new API();
//$return = $API->get_all_boards($KEY, $TOKEN);
//
//print "\n".$return[0]["name"];

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include('../html/header.html'); ?>
    <title>Boards</title>
</head>
<!--<body class="dark:bg-onyx bg-gainsboro text-[#E0E0E0]">-->
<body class="transition dark:bg-black dark:text-white bg-white text-white">
<div class="w-[70%] h-fit mx-[15%] dark:border-white border-black my-5 border-x-2 grid grid-cols-1 auto-rows-auto gap-4">
        <?php

        $boards = new display_boards();
        $boards->board();

        ?>
    </div>
    <?php

//    var_dump(json_decode(json_encode($return)));
//    print ($return);

    ?>
<button id="switch_theme" class="hover:bg-black hover:text-white bg-white text-black border-black dark:hover:bg-white dark:hover:text-black dark:bg-black dark:text-white dark:border-white
    fixed top-0 right-0 w-32 py-2 m-3 hover:cursor-pointer hover:duration-300 duration-1000 transition text-xl border-2 text-center rounded overflow-hidden"></button>
</body>
</html>