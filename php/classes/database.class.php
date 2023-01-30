<?php

class database
{
    public static $host = "localhost";
    public static $user = "root";
    public static $pass = "";
    public static $db = "trelloker";

    public static function connect()
    {
        $db = mysqli_connect(self::$host, self::$user, self::$pass, self::$db);
        return $db;
    }
}
?>