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
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body>
  <div class="container">
   



  </div>
</body>

</html>
