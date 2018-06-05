<?php
include_once("Db.class.php");
include_once("User.class.php");

class AppUser extends User {
  protected $usernaam;
  protected $voornaam;
  protected $achternaam;
  protected $email;
  protected $wachtwoord;
  protected $rol;

  public function __construct($email, $password){
    this.$usernaam = $email;
    this.$voornaam = 'John';
    this.$achternaam = 'Doe';
    this.$email = $email;
    this.$wachtwoord = $password;
    this.$rol = 0;
  }

  private function isConstructed(){
    if (!empty(this.$usernaam)){
      return true;
    } else {
      return false;
    }
  }

  if (isConstructed){
    public function getEmail(){
      return this.$email;
    }
  }
}

 ?>
