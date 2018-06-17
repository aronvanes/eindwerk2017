<?php
include_once("Db.class.php");

class Profiel {
    private $users_id;
    private $geboortedatum;
    private $woonplaats;
    private $tewerkgesteld;
    private $jobtitel;
    private $functie;

    /**
     * Get the value of users_id
     */ 
    public function getUsers_id()
    {
        return $this->users_id;
    }

    /**
     * Set the value of users_id
     *
     * @return  self
     */ 
    public function setUsers_id($users_id)
    {
        $this->users_id = $users_id;

        return $this;
    }

    /**
     * Get the value of geboortedatum
     */ 
    public function getGeboortedatum()
    {
        return $this->geboortedatum;
    }

    /**
     * Set the value of geboortedatum
     *
     * @return  self
     */ 
    public function setGeboortedatum($geboortedatum)
    {
        $this->geboortedatum = $geboortedatum;

        return $this;
    }

    /**
     * Get the value of woonplaats
     */ 
    public function getWoonplaats()
    {
        return $this->woonplaats;
    }

    /**
     * Set the value of woonplaats
     *
     * @return  self
     */ 
    public function setWoonplaats($woonplaats)
    {
        $this->woonplaats = $woonplaats;

        return $this;
    }

    /**
     * Get the value of tewerkgesteld
     */ 
    public function getTewerkgesteld()
    {
        return $this->tewerkgesteld;
    }

    /**
     * Set the value of tewerkgesteld
     *
     * @return  self
     */ 
    public function setTewerkgesteld($tewerkgesteld)
    {
        $this->tewerkgesteld = $tewerkgesteld;

        return $this;
    }

    /**
     * Get the value of jobtitel
     */ 
    public function getJobtitel()
    {
        return $this->jobtitel;
    }

    /**
     * Set the value of jobtitel
     *
     * @return  self
     */ 
    public function setJobtitel($jobtitel)
    {
        $this->jobtitel = $jobtitel;

        return $this;
    }

    /**
     * Get the value of functie
     */ 
    public function getFunctie()
    {
        return $this->functie;
    }

    /**
     * Set the value of functie
     *
     * @return  self
     */ 
    public function setFunctie($functie)
    {
        $this->functie = $functie;

        return $this;
    }
    public function Profiel(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO tbl_users_extra (users_id, geboortedatum, woonplaats, tewerkgesteld, jobtitel, functie)
        VALUES (:users_id, :geboortedatum, :woonplaats, :tewerkgesteld, :jobtitel, :functie)");
        $statement->bindParam(':users_id', $this->users_id);
        $statement->bindParam(':geboortedatum', $this->geboortedatum);
        $statement->bindParam(':woonplaats', $this->woonplaats);
        $statement->bindParam(':tewerkgesteld', $this->tewerkgesteld);
        $statement->bindParam(':jobtitel', $this->jobtitel);
        $statement->bindParam(':functie', $this->functie);
        $result = $statement->execute();
        return $result;
}
}