<?php
spl_autoload_register(function($class){
    include_once("classes/" .  $class . ".class.php");
});

session_start();
if (empty($_SESSION['usernaam'])) { header('Location: login.php'); }

$user = new User();
$user->setId($_SESSION['user_id']);
$info = $user->getPsychoInfo();
$extra = $user->getPsychoInfoExtra();

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
          <h2 id="cuser"><?php echo $_SESSION["voornaam"],' ',$_SESSION["achternaam"]?></h2>
        </li>
    <li><a href="dashboard.php">Dashboard</a></li>
    <li><a href="patienten.php">Patiënten</a></li>
    <li><a href="modules.php">Modules</a></li>
    <li><a href="berichten.php">Berichten</a></li>
    <li><a href="extramodules.php" id="extra">Extra modules</a></li>
    <li><a href="mijnaccount.php">Profiel</a><li>
    <li><a href="logout.php">Uitloggen</a><li>
    </ul>
</nav>
</div>

<div class="offset-3 col-md-7">
    <div id="mijngegevens">
    <h2>Mijn gegevens</h2>
    </div>

    <div id="account">
    <h4>Naam en achternaam</h4>
    <p><?php echo $info["voornaam"],' ',$info["achternaam"]; ?></p>

    <h4>Geboortedatum</h4>
    <p><?php echo $extra["geboortedatum"];?></p>

    <h4>Woonplaats</h4>
    <p><?php echo $extra["woonplaats"];?></p>

    <h4>Jobtitel</h4>
    <p><?php echo $extra["jobtitel"];?></p>

    <h4>Sector</h4>
    <p><?php echo $extra["sector"];?></p>

    <h4>Specialisatie</h4>
    <p><?php echo $extra["specialisatie"];?></p>
    </div>
</div>

</div>
</div>
</body>
</html>
