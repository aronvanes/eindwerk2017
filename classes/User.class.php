<?php
include_once("Db.class.php");

class User {
    private $id;
    private $usernaam;
    private $voornaam;
    private $achternaam;
    private $wachtwoord;
    private $rol;
    private $searchText;
    private $profielfoto;

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
    //private $userid;

    /**
     * Get the value of usernaam
     */
    public function getUsernaam()
    {
        return $this->usernaam;
    }

    /**
     * Set the value of usernaam
     *
     * @return  self
     */

    public function setUsernaam($usernaam)
    {
        if (empty($usernaam)){
            throw new Exception("Gelieve alle velden in te vullen");
       }
       else {
        $this->usernaam = $usernaam;

        return $this;
        }
    }

    /**
     * Get the value of voornaam
     */
    public function getVoornaam()
    {
        return $this->voornaam;
    }

    /**
     * Set the value of voornaam
     *
     * @return  self
     */
    public function setVoornaam($voornaam)
    {
        if (empty($voornaam)){
            throw new Exception("Gelieve alle velden in te vullen");
       }
       else {
        $this->voornaam = $voornaam;

        return $this;
        }
    }

    /**
     * Get the value of achternaam
     */
    public function getAchternaam()
    {
        return $this->achternaam;
    }

    /**
     * Set the value of achternaam
     *
     * @return  self
     */
    public function setAchternaam($achternaam)
    {
        if (empty($achternaam)){
                 throw new Exception("Gelieve alle velden in te vullen");
            }
        else {
        $this->achternaam = $achternaam;

        return $this;
    }
    }

    /**
     * Get the value of email
     */
    /**
     * Get the value of wachtwoord
     */
    public function getWachtwoord()
    {
        return $this->wachtwoord;
    }

    /**
     * Set the value of wachtwoord
     *
     * @return  self
     */
    public function setWachtwoord($wachtwoord)
    {
        // if (strlen($wachtwoord) < 8 || preg_match('/\d+/', $wachtwoord, PREG_UNMATCHED_AS_NUL) != null){
        //     throw new Exception("Password must be at least 8 charachters long and consist of one number");
        // }
        // $hash = password_hash($wachtwoord, PASSWORD_DEFAULT);
        // $this->wachtwoord = $hash;
        // return $this;
        //if (strlen($wachtwoord) < 8 || preg_match('/\d+/', $wachtwoord, PREG_UNMATCHED_AS_NUL) != null){
            //throw new Exception("Password must be at least 8 charachters long and consist of one number");
       // }
        $hash = password_hash($wachtwoord, PASSWORD_DEFAULT);
        $this->wachtwoord = $hash;
        return $this;
    }

