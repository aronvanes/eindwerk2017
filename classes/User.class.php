<?php
include_once("Db.class.php");

class User {
    private $usernaam;
    private $voornaam;
    private $achternaam;
    private $email;
    private $wachtwoord;
    private $rol;
    //private $userid;
    
    /**
     * Get the value of usernaam
     */ 
    public function getUsernaam()
    {
        return $this->usernaam;
    }

    /**
     * Set the value of usernaam
     *
     * @return  self
     */ 
    public function setUsernaam($usernaam)
    {
        $this->usernaam = $usernaam;

        return $this;
    }

    /**
     * Get the value of voornaam
     */ 
    public function getVoornaam()
    {
        return $this->voornaam;
    }

    /**
     * Set the value of voornaam
     *
     * @return  self
     */ 
    public function setVoornaam($voornaam)
    {
        $this->voornaam = $voornaam;

        return $this;
    }

    /**
     * Get the value of achternaam
     */ 
    public function getAchternaam()
    {
        return $this->achternaam;
    }

    /**
     * Set the value of achternaam
     *
     * @return  self
     */ 
    public function setAchternaam($achternaam)
    {
        $this->achternaam = $achternaam;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of wachtwoord
     */ 
    public function getWachtwoord()
    {
        return $this->wachtwoord;
    }

    /**
     * Set the value of wachtwoord
     *
     * @return  self
     */ 
    public function setWachtwoord($wachtwoord)
    {
        if (strlen($wachtwoord) < 8){
            throw new Exception("Password must be at least 8 charachters long");
        }
        $hash = password_hash($wachtwoord, PASSWORD_DEFAULT);
        $this->wachtwoord = $hash;
        return $this;
    }

    /**
     * Get the value of rol
     */ 
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set the value of rol
     *
     * @return  self
     */ 
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }


    /**
     * Get the value of userid
     */ 
   /* public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set the value of userid
     *
     * @return  self
     */ 
    /*public function setUserid($userid)
    {
        $this->userid = $userid;

        return $this;
    }
*/
    public function register(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO tbl_users (usernaam, voornaam, achternaam, wachtwoord, rol) 
        VALUES (:usernaam, :voornaam, :achternaam, :wachtwoord, :rol)");
        $statement->bindParam(':usernaam', $this->usernaam);
        $statement->bindParam(':voornaam', $this->voornaam);
        $statement->bindParam(':achternaam', $this->achternaam);
        $statement->bindParam(':rol', $this->rol);
        $statement->bindParam(':wachtwoord', $this->wachtwoord);
        $result = $statement->execute();
        return $result;
}
public function login(){
    
    $conn = Db::getInstance();
    $statement = $conn->prepare("select * from tbl_users where usernaam = :usernaam");
    $statement->bindParam(":usernaam", $this->usernaam);
    $statement->execute();
    $result = $statement->fetch();

    $this->setUserid($result["id"]);
    
    if( password_verify($this->password_login, $result['wachtwoord'])){
        return true;
    }
    else {
        return false;
    }

}

}