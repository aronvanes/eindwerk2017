<?php
include_once("Db.class.php");

class UserInfo{
    private $id;

    public function getId()
    {
            return $this->id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */ 
    public function setId($id)
    {
            $this->id = htmlspecialchars($id);
            return $this;
    }

public function getUserInfo() {
                //DB CONNECTIE
                $conn = Db::getInstance();

                //QUERY WHERE USER = $_SESSION
                $statement = $conn->prepare("SELECT * FROM tbl_users WHERE id = :id LIMIT 1");
                $statement->bindParam(":id", $this->id);
                $statement->execute();
                $result = $statement->fetch();
                return $result;
        }

public function getPatientModule(){
    $conn = Db::getInstance();

    //QUERY WHERE USER = $_SESSION
    $statement = $conn->prepare("SELECT module_id FROM tbl_users_module 
    INNER JOIN tbl_users ON tbl_users.id = tbl_users_module.user_id");
    $statement->bindParam(":id", $this->id);
    $statement->execute();
    $result = $statement->fetch();
    return $result;
}
public function getPatientModuleExtra(){
    $conn = Db::getInstance();

    //QUERY WHERE USER = $_SESSION
    $statement = $conn->prepare("SELECT * FROM tbl_users_module 
    INNER JOIN tbl_users ON tbl_users.id = tbl_users_module.user_id
    INNER JOIN tbl_module ON tbl_module.id = tbl_users_module.module_id");
    $statement->bindParam(":id", $this->id);
    $statement->execute();
    $result = $statement->fetch();
    return $result;
}

public function getPatientTaak(){
    $conn = Db::getInstance();

    //QUERY WHERE USER = $_SESSION
    $statement = $conn->prepare("SELECT * FROM tbl_taken_users 
    WHERE user_id = :id LIMIT 1");
    $statement->bindParam(":id", $this->id);
    $statement->execute();
    $result = $statement->fetch();
    return $result;
}
    }