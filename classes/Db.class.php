<?php
class Db
{
    private static $conn;
    public static function getInstance(){
        self::$conn = new PDO('mysql:host=localhost;dbname=db_mal', "root", "root");
            return self::$conn;
        }
}
?>
