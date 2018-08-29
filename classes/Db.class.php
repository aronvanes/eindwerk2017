<?php
class Db
{
   private static $conn;
   public static function getInstance(){
       // self::$conn = new PDO('mysql:host=localhost;dbname=db_mal', "root", "root");
       self::$conn = new PDO('mysql:host=localhost;dbname=db_mal', "root", "");
       //self::$conn = new PDO('mysql:host=buildingrockets.be.mysql;dbname=buildingrockets_be_db_mal', "buildingrockets_be_db_mal", "mal_admin");
           return self::$conn;
       }
}
?>
