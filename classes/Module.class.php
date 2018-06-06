<?php
include_once("Db.class.php");

class Module {

    private $id;
    private $naam;
    private $beschrijving;
    private $categorie;
    private $view_level;/**
 * @return mixed
 */
public function getId()
{
    return $this->id;
}

    /**
     * @return mixed
     */
    public function getNaam()
    {
        return $this->naam;
    }

    /**
     * @param mixed $naam
     */
    public function setNaam($naam)
    {
        $this->naam = $naam;
    }

    /**
     * @return mixed
     */
    public function getBeschrijving()
    {
        return $this->beschrijving;
    }

    /**
     * @param mixed $Besvhrijving
     */
    public function setBeschrijving($beschrijving)
    {
        $this->beschrijving = $beschrijving;
    }
    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @return mixed
     */
    public function getViewLevel()
    {
        return $this->view_level;
    }

    /**
     * @param mixed $view_level
     */
    public function setViewLevel($view_level)
    {
        $this->view_level = $view_level;
    }



    public function GetAllInteractieModules(){

      $conn = Db::getInstance();
      $statement = $conn->prepare("SELECT * FROM tbl_module WHERE categorie = 1");
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
  }

    public function CreateModule(){

        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO tbl_module(naam, beschrijving, categorie, view_level) 
        VALUES (:naam, :beschrijving, :categorie, :view_level)");
        $statement->bindParam(':naam', $this->naam);
        $statement->bindParam(':beschrijving', $this->beschrijving);
        $statement->bindParam(':categorie', $this->categorie);
        $statement->bindParam(':view_level', $this->view_level);
        $result = $statement->execute();
        return $result;
    }
    public function DeleteModule(){

        $conn = Db::getInstance();
        $statement = $conn->prepare("DELETE FROM `tbl_module` WHERE id = :id");
        $statement->bindParam(':id', $this->id);
        $result = $statement->execute();
        return $result;
    }

}