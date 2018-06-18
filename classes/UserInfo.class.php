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
    }