<?php

class api {
    private $endpoint_boards = 'https://api.trello.com/1/members/me/boards?';

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

        $url = $this->endpoint_boards;

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

//        function cmp ($a, $b) {
//            return strtotime($a['dateLastActivity'])<strtotime($b['dateLastActivity'])?1:-1;
//        }
//        uasort($return_array, 'cmp');
//        print_r($return_array);
//        die();

//        header("Content-Type: application/json");
//        $print = json_encode($return_array);
//        echo ($print);

//        header("Content-Type: application/json");
//        var_dump($return_array[0]['name']);
//        var_dump(json_encode($return_array));
//        print $return_array[0]['name'];
//        die();
        return $return_array;
    }
}