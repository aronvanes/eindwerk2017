<?php 
include_once("classes/User.class.php");

if(!empty($_SESSION["loggedin"])){
    header("Location: index.php");
}
else{
    if(!empty($_POST)){
        $user = new User();
        $user->setEmail($_POST["email"]);
        $user->setPassword_login($_POST["password"]);
        
        //controleren of een gebruiker kan inloggen (functie)
        if ($user->login()){
            session_start();
            // Als login slaagt moet er een session aangemaakt worden van de ingelogde gebruiker
            $_SESSION["user_id"] = $user->getUser_id();
            $_SESSION["loggedin"] = true; 
            header("Location: index.php");
        }
        else{
            //$error = "Foutieve gegevens";
            $error = true;
        }
        // if no -> moet er een $error getoont worden
        // if yes -> naar pagina gebruiker (ingelogd)

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
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>

<body>
  <div class="container">
  <div class="logo"></div>

   <form action="#" method="post">
  <label for="email">Email</label>
    <br>
    <input type="text" name="email" id="email">
    <br>
    <label for="password">Wachtwoord</label>
    <br>
    <input type="password" name="wachtwoord" id="wachtwoord">
    <br>
    <input type="submit" name="button" id="button">
   </form>


  </div>
</body>

</html>
