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
