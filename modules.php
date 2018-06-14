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
<div class=navigation>
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

<div class="content">
<div class="container-fluid">
<div class="row">
    <div class="col-md-3">
        <img src="images/156-family.png" alt="" id="emoji"> <br>
        <a href="interactie.php" class="btn btn-primary">Interactie</a>
    </div>
    <div class="col-md-3">
        <img src="images/160-run.png" alt="" id="emoji"> <br>
        <input type="button" value="Sport" id="btnmodule">
    </div>
    <div class="col-md-3">
        <img src="images/063-sleep-1.png" alt="" id="emoji"> <br>
        <input type="button" value="Slaap" id="btnmodule">
    </div>
</div>
</div>

</div>


</body>
</html>