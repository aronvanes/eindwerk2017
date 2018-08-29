<?php
spl_autoload_register(function($class){
    include_once("classes/" .  $class . ".class.php");
});

session_start();
// if (!empty($_SESSION['usernaam'])) {
// } else {
//     header('Location: login.php');
// }

$huidige = new UserInfo();
$huidige = $huidige->getUserInfo();
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
    <li><a href="berichten.php">Berichten</a></li>
    <li><a href="extramodules.php" id="extra">Extra modules</a></li>
    <li><a href="mijnaccount.php">Profiel</a><li>
    <li><a href="logout.php">Uitloggen</a><li>
    </ul>
</nav>
</div>


<div class="offset-3 col-md-7">
    <h2 id="mogelijk">Maak <br> <strong> meer </strong> <br> mogelijk</h2>
    <div id="insp">
    <p>Laat je inspireren door modules geschreven 
        door andere psycho-therapeuten.
        Maak kennis met innoverende technieken
        en deel jouw ervaringen met andere experts.
    </p>
    </div>
    <h4 id="call">Maak meer mogelijk.</h4>
    <button id="prijs">19,99 euro / jaar <br>
        (excl B.T.W.)</button>


<div class="offset-1 col-md-7">
<div id="mopic"> </div>

</div>
</div>
</div>
</div>
</body>
</html>