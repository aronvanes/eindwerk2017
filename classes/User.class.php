<?php
include_once("Db.class.php");

class User {
    private $usernaam;
    private $voornaam;
    private $achternaam;
    private $wachtwoord;
    private $rol;
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
        $this->usernaam = $usernaam;

        return $this;
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
        $this->voornaam = $voornaam;

        return $this;
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
        $this->achternaam = $achternaam;

        return $this;
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
        if (strlen($wachtwoord) < 8){
            throw new Exception("Password must be at least 8 charachters long");
        }
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
public function Patient(){
    $conn = Db::getInstance();
    $statement = $conn->prepare("select * from tbl_users where rol = 1");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
public function Level(){
    $conn = Db::getInstance();
    $statement = $conn->prepare("select * from tbl_module");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
public function Categorie(){
    $conn = Db::getInstance();
    $statement = $conn->prepare("select * from tbl_module");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
}
