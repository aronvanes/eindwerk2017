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

  public function __construct($username, $firstname, $lastname, $email, $password, $role){
    this.$usernaam = $username;
    this.$voornaam = $firstname;
    this.$achternaam = $lastname;
    this.$email = $email;
    this.$wachtwoord = $password;
    this.$rol = $role;
  }
}

 ?>
