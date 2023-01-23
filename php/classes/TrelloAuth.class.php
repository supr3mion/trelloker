<?php

class TrelloAuth {
    public static function authorization() {

        require_once ('database.class.php');
        $database = new database();
        $db = $database->connect();

        $sql = 'SELECT * FROM api WHERE ID = 1';
        $results = mysqli_query($db, $sql);

        $results = mysqli_fetch_assoc($results);
        $KEY = $results['sleutel'];

        if ($KEY === "") {
            echo "fuck U!";
            die();
        }


//        if (mysqli_num_rows($results) > 0) {
//            $results = mysqli_fetch_assoc($results);
//            $KEY = $results['sleutel'];
//        } else {
//            $KEY = '95eb9c01c3bbd6f39bd34537b9126225';
//        }

        $_SESSION['KEY'] = $KEY;

        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
            $return_url = "https://";
        else
            $return_url = "http://";
        // Append the host(domain name, ip) to the URL.
        $return_url.= $_SERVER['HTTP_HOST'];
        $return_url.= 'trelloker/html/redirect.html';

        $url = "https://trello.com/1/authorize?";

        $data_array = array(
            'key' => $KEY,
            'expiration' => '1day',
            'name' => 'Trelloker',
            'response_type' => 'token',
//            'return_url' => 'http://localhost/trelloker/html/redirect.html',
            'return_url' => 'https://milan.lesonline.nu/trelloker/html/redirect.html',
//            'return_url' => $return_url,
            'callback_method' => 'fragment',
            'scope' => 'read,write',
        );

        $url_query = $url.http_build_query($data_array);

//        return $url_query;

        header('Location: '.$url_query);

    }
}