<?php
include_once("Db.class.php");
include_once("User.class.php");

class AppUser extends User {

  // Required inputs
  protected $usernaam;
  protected $voornaam;
  protected $wachtwoord;
  protected $rol;

  // Optional inputs
  protected $achternaam;
  protected $geboorteDatum;
  protected $woonplaats;
  protected $tewerkgesteld;
  protected $sector;
  protected $jobtitel;

  public function __construct(){
    $this->rol = 3;
  }

  public function setUsernaam($value){
    $this->usernaam = $value;
  }

  public function setVoornaam($value){
    $this->voornaam = $value;
  }

  public function setWachtwoord($value){
    $this->wachtwoord = $value;
  }

  public function setRol($value){
    $this->rol = $value;
  }

  public function setAchternaam($value){
    $this->achternaam = $value;
  }

  public function setGeboorteDatum($value){
    $this->geboorteDatum = $value;
  }

  public function setWoonplaats($value){
    $this->woonplaats = $value;
  }

  public function setTewerkgesteld($value){
    $this->tewerkgesteld = $value;
  }

  public function setSector($value){
    $this->sector = $value;
  }

  public function setJobTitel($value){
    $this->jobTitel = $value;
  }

  public function login(){
    $conn = Db::getInstance();

    $statement = $conn->prepare("SELECT id, usernaam, wachtwoord FROM tbl_users WHERE usernaam = :usernaam");
    $statement->bindValue(':usernaam', $this->usernaam);

    if ($statement->execute()){
      $foundUser = $statement->fetch(PDO::FETCH_OBJ);

      // echo (password_verify($this->wachtwoord, $foundUser->wachtwoord));
      // echo ($this->wachtwoord);
      // echo ($foundUser->wachtwoord);

      if (password_verify($this->wachtwoord, $foundUser->wachtwoord)){
        return true;
      } else {
        return 'Wachtwoord niet herkent';
      }

    } else {
      return 'Deze gebruiker bestaat niet';
    };
  }

  public function register(){
    $conn = Db::getInstance();

    $statement = $conn->prepare('INSERT INTO  tbl_users (usernaam, voornaam, achternaam, wachtwoord, rol) VALUES (:usernaam, :voornaam, :achternaam, :wachtwoord, :rol)');
    $statement->bindValue(':usernaam', $this->usernaam);
    $statement->bindValue(':voornaam', $this->voornaam);
    $statement->bindValue(':achternaam', $this->achternaam);
    $statement->bindValue(':wachtwoord', password_hash($this->wachtwoord, PASSWORD_DEFAULT));
    $statement->bindValue(':rol', $this->rol);

    return $statement->execute();
  }
}
