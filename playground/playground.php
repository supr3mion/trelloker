<?php

//$api_key = '95eb9c01c3bbd6f39bd34537b9126225';
//$api_token = 'ATTA4468fcfeb762b9f3c9b12a0242eb139b98abaaf1a3e09491e584bee33efe4bfa1AB09D16';
//$url = "https://api.trello.com/1/members/me?key=$api_key&token=$api_token";
//
////https://api.trello.com/1/members/me?key=95eb9c01c3bbd6f39bd34537b9126225&token=ATTA4468fcfeb762b9f3c9b12a0242eb139b98abaaf1a3e09491e584bee33efe4bfa1AB09D16
//
//$context = stream_context_create(array('http'=>array('protocol_version'=>'1.1')));
//$response = file_get_contents($url, false, $context);
//
////$response = file_get_contents($url);
//$data = json_decode($response, true);
//$username = $data['username'];
//echo $id;
//

// This code sample uses the 'Unirest' library:
// http://unirest.io/php.html
//$query = array(
//    'name' => '{name}',
//    'color' => '{color}',
//    'key' => '95eb9c01c3bbd6f39bd34537b9126225',
//    'token' => 'ATTA4468fcfeb762b9f3c9b12a0242eb139b98abaaf1a3e09491e584bee33efe4bfa1AB09D16'
//);
//
//$response = Unirest\Request::post(
//    'https://api.trello.com/1/boards/{id}/labels',
//    $query
//);
//
//var_dump($response)


//--------------------------------------------------------------------------------------------------------------------------------


//$label_name = 'example label';
//$label_color = 'red_dark';
//$board_id = '63bd4cf8bcc0680016cecb20';
//$api_key = '95eb9c01c3bbd6f39bd34537b9126225';
//$token = 'ATTA4468fcfeb762b9f3c9b12a0242eb139b98abaaf1a3e09491e584bee33efe4bfa1AB09D16';
//
//$data = array('name' => $label_name, 'color' => $label_color, 'idBoard' => $board_id, 'key' => $api_key, 'token' => $token);
//
//$options = array(
//    'http' => array(
//        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
//        'method'  => 'POST',
//        'content' => http_build_query($data),
//        'protocol_version'=>'1.1',
//    ),
//);
//$context  = stream_context_create($options);
////$context = stream_context_create(array('http'=>array('protocol_version'=>'1.1')));
//$result = file_get_contents('https://api.trello.com/1/labels', false, $context);
//
//var_dump($result);

//---------------------------------------------------------------------------------------------------------------------------------

