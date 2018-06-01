<?php 
include_once("classes/User.class.php");
include_once("classes/Db.class.php");

if (!empty($_POST)){
        try {
        $user = new User();
        $user->setUsernaam($_POST['usernaam']);
        $user->setVoornaam($_POST['voornaam']);
        $user->setAchternaam($_POST['achternaam']);
        $user->setRol($_POST['roltherapeut']);
       // $user->setEmail($_POST['email']);
        if($user->register()){
            session_start();
            $_SESSION['usernaam'] = $user->getUsernaam();
            header('location: index.php');
        }
        }
        catch (Exception $e) {
            $message = $e->getMessage();
        }
    }

?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin - Start Bootstrap Template</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

</head>

<body>
  <div class="container">

<div class="logo"></div>

  <form action="#" method="post">
    <input type="text" name="usernaam" id="usernaam" placeholder="Usernaam">
    <br>
    <input type="text" name="voornaam" id="voornaam" placeholder="Voornaam">
    <br>
    <input type="text" name="achternaam" id="achternaam" placeholder="Achternaam">
    <br>
    <input type="text" name="email" id="email" placeholder="Email">
    <br>
    <input type="password" name="wachtwoord" id="wachtwoord" placeholder="Wachtwoord">
    <br>
    <input type="checkbox" name="roltherapeut" id="roltherapeut" checked> Ik ben een therapeut / psycholoog
    <br>
    <input type="checkbox" name="rolpatient" id="rolpatient"> Ik ben een patiënt
    <br>
    <input type="submit" name="button" id="button" placeholder="Registreren">
    <p>Of</p>
    <a id="login" href="login.php">Inloggen</a>
</form>



  </div>
</body>

</html>