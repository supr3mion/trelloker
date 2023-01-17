
<?php

include ('../php/server.php');

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include('../html/header.html'); ?>
    <title>Login</title>
</head>
<body class="transition dark:bg-black dark:text-white bg-white text-white">
    <?php if (isset($_GET['ERROR'])) {
        ?>

        <div class="alert bg-[#FF0000] rounded-lg py-5 px-6 mb-3 text-base text-[#611B1B] inline-flex items-center w-[50%] alert-dismissible fade show ml-[25%] mr-[25%] mt-[2%]" role="alert">
            <strong class="mr-1">Something went wrong! </strong> <?php echo $_GET['ERROR'] ?>

            <button type="button" class="btn-close box-content w-4 h-4 p-1 ml-auto text-yellow-900 border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-yellow-900 hover:opacity-75 hover:no-underline" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>


        <?php
    } ?>

    <div class="top-[50%] left-[50%] translate-y-[-50%] translate-x-[-50%] absolute group">
        <form method="POST" action="index.php" class="relative">
            <button class="absolute -inset-0.5 bg-blue_jeans rounded-full blur opacity-40 group-hover:opacity-100 transition duration-1000 group-hover:duration-300" name="authorize" type="submit"></button>
            <button id="login_button" class="transition dark:bg-black dark:text-white bg-white text-black relative w-fit h-fit p-4 text-4xl text-center rounded-full" name="authorize" type="submit">Login met Trello</button>
        </form>
    </div>
<!--    <div id="switch_theme" class="hover:bg-black hover:text-white bg-white text-black border-black dark:hover:bg-white dark:hover:text-black dark:bg-black dark:text-white dark:border-white
                hover:cursor-pointer hover:duration-300 duration-1000 transition w-32 py-2 text-xl border-2 text-center float-right top-0 m-3 rounded overflow-hidden"></div>-->
    <button id="switch_theme" class="hover:bg-black hover:text-white bg-white text-black border-black dark:hover:bg-white dark:hover:text-black dark:bg-black dark:text-white dark:border-white
    fixed top-0 right-0 w-32 py-2 m-3 hover:cursor-pointer hover:duration-300 duration-1000 transition text-xl border-2 text-center rounded overflow-hidden"></button>
</body>
</html>

