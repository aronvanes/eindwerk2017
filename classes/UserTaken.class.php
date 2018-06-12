<?php
/**
 * Created by PhpStorm.
 * User: Aron
 * Date: 12-6-2018
 * Time: 14:06
 */

class UserTaken
{
private $user_id;
private $taak_id;
private $completed;

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
    public function getCompleted()
    {
        return $this->completed;
    }

    /**
     * @param mixed $completed
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;
    }

    public function SaveTaak()
    {
        $conn = Db::getInstance();

        $statement = $conn->prepare("INSERT INTO tbl_taken_users (taak_id, user_id) VALUES (:iduser, :idtaak)");
        $statement->bindValue(":iduser", $_POST['user_id']);
        $statement->bindValue(":idmodule", $_POST["module_id"]);
        return $statement->execute();
    }
}