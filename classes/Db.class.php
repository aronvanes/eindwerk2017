<?php 
class Db
{
    private static $conn;
    public static function getInstance(){
            self::$conn= new PDO('mysql:host=localhost;dbname=eindwerk', 'root', 'root');
            return self::$conn;
        }
}
?>