//$labels = [
//    [
//        "name" => "XL",
//        "color" => "red_dark"
//    ],
//    [
//        "name" => "L",
//        "color" => "red"
//    ],
//    [
//        "name" => "ML",
//        "color" => "orange_dark"
//    ],
//    [
//        "name" => "M",
//        "color" => "orange"
//    ],
//    [
//        "name" => "SM",
//        "color" => "orange_light"
//    ],
//    [
//        "name" => "S",
//        "color" => "green_dark"
//    ],
//    [
//        "name" => "SS",
//        "color" => "green"
//    ],
//];
//
//$board_id = '63bd4cf8bcc0680016cecb20';
//$api_key = '95eb9c01c3bbd6f39bd34537b9126225';
//$token = 'ATTA4468fcfeb762b9f3c9b12a0242eb139b98abaaf1a3e09491e584bee33efe4bfa1AB09D16';
//
//$context = stream_context_create(array('http'=>array('protocol_version'=>'1.1')));
//$url = "https://api.trello.com/1/boards/$board_id/labels?fields=all&key=$api_key&token=$token";
//
//// Fetch all labels of the board
//$response = file_get_contents($url, false, $context);
//$board_labels = json_decode($response, true);
//
//header("Content-Type: application/json");
//
//$list_copy = [];
//
//
//// Iterate through each label
//foreach ($board_labels as $label) {
//    $match = false;
//    // Compare label name and color with the values in $labels array
//    foreach($labels as $valid_label) {
//        if($label["name"] == $valid_label["name"] && $label["color"] == $valid_label["color"]) {
//            $valid_label['id'] = $label['id'];
//            $match = true;
//            break;
//        }
//    }
////    var_dump($valid_label);
//
////    $list_copy[] = $valid_label;
//
//
//
//    // If no match, delete the label
//    if(!$match) {
//        $options = array(
//            'http' => array(
//                'method' => 'DELETE',
//                'protocol_version'=>'1.1',
//            ),
//        );
//        $context  = stream_context_create($options);
//        $delete_url = "https://api.trello.com/1/labels/{$label['id']}?key=$api_key&token=$token";
//        $result = file_get_contents($delete_url, false, $context);
//    }
//}
//
//foreach ($labels as $label) {
//
//    $label_name = $label["name"];
//    $label_color = $label["color"];
//
//    $data = array('name' => $label_name, 'color' => $label_color, 'idBoard' => $board_id, 'key' => $api_key, 'token' => $token);
//
//    $options = array(
//        'http' => array(
//            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
//            'method' => 'POST',
//            'content' => http_build_query($data),
//            'protocol_version' => '1.1',
//        ),
//    );
//    $context = stream_context_create($options);
//    $result = file_get_contents('https://api.trello.com/1/labels', false, $context);
//
////    var_dump(json_decode($result));
//
//    $list_copy[] = json_decode($result);
//
//
//
////    if (!isset($result)) {
////
////    }
//}
////var_dump($labels_copy);
//
//var_dump($list_copy[0]->id);
//
////var_dump(json_encode($list_copy));
///
///
///
//---------------------------------------------------------------------------------------------------------------------------------

?>

<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <script>-->
<!--        function sendValue() {-->
<!--            const button = document.getElementById("myButton");-->
<!--            const value = button.getAttribute("value");-->
<!--            console.log(value)-->
<!---->
<!--            fetch("#", {-->
<!--                method: "POST",-->
<!--                body: "value=" + value-->
<!--            })-->
<!--                .then(response => response.text())-->
<!--                .then(data => {-->
<!--                    // Handle the response from the PHP script-->
<!--                    console.log(data)-->
<!--                    document.getElementById("output").innerHTML = data;-->
<!--                });-->
<!--        }-->
<!--        --><?php
//        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//            $value = $_POST['value'];
//            // Do something with the
//            var_dump($value);
////            die();
//            echo $value;
//        }
//        ?>
<!--    </script>-->
<!--    <title>playground</title>-->
<!--</head>-->
<!--<body>-->
<!--<button id="myButton" value="hello" onclick="sendValue()">hello</button>-->
<!--<div id="output"></div>-->
<!--</body>-->
<!--</html>-->

<!--<!DOCTYPE html>-->
<!--<html>-->
<!--<head>-->
<!--    <title>Button Value Example</title>-->
<!--</head>-->
<!--<body>-->
<!--<button id="button1" value="button1">Button 1</button>-->
<!--<button id="button2" value="button2">Button 2</button>-->
<!--<button id="button3" value="button3">Button 3</button>-->
<!--<p id="output"></p>-->
<!--<script>-->
<!--    var buttons = document.querySelectorAll("button");-->
<!--    for (var i = 0; i < buttons.length; i++) {-->
<!--        buttons[i].addEventListener("click", function() {-->
<!--            var output = document.getElementById("output");-->
<!--            output.innerHTML = "You clicked button: " + this.value;-->
<!--        });-->
<!--    }-->
<!--</script>-->
<!--</body>-->
<!--</html>-->


<?php

include_once ('../php/classes/database.class.php');

$database = new database();
$DB = $database->connect();

$sql = "SELECT * FROM `labels` WHERE `boardID` = '6310a24207977f021709caff' AND `labelName` = 'SS'";
$result = mysqli_query($DB, $sql);

//var_dump($result);

var_dump(mysqli_fetch_assoc($result)['labelID']);

?>

