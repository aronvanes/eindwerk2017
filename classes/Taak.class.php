<?php
/**
 * Created by PhpStorm.
 * User: Aron
 * Date: 10-6-2018
 * Time: 20:40
 */
include_once("Db.class.php");
class Taak
{
    private $module_id;
    private $naam;
    private $beschrijving;

    /**
     * @return mixed
     */
    public function getModuleId()
    {
        return $this->module_id;
    }

    /**
     * @param mixed $module_id
     */
    public function setModuleId($module_id)
    {
        $this->module_id = $module_id;
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
     * @param mixed $beschrijving
     */
    public function setBeschrijving($beschrijving)
    {
        $this->beschrijving = $beschrijving;
    }

    public function SelectAllTakenPerModule(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM tbl_taken WHERE module_id = :module_id");
        $statement->bindValue(":module_id", $this->module_id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getTakenPerModule($module_id){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM tbl_taken INNER JOIN tbl_taken_users ON tbl_taken.id = tbl_taken_users.taak_id WHERE module_id = :module_id");
        $statement->bindValue(":module_id", $module_id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public static function setTaskCompleted($task_id, $completed){
      $conn = Db::getInstance();
      $statement = $conn->prepare("UPDATE tbl_taken_users SET completed = :completed WHERE taak_id = :taak_id");
      $statement->bindValue(":completed", $completed);
      $statement->bindValue(":taak_id", $task_id);
      if($statement->execute()){
        return true;
      };
    }

    public static function getCompletedTasksPerCategory($user_id){
      $conn = Db::getInstance();
      $statement = $conn->prepare('SELECT COUNT(ttu.id) AS total, tc.categorie_naam FROM tbl_taken_users as ttu RIGHT JOIN tbl_taken as tt ON ttu.taak_id = tt.id RIGHT JOIN tbl_module as tm ON tt.module_id = tm.id RIGHT JOIN tbl_categorien as tc ON tm.categorie = tc.id WHERE ttu.completed = 1 AND ttu.user_id = :user_id GROUP BY tm.categorie');
      $statement->bindValue(':user_id', $user_id);
      if ($statement->execute()){
        return $statement->fetchAll(PDO::FETCH_OBJ);
      }
    }
    public function CreateTaak(){

        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO tbl_taken (naam, beschrijving, module_id)
        VALUES (:naam, :beschrijving, :module_id)");
        $statement->bindParam(':naam', $this->naam);
        $statement->bindParam(':beschrijving', $this->beschrijving);
        $statement->bindParam(':module_id', $this->module_id);
        $result = $statement->execute();
        return $result;
    }
}
