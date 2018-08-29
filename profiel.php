<?php
spl_autoload_register(function($class){
    include_once("classes/" .  $class . ".class.php");
});

session_start();

$user = new User();
$cuser = $user->getCurrentUser();

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
<nav class="navbar-fixed-left">
    <ul class="nav navbar-nav">
        <li>
            <h2 id="cuser"><?php echo $cuser["voornaam"],' ',$cuser["achternaam"]?></h2>
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
<div class="content offset-3 col-md-7">
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
<h5><?php echo ($huidige['voornaam']) . " " . ($huidige['achternaam']); ?></h5>
</div>

<div id="timelineone">
<div class="huidige">
<h5>Is bezig in de categorie: </h5>
<p><?php echo ($categorie['categorie']); ?></p>
</div>
<div class="module2">
<h5>Is bezig met de module: </h5>
<p><?php echo ($extra['naam']); ?></p>
</div>
<h5>Beschrijving: </h5>
<p><?php echo ($extra['beschrijving']); ?></p>
</div>

<div class="categorie">
    
    <div id="timeline"><div id="pictoslaap"></div>
    <p>Categorie slaap: <?php echo ($aantal['categorie_werk']); ?></p></div>

    <div id="timeline"><div id="pictosport"></div>
    <p>Categorie sport: <?php echo ($aantal['categorie_energie']); ?> </p></div>

    <div id="timeline"><div id="pictointeractie"></div>
    <p>Categorie interactie: <?php echo ($aantal['categorie_sociaal']); ?></p></div>
</div>

</div>
</div>
</body>
</html>