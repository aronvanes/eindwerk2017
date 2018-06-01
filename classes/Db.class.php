<?php 
class Db
{
    private static $conn;
    public static function getInstance(){
        if( is_null( self::$conn ) ){
            self::$conn= new PDO('mysql:host=localhost; dbname=eindwerk', 'root', 'root');
            return self::$conn;
        } else {
            return self::$conn;
        }
    }
}
?>