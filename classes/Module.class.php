<?php
include_once("Db.class.php");

class Module {

    private $id;
    private $naam;
    private $beschrijving;
    private $categorie;
    private $view_level;

    /**
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
        return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

    public function GetAllSportModules(){

        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM tbl_module WHERE categorie = 2");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function GetAllSlaapModules(){

        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM tbl_module WHERE categorie = 3");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    public function CreateModule(){

        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO tbl_module (naam, beschrijving, categorie, view_level, completed, start_datum, eind_datum)
        VALUES (:naam, :beschrijving, :categorie, :view_level, 0, CURRENT_TIMESTAMP(), 0000-00-00)");
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

    public function SetModuleToPatient(){

        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO tbl_users_module(module_id) VALUES (id = :id)");
        $statement->bindParam(':id', $_POST["postID"]);
        $result = $statement->execute();
        return $result;
    }

    public static function getModulesPerPatient($user_id){
      $conn = Db::getInstance();
      $statement = $conn->prepare('SELECT * from tbl_module as module INNER JOIN tbl_users_module as u_module ON module.id = u_module.module_id WHERE u_module.user_id = :id AND completed = 0');
      $statement->bindParam(':id', $user_id);

      if ($statement->execute()){
        return $statement->fetch(PDO::FETCH_OBJ);
      }
    }

    public function getCategory(){
      $conn = Db::getInstance();
      $statement = $conn->prepare('SELECT categorie_naam FROM tbl_categorien WHERE id = :id');
      $statement->bindParam(':id', $this->categorie);

      if ($statement->execute()){
        return $statement->fetch(PDO::FETCH_OBJ);
      }
    }

    public static function setModuleCompleted($module_id){
      $conn = Db::getInstance();
      $statement = $conn->prepare('UPDATE tbl_module SET completed = 1, eind_datum = CURRENT_TIMESTAMP() WHERE id = :module_id AND completed = 0' );
      $statement->bindParam(':module_id', $module_id);

      return $statement->execute();
    }

}
