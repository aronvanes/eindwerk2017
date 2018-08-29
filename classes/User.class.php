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


    /**
     * Get the value of userid
     */
   /* public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set the value of userid
     *
     * @return  self
     */
    /*public function setUserid($userid)
    {
        $this->userid = $userid;

        return $this;
    }
*/
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
public function login()
{
    if (!empty($_POST)) {

        try {

            //Retrieve the field values from our login form.
            $usernaam = $_POST['usernaam'];
            $passwordAttempt = $_POST['wachtwoord'];

            //Retrieve the user account information for the given username.
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT id, usernaam, wachtwoord FROM tbl_users WHERE usernaam = :usernaam");

            //Bind value.
            $statement->bindValue(':usernaam', $usernaam);

            //Execute.
            $statement->execute();

            //Fetch row.
            $user = $statement->fetch(PDO::FETCH_ASSOC);


            //If $row is FALSE.
            if ($user === false) {
                //Could not find a user with that username!

                $error = "Incorrect username ";
            } else {
                //User account found. Check to see if the given password matches the
                //password hash that we stored in our users table.

                //Compare the passwords.
                $validPassword = password_verify($passwordAttempt, $user['wachtwoord']);

                //If $validPassword is TRUE, the login has been successful.
                if ($validPassword) {
                    //Provide the user with a login session.
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['logged_in'] = time();
                    $_SESSION['usernaam'] = $_POST["usernaam"];


                    header("Location: dashboard.php");

                } else {
                    //$validPassword was FALSE. Passwords do not match.
                    $error = "Incorrect email and/or password";

                }
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
}
public function getSearchText()
{
    return $this->searchText;
}

/**
 * Set the value of searchText
 *
 * @return  self
 */
public function setSearchText($searchText)
{
    $this->searchText = $searchText;

    return $this;
}
public function Search($var1){
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM tbl_users WHERE 'voornaam'
             LIKE :search OR 'voornaam' LIKE :search");
             $statement->bindValue(':search', '%' . $this->searchText. '%', PDO::PARAM_INT);
             $statement->execute();
             return $statement->fetchAll(PDO::FETCH_ASSOC);
}

public function Patient(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("select * from tbl_users where rol = 3");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
public function Module()
{
    $conn = Db::getInstance();

    $statement = $conn->prepare("SELECT * FROM tbl_users_module");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
public function Schema()
{
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

}