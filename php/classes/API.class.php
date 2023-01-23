<?php

class api {
//    private $endpoint_boards = 'https://api.trello.com/1/members/me/boards?';

    private $endpoint = 'https://api.trello.com/1';
    private $boards = '/members/me/boards?';
    private $cards = '/lists/id/cards?';
//    private $cards = '/boards/id/cards?';
    private $lists = '/boards/id/lists?';

    private $labels = [
        [
            "name" => "XL",
            "color" => "red_dark"
        ],
        [
            "name" => "L",
            "color" => "red"
        ],
        [
            "name" => "ML",
            "color" => "orange_dark"
        ],
        [
            "name" => "M",
            "color" => "orange"
        ],
        [
            "name" => "SM",
            "color" => "orange_light"
        ],
        [
            "name" => "S",
            "color" => "green_dark"
        ],
        [
            "name" => "SS",
            "color" => "green"
        ],
    ];

    function get_all_boards($KEY, $TOKEN) {

        $board_info = array(
            "id",
            "name",
            "closed",
            "idOrganization",
            "url",
            "prefs",
            "dateLastActivity",
        );
        $prefs = array(
            "backgroundImageScaled",
            "backgroundBottomColor",
            "backgroundTopColor",
        );


        $temp_array = array();
        $return_array = array();

        $parameters = array (
            'key' => $KEY,
            'token' => $TOKEN,
        );

        $url = $this->endpoint.$this->boards;

        $context = stream_context_create(array('http'=>array('protocol_version'=>'1.1')));
        $boards = file_get_contents($url.http_build_query($parameters), false, $context);

//        header("Content-Type: application/json");
//        var_dump($boards);
//        die();

        $boards = json_decode($boards);


        foreach ($boards as $board) {
            foreach ($board_info as $item) {
                if ($item == 'dateLastActivity') {
                    $value = date('d-m-Y, H:i', strtotime(json_decode(json_encode($board), true)[$item]));
                    $temp_array[$item] = $value;
                } elseif  ($item == 'prefs') {
                    foreach ($prefs as $pref) {
                        if ($pref == "backgroundImageScaled") {
                            if (isset(json_decode(json_encode($board), true)[$item]['backgroundImageScaled'][2]['url'])) {
                                $value = json_decode(json_encode($board), true)[$item]['backgroundImageScaled'][2]['url'];
                            } else {
                                $value = 'none';
                            }
                        } else {
                            $value = json_decode(json_encode($board), true)[$item][$pref];
                        }

                        $temp_array[$pref] = $value;
                    }
                } else {
                    $value = json_decode(json_encode($board), true)[$item];
                    $temp_array[$item] = $value;
                }
            }
            $return_array[] = $temp_array;
        }

        function compare($a, $b) {
            return (strtotime($a['dateLastActivity']) < strtotime($b['dateLastActivity']))?1:-1;
        }

        usort($return_array, 'compare');

        return $return_array;
    }

    function get_all_cards($KEY, $TOKEN, $BOARD_ID) {

        $context = stream_context_create(array('http'=>array('protocol_version'=>'1.1')));

        $parameters = array (
            'key' => $KEY,
            'token' => $TOKEN,
        );

        $url = $this->endpoint.$this->lists;
        $url = str_replace("id", $BOARD_ID, $url);

        $listsData = json_decode(file_get_contents($url.http_build_query($parameters), false, $context), true);

        $cards = array();

//        header("Content-Type: application/json");
//        var_dump($listsData);
//        die();

        foreach($listsData as $list) {
            if (strtoupper($list['name']) == 'TODO' || strtoupper($list['name']) == 'TO DO') {
                $listId = $list['id'];
                $url = $this->endpoint.$this->cards;
                $url = str_replace("id", $listId, $url);
                $cardsData = json_decode(file_get_contents($url.http_build_query($parameters), false, $context), true);
                foreach($cardsData as $card){
                    $card['listId'] = $listId;
                    $temp['id'] = $card['id'];
                    $temp['name'] = $card['name'];
                    $temp['desc'] = $card['desc'];

//                    var_dump($temp);
//                    $cards[] = $card;
                    $cards[] = $temp;
                }
            }

        };

        header("Content-Type: application/json");

        if (count($cards) < 1){
//            var_dump("no cards in todo");
            return false;
        } else {
//            var_dump($BOARD_ID);
//            var_dump(json_encode($cards));
            return json_encode($cards);
        }

//        die();

    }

    function preparing_labels($KEY, $TOKEN, $BOARD_ID, $delete_labels = false)
    {

        if (!$delete_labels) {
            $this->delete_labels($KEY, $TOKEN, $BOARD_ID);
        }
        return $this->create_labels($KEY, $TOKEN, $BOARD_ID);

    }


    private function delete_labels($KEY, $TOKEN, $BOARD_ID) {
        $context = stream_context_create(array('http'=>array('protocol_version'=>'1.1')));
        $url = "https://api.trello.com/1/boards/$BOARD_ID/labels?fields=all&key=$KEY&token=$TOKEN";

        // Fetch all labels of the board
        $response = file_get_contents($url, false, $context);
        $board_labels = json_decode($response, true);

        // Iterate through each label
        foreach ($board_labels as $label) {
            $match = false;
            // Compare label name and color with the values in $labels array
            foreach($this->labels as $valid_label) {
                if($label["name"] == $valid_label["name"] && $label["color"] == $valid_label["color"]) {
                    $match = true;
                    break;
                }
            }
            // If no match, delete the label
            if(!$match) {
                $options = array(
                    'http' => array(
                        'method' => 'DELETE',
                        'protocol_version'=>'1.1',
                    ),
                );
                $context  = stream_context_create($options);
                $delete_url = "https://api.trello.com/1/labels/{$label['id']}?key=$KEY&token=$TOKEN";
                file_get_contents($delete_url, false, $context);
            }
        }

    }

    private function create_labels($KEY, $TOKEN, $BOARD_ID) {

        $return_list = [];

        foreach ($this->labels as $label) {

            $label_name = $label["name"];
            $label_color = $label["color"];

            $data = array('name' => $label_name, 'color' => $label_color, 'idBoard' => $BOARD_ID, 'key' => $KEY, 'token' => $TOKEN);

            $options = array(
                'http' => array(
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => http_build_query($data),
                    'protocol_version' => '1.1',
                ),
            );
            $context = stream_context_create($options);
            $result = file_get_contents('https://api.trello.com/1/labels', false, $context);

            $return_list[] = json_decode($result);

        }

        return $return_list;
    }

}

































































