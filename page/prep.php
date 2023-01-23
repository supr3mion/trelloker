<?php

include ("../php/server.php");

$parameters = array(
    'board_ID' => $_GET['board_ID'],
);
$url = http_build_query($parameters);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include('../html/header.html'); ?>
    <title>Preparing</title>
</head>
<body class="transition dark:bg-black dark:text-white bg-white text-white">
<div class="relative h-screen">
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="w-[50%] h-[70%] mx-[25%] dark:border-white border-black my-5 border-x-4 rounded overflow-y-auto">
            <div class="relative">
                <form id="myForm" class="bg-transparent p-6 absolute left-[50%] translate-x-[-50%]" method="post" action="prep.php?<?php echo $url?>">
                    <label for="email" class="block font-medium mb-2 dark:text-white text-black">voeg email adressen van deelnemers toe:</label>
                    <input type="email" id="email" name="email" class="rounded p-2 bg-onyx focus:outline-none focus:ring">
                    <button type="button" id="addBtn" class="bg-indigo-600 text-white rounded-md p-2 ml-5 bg-blue-800">voeg toe</button>
                    <br>
                    <div id="error"></div>
                    <ul id="emailList" class="list-disc pl-5"></ul>
                    <button type="submit" value="start" id="submitBtn" class="bg-[#22c55e] text-white rounded-md p-2 mt-6 hover:cursor-pointer w-32" name="StartTrelloker">Start Trelloker</button>
                    <a href="boards.php" class="w-fit contents">
                        <div class="bg-[#22c55e] text-white rounded-md p-2 mt-2 hover:cursor-pointer w-32 text-center overflow-hidden">Terug</div>
                    </a>
                </form>
            </div>
            <script src="../js/prep.js"></script>
        </div>
    </div>
</div>
<button id="switch_theme" class="hover:bg-black hover:text-white bg-white text-black border-black dark:hover:bg-white dark:hover:text-black dark:bg-black dark:text-white dark:border-white
    fixed top-0 right-0 w-32 py-2 m-3 hover:cursor-pointer hover:duration-300 duration-1000 transition text-xl border-2 text-center rounded overflow-hidden"></button>
<div class="hidden bg-[#ef4444] w-fit rounded m-2 p-2 w-full mt-3 border-[#ef4444] bg-[#71717a] hover:cursor-not-allowed animate-spin"></div>
</body>
</html>
