<?php
class Db
{
    private static $conn;
    public static function getInstance(){
            self::$conn= new PDO('mysql:host=localhost;dbname=db_mal', 'root', '');
            return self::$conn;
        }
}
?>
