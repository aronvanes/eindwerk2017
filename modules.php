<?php
spl_autoload_register(function($class){
    include_once("classes/" .  $class . ".class.php");
});

session_start();
if (!empty($_SESSION['usernaam'])) {
} else {
    header('Location: login.php');
}
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
<div class=navigation>
<a href=""><div class="logo"></div></a>
<nav class="navbar-fixed-left">
    <ul class="nav navbar-nav">
        <li>
            <h2 id="cuser"><?php echo ($huidige['voornaam']); ?></h2>
        </li>
    <li><a href="dashboard.php">Dashboard</a></li>
    <li><a href="patienten.php">Patiënten</a></li>
    <li><a href="modules.php">Modules</a></li>
    <li><a href="profiel.php">Profiel</a></li>
    <li><a href="berichten.php">Berichten</a></li>
    <li><a href="extramodules.php" id="extra">Extra modules</a></li>
    <li><a href="logout.php">Uitloggen</a><li>
    </ul>
</nav>
</div>
    <div class="col-md-2 offset-1">
        <img src="images/156-family.png" alt="" id="emoji"> <br>
        <a href="interactie.php" class="btn btn-primary">Interactie</a>
    </div>
    <div class="col-md-2">
        <img src="images/160-run.png" alt="" id="emoji"> <br>
        <a href="energie.php" class="btn btn-primary">Energie</a>
    </div>
    <div class="col-md-2">
        <img src="images/063-sleep-1.png" alt="" id="emoji"> <br>
        <a href="slaap.php" class="btn btn-primary">Slaap</a>
    </div>





</body>
</html>