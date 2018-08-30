<?php
spl_autoload_register(function($class){
    include_once("classes/" .  $class . ".class.php");
});

session_start();

if(!empty($_SESSION["user_id"])){
    header("Location: index.php");
}
else{
    if(!empty($_POST)){
        $user = new User();
        $user->setUsernaam($_POST["usernaam"]);

        $res = $user->login($_POST['wachtwoord']);

        if ($res){
            session_start();
            $_SESSION["user_id"] = $res->id;
            $_SESSION["usernaam"] = $res->usernaam;
            $_SESSION["voornaam"] = $res->voornaam;
            $_SESSION["achternaam"] = $res->achternaam;
            header("Location: index.php");
        }
        else{
            $error = true;
        }
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
    <title>Mål app - Geestelijke gezondeheidsapp</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/styletwee.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  </head>

  <body>
    <div class="container">
    <div class="logo"></div>
     <form action="#" method="post" id="login_form" >
      <input type="text" name="usernaam" id="usernaam" placeholder="usernaam">
      <input type="password" name="wachtwoord" id="wachtwoord" placeholder="Wachtwoord">
      <input type="submit" name="button" id="button" placeholder="Inloggen">
     </form>
     <a href="register.php">Registreren</a>
    </div>
  </body>
</html>
