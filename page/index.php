
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
    <link href="../dist/output.css" rel="stylesheet">
    <link href="../src/style.css" rel="stylesheet">
    <script src="../node_modules/tw-elements/dist/js/index.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Login</title>
</head>
<body class="dark:bg-black  bg-gainsboro text-[#E0E0E0]">
    <?php if (isset($_GET['ERROR'])) {
        ?>

        <div class="alert bg-[#FF0000] rounded-lg py-5 px-6 mb-3 text-base text-[#611B1B] inline-flex items-center w-[50%] alert-dismissible fade show ml-[25%] mr-[25%] mt-[2%]" role="alert">
            <strong class="mr-1">Something went wrong! </strong> <?php echo $_GET['ERROR'] ?>

            <button type="button" class="btn-close box-content w-4 h-4 p-1 ml-auto text-yellow-900 border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-yellow-900 hover:opacity-75 hover:no-underline" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>


        <?php
    } ?>

<!--    <form method="POST" action="index.php">-->
<!--        <button class="w-fit h-fit p-3 text-5xl text-center rounded bg-[#007AE4] hover:bg-[#007AE4]/50 top-[50%] left-[50%] translate-y-[-50%] translate-x-[-50%] absolute shadow-md transition duration-150 ease-in-out" name="authorize" type="submit">Login met Trello</button>-->
<!--    </form>-->
    <div class="top-[50%] left-[50%] translate-y-[-50%] translate-x-[-50%] absolute group">
        <form method="POST" action="index.php" class="relative">
            <button class="absolute -inset-0.5 bg-blue_jeans rounded-full blur opacity-40 group-hover:opacity-100 transition duration-1000 group-hover:duration-300" name="authorize" type="submit"></button>
            <button class="relative w-fit h-fit p-4 text-4xl text-center rounded-full bg-black" name="authorize" type="submit">Login met Trello</button>
        </form>
    </div>
</body>
</html>

