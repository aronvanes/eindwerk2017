<?php
/**
 * Created by PhpStorm.
 * User: Aron
 * Date: 10-6-2018
 * Time: 20:40
 */
include_once("Db.class.php");
class UserModule
{
    private $id;
    private $user_id;
    private $module_id;
    private $taak_id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

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
    public function getTaakId()
    {
        return $this->taak_id;
    }

    /**
     * @param mixed $taak_id
     */
    public function setTaakId($taak_id)
    {
        $this->taak_id = $taak_id;
    }

    public function Save()
    {
        $conn = Db::getInstance();

        $statement = $conn->prepare("INSERT INTO tbl_users_module (module_id, user_id) VALUES (:iduser, :idmodule)");
        $statement->bindValue(":iduser", $_POST['user_id']);
        $statement->bindValue(":idmodule", $_POST["module_id"]);
        return $statement->execute();
    }


    public function SaveTakenToUser($taak_id)
    {
        $conn = Db::getInstance();

        $statement = $conn->prepare("INSERT INTO tbl_taken_users (taak_id, user_id) VALUES (id, :iduser :module_id) select (id) from tbl_taken where (module_id = :idmodule ) ");
        $statement->bindValue(":iduser", $_POST['user_id']);
        $statement->bindValue(":idmodule", $_POST["module_id"]);
        return $statement->execute();
    }



}