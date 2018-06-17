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
$user = new User();
$patient = $user->Patient();
$taak = new Taak();
$taken = $taak->SelectAllTakenPerModule();
var_dump($taken);
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mål</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styletwee.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<div class="container-fluid">
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

        <div class="offset-1 horizontalOffset">

            <ul>
                <!--hier word via een foreachlus alle rijen opgehaald uit de modules met categorie interactie -->
                <?php foreach ($module as $row) :?>
                    <div class="list border-bottom module">
                        <div class="toggleHolder">
                            <span class="toggler"><span>▾</span>Show More</span>
                            <span class="toggler" style="display:none;"><span>▴</span> Show Less</span>
                        </div>
                        <li>
                            <!--hier word in de data-id ingevuld met de id van de desbetreffende rij die hier in de lus getoond wordt-->
                            <p  class="post" data-id="<?php $_POST['id'] ?>">
                                <?php echo $row['naam'] ?>
                            </p>
                        </li>
                        <div class="showpanel" style="display: none;">
                            <li>
                                <p>
                                    <?php echo $row['beschrijving'] ?>
                                </p>
                            </li>
                            <!--in de eerste foreachlus word er nog een tweede gezet die per module alle users toont-->
                            <?php foreach ($taken as $row2): ?>
                                <div class="client">

                                    <li>
                                        <!--elke rij voor users heeft ook een button die er voor zorgt dat de id van d desbetreffende user samenkomt met bijbehorende
                                        interactie module-->
                                        <p class="text-left border-bottom post2" data-id="<?php echo $row2['id'] ?>">
                                            <?php echo $row2['naam'].' '.$row2['beschrijving'];?>
                                        </p>
                                    </li>
                                </div>
                            <?php endforeach; ?>
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
