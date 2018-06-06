<?php
include_once("Db.class.php");
include_once("User.class.php");

class AppUser extends User {
  protected $usernaam;
  protected $voornaam;
  protected $achternaam;
  protected $wachtwoord;
  protected $rol;

  public function __construct($username, $password){
    $this->usernaam = $username;
    $this->wachtwoord = $password;
    $this->voornaam = 'John';
    $this->achternaam = 'Doe';
    $this->rol = 0;
  }

  // public function login(){
  //   $conn = Db::getInstance();
  //
  //   $statement = $conn->prepare("SELECT id, usernaam, wachtwoord FROM tbl_users WHERE usernaam = :usernaam");
  //   $statement->bindValue(':usernaam', $this->usernaam);
  //
  //   if($statement->execute()){
  //     $foundUser = $statement->fetch(PDO::FETCH_OBJ);
  //
  //     if($foundUser->wachtwoord === $this->wachtwoord){
  //       return true
  //     } else {
  //       throw new Exception("Wachtwoord komt niet overeen", 1);
  //     }
  //     // if(password_verify($passwordAttempt, $user['wachtwoord'])){}
  //
  //   } else {
  //     throw new Exception("Deze gebruiker bestaat niet.", 1);
  //   };
  // }

  public function login(){
    return 'kakahoofd';
  }
}
