<?php
spl_autoload_register(function($class){
    include_once("classes/" .  $class . ".class.php");
});

// session_start();
// if (!empty($_SESSION['usernaam'])) {
// } else {
//     header('Location: login.php');
// }
$mod = new Module;
$module = $mod->GetAllInteractieModules();
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

<ul class="flex-container">
    <?php foreach ($module as $row) :?>
        <div class="col-md-1 col-features text-center">
            <div class="flex-container ">
                    <div class='lists'>


                        <li class="flex-item"><p class='listname'><?php echo $row['naam'] ?></p><br>
                            <p><?php echo $row['beschrijving'] ?></p></li>

                    </div>
                </a>
            </div>
        </div>
    <?php endforeach; ?>

</ul>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <img src="images/156-family.png" alt="" id="emoji"> <br>
            </div>
        </div>
    </div>

</div>
</body>
</html>
