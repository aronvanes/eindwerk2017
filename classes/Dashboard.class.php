<?php
include_once("Db.class.php");

class Dashboard{
    private $id;

public function GetPatienten()
    {
    $conn = Db::getInstance();
    $statement = $conn->prepare("select * from tbl_users_relationship where user_id_origin = $id");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

    /**
     * Get the value of profielfoto
     */
    public function getProfielfoto()
    {
        return $this->profielfoto;
    }

    /**
     * Set the value of profielfoto
     *
     * @return  self
     */
    public function setProfielfoto($profielfoto)
    {
        $this->profielfoto = $profielfoto;

        return $this;
    }
    public function getProfielfotoUser() {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM tbl_users WHERE rol = 3");
        return ($statement->execute());
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}