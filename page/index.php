
<?php

include ('../php/server.php');

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $url = "https://";
else
    $url = "http://";
// Append the host(domain name, ip) to the URL.
$url.= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the URL
//$url.= $_SERVER['REQUEST_URI'];

$url.= '/php/oAuth_return.php';

//http://localhost/trelloker/php/oAuth_return.php

//echo $url;

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
    <title>Login</title>
</head>
<body class="bg-onyx text-[#FFFFFF]">
    <form method="POST" action="index.php">
        <button class="" name="authorize" type="submit">authorize</button>
    </form>
</body>
</html>