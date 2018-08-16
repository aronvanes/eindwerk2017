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
    if(!is_null($value)){
      $date = DateTime::createFromFormat('d-m-Y', $value);
      if(!$date){
        $this->geboorteDatum = date('Y-m-d');
      } else {
        $this->geboorteDatum = date('Y-m-d', $date->getTimeStamp());
      }
    }
  }

  public function getGeboorteDatum(){
    return $this->geboorteDatum;
  }

  public function setWoonplaats($value){
    if(!is_null($value)){
      $this->woonplaats = $value;
    }
  }

  public function setTewerkgesteld($value){
    if ($value === 'false' || is_null($value)){
      $this->tewerkgesteld = false;
    } else {
      $this->tewerkgesteld = true;
    }
  }

  public function setSector($value){
    if(!is_null($value)){
      $this->sector = $value;
    }
  }

  public function setJobTitel($value){
    if(!is_null($value)){
      $this->jobTitel = $value;
    }
  }

  public function login(){
    $conn = Db::getInstance();

    $statement = $conn->prepare("SELECT id, usernaam, wachtwoord FROM tbl_users WHERE usernaam = :usernaam");
    $statement->bindValue(':usernaam', $this->usernaam);

    if ($statement->execute()){
      $foundUser = $statement->fetch(PDO::FETCH_OBJ);

      if (password_verify($this->wachtwoord, $foundUser->wachtwoord)){
        return $foundUser->id;
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

    if($statement->execute()){
      if (
        !empty($this->geboorteDatum) ||
        !empty($this->woonplaats) ||
        !empty($this->tewerkgesteld) ||
        !empty($this->sector) ||
        !empty($this->jobTitel)){
          $affected_user = $conn->lastInsertId();

          $extraInfoStatement = $conn->prepare('INSERT INTO tbl_users_extra (users_id, geboortedatum, woonplaats, tewerkgesteld, jobtitel, sector) VALUES (:users_id, :geboortedatum, :woonplaats, :tewerkgesteld, :jobtitel, :sector)');
          $extraInfoStatement->bindValue(':users_id', $affected_user);
          $extraInfoStatement->bindValue(':geboortedatum', $this->geboorteDatum);
          $extraInfoStatement->bindValue(':woonplaats', $this->woonplaats);
          $extraInfoStatement->bindValue(':tewerkgesteld', $this->tewerkgesteld);
          $extraInfoStatement->bindValue(':jobtitel', $this->jobTitel);
          $extraInfoStatement->bindValue(':sector', $this->sector);

          if ($extraInfoStatement->execute()){
            return $affected_user;
          } else {
            return 'Er was een probleem met het invoegen van extra informatie: '.print_r($conn->errorInfo());
          }
        } else {
          return true;
        }
    } else {
      return false;
    }
  }
}
