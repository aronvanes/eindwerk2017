<?php
spl_autoload_register(function($class){
    include_once("classes/" .  $class . ".class.php");
});

session_start();
 if (empty($_SESSION['usernaam'])) { header('Location: login.php'); }

$user = new User();
$schema = $user->Patient();
$cuser = $user->getCurrentUser();

if (!empty($_GET["search"])) {
  $search = new Search($var1);
}

$dashboard = new Dashboard();
$profielfoto = $dashboard->getProfielfotoUser();

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
<div id="uptodate">
    <p>Is uw patiëntenlijst nog up to date? <a href="patienten.php">Patiëntenlijst beheren</a></p>

</div>
<div id="pbehandeling">
    <h2>Patiënten in behandeling</h2>
</div>
    <ul class="col-12 row">
    <?php foreach ($schema as $row): ?>

                         <li id="cards">
                            <?php echo '<img src="data:../images/jpeg;base64,'.base64_encode( $profielfoto['profielfoto'] ).'"/>';?>
                            <a href="./profiel.php?id=<?php echo $row['id']; ?>">
                            <?php echo $row['voornaam'];echo " ";
                            echo $row['achternaam']; ?></a>

                            </li>


    <?php endforeach; ?>
    </ul>



<div id="amodules">
    <h2>Actieve modules</h2>
</div>
</div>
</div>
</div>
</body>
</html>
