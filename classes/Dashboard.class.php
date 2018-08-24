<?php
include_once("Db.class.php");

class Dashboard{
public function GetPatienten()
    {
        $conn = Db::getInstance();

        $statement = $conn->prepare("SELECT * FROM tbl_users WHERE rol = 3");
        return $statement->execute();
    }
}