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

    public function Save()
    {
        $conn = Db::getInstance();

        $statement = $conn->prepare("INSERT INTO tbl_users_module (module_id, user_id) VALUES (:iduser, :idmodule)");
        $statement->bindValue(":iduser", $_POST['postID2']);
        $statement->bindValue(":idmodule", $_POST["postID"]);
        return $statement->execute();
    }
}