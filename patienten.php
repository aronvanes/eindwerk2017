<?php
spl_autoload_register(function($class){
    include_once("classes/" .  $class . ".class.php");
});

session_start();
if (!empty($_SESSION['usernaam'])) {
} else {
    header('Location: login.php');
}


$user = new User();
$schema = $user->Patient();
if (!empty($_GET["search"])) {
        $search = new Search($var1);
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

<div class="content offset-1 col-md-7">
<br>
<form action="search.php" method="GET">
    <input name="var1" type="text" id="var1">
      <input type="submit" value="Search"></th>
    </form>
<br>
<ul class="flex-container">
<p class='listname'>Patiënten</p>
    <?php foreach ($schema as $row): ?>
        <div class="col-md-5 col-features text-left border-bottom">
            <div class="flex-container ">
                    <div class='lists'>
                        <li class="flex-item">
                            <br>
                            <a href="./profiel.php?id=<?php echo $row['id']; ?>"><?php echo $row['voornaam'];echo " "; 
                            echo $row['achternaam']; ?></a>
                            </li>
                    </div>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</ul>
</div>
</div>
</body>
</html>