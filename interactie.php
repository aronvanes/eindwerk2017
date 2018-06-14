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
$connect = new Module();
$connecting = $connect->SetModuleToPatient();
$connect2 = new User();
$connecting2 = $connect2->SetModuleToPatient2();
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

<div class="offset-1">

        <ul>
            <!--hier word via een foreachlus alle rijen opgehaald uit de modules met categorie interactie -->
            <?php foreach ($module as $row) :?>
                <div class="col-md-8">
                    <div class="toggleHolder">
                        <span class="toggler"><span>▾</span>Show More</span>
                        <span class="toggler" style="display:none;"><span>▴</span> Show Less</span>
                    </div>
                    <li>
                        <!--hier word in de data-id ingevuld met de id van de desbetreffende rij die hier in de lus getoond wordt-->
                        <p class="post" data-id="<?php echo $row['id'] ?>">
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
                        <?php foreach ($patient as $row2): ?>
                            <div class="col-md-10">
                                <div class='lists'>
                                    <li class="flex-item">
                                        <!--elke rij voor users heeft ook een button die er voor zorgt dat de id van d desbetreffende user samenkomt met bijbehorende
                                        interactie module-->
                                        <p class="text-left border-bottom post2" data-id="<?php echo $row2['id'] ?>">
                                            <?php echo $row2['voornaam'].' '.$row2['achternaam'];?>
                                        </p>
                                        <input class="btnSubmit" type="submit" value="Module toewijzen" />
                                    </li>
                                </div>
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
<script>
   /* $(document).ready(function () {
        $("#btnSubmit").on("click", function (e) {
            console.log("clicked");

            // tekst vak uitlezen
            var module_id = document.getElementById("post").getAttribute("data-id");
            var user_id = document.getElementById("post2").getAttribute("data-id");
            // via AJAX update naar databank sturen
            $.ajax({
                method: "POST",
                url: "AJAX/clientmodule.php",
                data: {user_id: user_id,module_id: module_id} //update: is de naam en update is de waarde (value)

            })

                .done(function (response) {

                    // code + message
                    if (response.code == 200) {
                        console.log("werkt dit?")
                    }
                });

            e.preventDefault();
        });
    });*/
    $(function() {
        $(".btnSubmit").on("click", function(e) {
            e.preventDefault();
            console.log("clicked");
            //volgends de persoon waar mee ik gpraat heb op stackoverflow moest ik werken met claases en deze selecteren met DOM traversal

            // Je kon niet de juiste module id vinden omdat die niet in col-md-10 zit maar in 8
            // op deze manier krijg je de juiste id's
            var $container = $(this).closest('.col-md-10');
            var module_id = $container.closest('.col-md-8').find(".post").data('id');
            var user_id = $container.find(".post2").data('id');

            console.log("module : "+module_id);
            console.log("user : "+user_id);

            $.ajax({
                method: "POST",
                url: "AJAX/clientmodule.php",
                data: {user_id: user_id,module_id: module_id} //update: is de naam en update is de waarde (value)

            })

                .done(function (response) {

                    // code + message
                    if (response.code == 200) {
                        console.log("werkt dit?")
                    }
                });

            e.preventDefault();
        });
    });
</script>
</body>
</html>
