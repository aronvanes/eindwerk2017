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
        $statement = $conn->prepare("SELECT * FROM tbl_taken WHERE module_id = ");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}