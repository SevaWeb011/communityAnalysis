<?php

class DB
{
    public static function connectToDB():PDO
    {
        $user = DB_USER;
        $pass = DB_PASS;
        $host = DB_HOST;
        $db = DB_NAME;

        $connect = new PDO ("mysql:dbname=$db;host=$host", $user, $pass);
        return $connect;
    }
}
?>