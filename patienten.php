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
$schema = $user->Schema();
if (!empty($_GET["search"])) {
        $search = new Search();
    } 


var_dump($schema);
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
<form action="search.php" method="POST">
    <input name="var1" type="text" id="var1">
      <input type="submit" value="Search"></th>
    </form>

<ul class="flex-container">
    <?php foreach ($schema as $row): ?>
        <div class="col-md-5 col-features text-left border-bottom">
            <div class="flex-container ">
                    <div class='lists'>
                        <li class="flex-item">
                            <p class='listname'>Patiënten</p>
                            <br>
                            <p><?php echo $row['voornaam']; echo " "; echo $row['achternaam']; 
                            echo $row['user_id']; echo $row['module_id'];?></p>
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