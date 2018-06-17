<?php
spl_autoload_register(function($class){
    include_once("classes/" .  $class . ".class.php");
});

session_start();
// if (!empty($_SESSION['usernaam'])) {
// } else {
//     header('Location: login.php');
// }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mål</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/styletwee.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body>
<div class="row">
<div class="navigation col-md-3">
<a href=""><div class="logo"></div></a>
<nav class="navbar-fixed-left">
    <ul class="nav navbar-nav">
    <li><a href="dashboard.php">Dashboard</a></li>
    <li><a href="patienten.php">Patiënten</a></li>
    <li><a href="modules.php">Modules</a></li>
    <a href="logout.php" id="logout">Uitloggen</a>
    </ul>
</nav>
</div>


<div class="offset-1 col-md-7">
    <h2>Is uw patiënten lijst nog up to date?</h2>
    <input type="submit" id="button" value="voeg nieuwe patienten toe">

</div>
</div>

</body>
</html>
