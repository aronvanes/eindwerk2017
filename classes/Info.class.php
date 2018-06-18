<?php
include_once("Db.class.php");

class Info {
    private $geboortedatum;
    private $specialisatie;
    private $aantaljaar;
    private $praktijk;
    private $registratienummer;

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
     * Get the value of specialisatie
     */ 
    public function getSpecialisatie()
    {
        return $this->specialisatie;
    }

    /**
     * Set the value of specialisatie
     *
     * @return  self
     */ 
    public function setSpecialisatie($specialisatie)
    {
        $this->specialisatie = $specialisatie;

        return $this;
    }

    /**
     * Get the value of aantaljaar
     */ 
    public function getAantaljaar()
    {
        return $this->aantaljaar;
    }

    /**
     * Set the value of aantaljaar
     *
     * @return  self
     */ 
    public function setAantaljaar($aantaljaar)
    {
        $this->aantaljaar = $aantaljaar;

        return $this;
    }

    /**
     * Get the value of praktijk
     */ 
    public function getPraktijk()
    {
        return $this->praktijk;
    }

    /**
     * Set the value of praktijk
     *
     * @return  self
     */ 
    public function setPraktijk($praktijk)
    {
        $this->praktijk = $praktijk;

        return $this;
    }

    /**
     * Get the value of registratienummer
     */ 
    public function getRegistratienummer()
    {
        return $this->registratienummer;
    }

    /**
     * Set the value of registratienummer
     *
     * @return  self
     */ 
    public function setRegistratienummer($registratienummer)
    {
        $this->registratienummer = $registratienummer;

        return $this;
    }
    public function Profiel(){
    $conn = Db::getInstance();
    $statement = $conn->prepare("INSERT INTO tbl_users_extra (geboortedatum, specialisatie, aantaljaar, praktijk, registratienummer)
    VALUES (:geboortedatum, :specialisatie, :aantaljaar, :praktijk, :registratienummer)");
    //$statement->bindParam(':users_id', $this->users_id);
    $statement->bindParam(':geboortedatum', $this->geboortedatum);
    $statement->bindParam(':specialisatie', $this->specialisatie);
    $statement->bindParam(':aantaljaar', $this->aantaljaar);
    $statement->bindParam(':praktijk', $this->praktijk);
    $statement->bindParam(':registratienummer', $this->registratienummer);
    $result = $statement->execute();
    return $result;
}
}