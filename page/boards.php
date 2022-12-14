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
    <link href="../dist/output.css" rel="stylesheet">
    <link href="../src/style.css" rel="stylesheet">
    <script src="../node_modules/tw-elements/dist/js/index.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Boards</title>
</head>
<body class="dark:bg-onyx bg-gainsboro text-[#E0E0E0]">
<div class="w-[70%] h-fit mx-[15%] border-[#E0E0E0] my-5 border-x-2 grid grid-cols-1 auto-rows-auto gap-4">
        <?php

        $boards = new display_boards();
        $boards->board();

        ?>
    </div>
    <?php

//    var_dump(json_decode(json_encode($return)));
//    print ($return);

    ?>
</body>
</html>
