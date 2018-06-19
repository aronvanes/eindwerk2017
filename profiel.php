<?php
spl_autoload_register(function($class){
    include_once("classes/" .  $class . ".class.php");
});

session_start();

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
    <li><a href="dashboard.php">Dashboard</a></li>
    <li><a href="patienten.php">Patiënten</a></li>
    <li><a href="modules.php">Modules</a></li>
    <a href="logout.php" id="logout">Uitloggen</a>
    </ul>
</nav>
</div>
<div class="content offset-1 col-md-7">
    <?php
    if(isset($_GET['id'])){
    $huidige = new UserInfo();
    $huidige->setId($_GET['id']);
    $huidige = $huidige->getUserInfo();
    $extra = new UserInfo();
    $extra->setId($_GET['id']);
    $extra = $extra->getPatientModuleExtra();
    $aantal = new UserInfo();
    $aantal->setId($_GET['id']);
    $aantal = $aantal->getAantalCategorie();
    $categorie = new UserInfo();
    $categorie->setId($_GET['id']);
    $categorie = $categorie->getCategorie();
} ?>
<br>
<div class="naam">
<h2><?php echo ($huidige['voornaam']) . " " . ($huidige['achternaam']); ?></h2>
</div>
<div class="categorie">
<h5>Reeds afgewerkte modules per categorie: </h5>
    <p>Categorie werk: <?php echo ($aantal['categorie_werk']); ?></p>
    <p>Categorie energie: <?php echo ($aantal['categorie_energie']); ?> </p>
    <p>Categorie sociaal: <?php echo ($aantal['categorie_sociaal']); ?></p>
</div>
<div class="huidige">
<h5>Is bezig in de categorie: </h5>
<p><?php echo ($categorie['categorie']); ?></p>
</div>
<div class="module">
<h5>Is bezig met de module: </h5>
<p><?php echo ($extra['naam']); ?></p>
</div>
<div class="beschrijving">
<h5>Beschrijving: </h5>
<p><?php echo ($extra['beschrijving']); ?></p>
</div>
</div>
</div>
</body>
</html>