<?php
/**
 * Created by PhpStorm.
 * User: Aron
 * Date: 10-6-2018
 * Time: 20:40
 */
include_once("Db.class.php");
class UserTaak
{
    private $id;
    private $user_id;
    private $taak_id;

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


    public function Save()
    {
        $conn = Db::getInstance();

        $statement = $conn->prepare("INSERT INTO tbl_taken_users (taak_id, user_id) VALUES (:iduser, :idtaak)");
        $statement->bindValue(":iduser", $_POST['user_id']);
        $statement->bindValue(":idtaak", $_POST["taak_id"]);
        return $statement->execute();
    }
}
