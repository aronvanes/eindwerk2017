<?php
spl_autoload_register(function($class){
    include_once("classes/" .  $class . ".class.php");
});

session_start();
if (!empty($_SESSION['usernaam'])) {
} else {
    header('Location: login.php');
}

$patient = new User();
$patient->Patient();
//$user->level();
//$user->categorie();

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
    </ul>
</nav>
</div>
<div class="content">
<input type="text" placeholder="Search.." id="search">
<div class="row">
<ul class="flex-container">
    <?php foreach ($patient as $row): ?>
        <div class="col-md-1 col-features text-center">
            <div class="flex-container ">
                    <div class='lists'>
                        <li class="flex-item">
                            <p class='listname'><?php echo $row['voornaam']; ?></p>
                            <br>
                            <p><?php echo $patient['voornaam']; echo $patient['achternaam'];?></p>
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