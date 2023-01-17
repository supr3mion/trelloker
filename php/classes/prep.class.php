<?php

class prep
{

    private $labels = [
        [
            "name" => "XL",
            "color" => "red_dark"
        ],
        [
            "name" => "l",
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

    function prepping_poker($KEY, $TOKEN, $BOARD_ID) {

        foreach ($this->labels as $label) {

            $label_name = $label["name"];
            $label_color = $label["color"];

            $data = array('name' => $label_name, 'color' => $label_color, 'idBoard' => $BOARD_ID, 'key' => $KEY, 'token' => $TOKEN);

            $options = array(
                'http' => array(
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($data),
                    'protocol_version'=>'1.1',
                ),
            );
            $context  = stream_context_create($options);
            $result = file_get_contents('https://api.trello.com/1/labels', false, $context);

            if (!isset($result)) {

            }

        }
    }
}