    /**
     * Get the value of rol
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set the value of rol
     *
     * @return  self
     */
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }

    public function getSearchText()
    {
        return $this->searchText;
    }

    public function setSearchText($searchText)
    {
        $this->searchText = $searchText;

        return $this;
    }

    public function register(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO tbl_users (usernaam, voornaam, achternaam, wachtwoord, rol)
        VALUES (:usernaam, :voornaam, :achternaam, :wachtwoord, :rol)");
        $statement->bindParam(':usernaam', $this->usernaam);
        $statement->bindParam(':voornaam', $this->voornaam);
        $statement->bindParam(':achternaam', $this->achternaam);
        $statement->bindParam(':rol', $this->rol);
        $statement->bindParam(':wachtwoord', $this->wachtwoord);
        $result = $statement->execute();
        return $result;
    }

    public function login($temp_wachtwoord) {
      $conn = Db::getInstance();

      $statement = $conn->prepare('SELECT * FROM tbl_users WHERE usernaam = :usernaam');
      $statement->bindParam(':usernaam', $this->usernaam);

      if ($statement->execute()){
        $res = $statement->fetch(PDO::FETCH_OBJ);

        if (password_verify($temp_wachtwoord, $res->wachtwoord)){
          return $res;
        } else {
          return false;
        }
      } else {
        return false;
      }
    }


    public function Search(){
      $conn = Db::getInstance();
      $statement = $conn->prepare("SELECT * FROM tbl_users WHERE voornaam
       LIKE :search OR achternaam LIKE :search");
       $statement->bindValue(':search', '%' . $this->searchText. '%', PDO::PARAM_INT);
       $statement->execute();
       return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPatientsByTherapist(){
      $conn = Db::getInstance();
      $statement = $conn->prepare('SELECT u.id, u.voornaam, u.achternaam, u.profielfoto FROM tbl_users AS u INNER JOIN tbl_users_relationship AS ur ON u.id = ur.user_id_origin WHERE ur.user_id_destination = :user_id AND rol = 3');
      $statement->bindParam(':user_id', $this->id);

      if ($statement->execute()) {
        return $statement->fetchAll(PDO::FETCH_ASSOC);
      }
    }

    public function Module() {
      $conn = Db::getInstance();
      $statement = $conn->prepare("SELECT * FROM tbl_users_module");
      $statement->execute();
      return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Schema() {
      $conn = Db::getInstance();
      $statement = $conn->prepare("SELECT 'voornaam', 'achternaam', 'module_id'
      FROM tbl_users
      INNER JOIN tbl_users_module ON tbl_users.id = tbl_users_module.user_id
      INNER JOIN tbl_taken_users ON tbl_users.id = tbl_taken_users.user_id
      where tbl_users.rol = 3;");
      $statement->execute();
      return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function SetModuleToPatient2(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO tbl_users_module(user_id) values (id = :id)");
        $statement->bindParam(':id', $_POST['postID2']);
        $result = $statement->execute();
        return $result;
    }

    public static function connectPatientToTherapist($id, $u_key){
      $conn = Db::getInstance();

      $appended_u_key = $u_key.'_pending_'.$id;

      $statement = $conn->prepare('UPDATE tbl_users SET u_key = :appended_u_key WHERE u_key = :u_key');
      $statement->bindParam(':appended_u_key', $appended_u_key);
      $statement->bindParam(':u_key', $u_key);

      return ($statement->execute());
    }

    public function getUserById(){
      $conn = Db::getInstance();

      $statement = $conn->prepare('SELECT id, voornaam, achternaam, profielfoto FROM tbl_users WHERE id = :id');
      $statement->bindParam(':id', $this->id);

      if ($statement->execute()){
        return $statement->fetch(PDO::FETCH_OBJ);
      }
    }
    public function getCurrentUser(){
        $conn = Db::getInstance();

        $statement = $conn->prepare('SELECT id, voornaam, achternaam, profielfoto FROM tbl_users WHERE id = :id');
        $statement->bindParam(':id', $_SESSION['id']);

        if ($statement->execute()){
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
    }
    public function getPsychoInfo(){
        $conn = Db::getInstance();

        $statement = $conn->prepare('SELECT voornaam, achternaam FROM tbl_users WHERE id = :id');
        $statement->bindParam(':id', $this->id);

        if ($statement->execute()){
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
    }
    public function getPsychoInfoExtra(){
        $conn = Db::getInstance();

        $statement = $conn->prepare('SELECT geboortedatum, woonplaats, jobtitel, sector, specialisatie FROM tbl_users_extra WHERE users_id = :id');
        $statement->bindParam(':id', $this->id);

        if ($statement->execute()){
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
    }


    public static function setConnectionPatientTherapist($patient_id, $therapist_id){
      $conn = Db::getInstance();
      $statement = $conn->prepare('INSERT INTO tbl_users_relationship (user_id_origin, user_id_destination) VALUES (:patient_id, :therapist_id)');
      $statement->bindParam(':patient_id', $patient_id);
      $statement->bindParam(':therapist_id', $therapist_id);

      if ($statement->execute()){
        $statement_two = $conn->prepare('INSERT INTO tbl_users_relationship (user_id_origin, user_id_destination) VALUES (:therapist_id, :patient_id)');
        $statement_two->bindParam(':therapist_id', $therapist_id);
        $statement_two->bindParam(':patient_id', $patient_id);

        if ($statement_two->execute()){
          return true;
        } else {
          return 'Statement two has failed.';
        }
      } else {
        return 'Statement one has failed.';
      }
    }

    /**
     * Get the value of profielfoto
     */
    public function getProfielfoto()
    {
        return $this->profielfoto;
    }

    /**
     * Set the value of profielfoto
     *
     * @return  self
     */
    public function setProfielfoto($profielfoto)
    {
        $this->profielfoto = $profielfoto;

        return $this;
    }
    public function getProfielfotoUser() {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT profielfoto FROM tbl_users WHERE rol = 3");
        $result = $statement->execute();
        return $result;
    }

    public static function connectPatientToModule($patient_id, $module_id){
      $conn = Db::getInstance();

      $statement = $conn->prepare('SELECT * FROM tbl_taken WHERE module_id = :module_id');
      $statement->bindParam(':module_id', $module_id);

      if($statement->execute()){
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($res as $query) {

          $connect = $conn->prepare('INSERT INTO tbl_taken_users (user_id, taak_id, completed) VALUES (:user_id, :taak_id, 0)');
          $connect->bindParam(':user_id', $patient_id);
          $connect->bindParam(':taak_id', $query['id']);

          $connect->execute();
        }
      } else {
        echo 'niet gelukt';
      }
    }

    public static function checkIfModuleIsAlreadyConnected($patient_id, $module_id){
      $conn = Db::getInstance();

      $statement = $conn->prepare('SELECT * FROM tbl_users_module AS um INNER JOIN tbl_module AS m ON um.module_id = m.id where um.module_id = :module_id AND um.user_id = :patient_id AND m.completed = 0');
      $statement->bindParam(':module_id', $module_id);
      $statement->bindParam(':patient_id', $patient_id);

      if ($statement->execute()){
        return $statement->fetchAll(PDO::FETCH_ASSOC);
      }
    }
}
