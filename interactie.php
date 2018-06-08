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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
    <div class="container-fluid">
        </div>
        <div class="row">
        <ul>
            <?php foreach ($module as $row) :?>
                <div class="col-md-8">
                    <li><p><?php echo $row['naam'] ?></p></li>

                    <div class="showpanel" style="display: none;">
                        <li><p><?php echo $row['beschrijving'] ?></p></li>
                    </div>

                    <div class="toggleHolder">
                        <span class="toggler"><span>▾</span>Show More</span>
                        <span class="toggler" style="display:none;"><span>▴</span> Show Less</span>
                    </div>
                </div>
            <?php endforeach; ?>

        </ul>
        </div>
    </div>

</div>
<script src="showtoggle.js"></script>
</body>
</html>
