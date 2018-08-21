<?php
spl_autoload_register(function($class){
    include_once("classes/" .  $class . ".class.php");
});
session_start();
if (!empty($_SESSION['usernaam'])) {
} else {
header('Location: login.php');
}

$mod = new Module;
$module = $mod->GetAllInteractieModules();
$user = new User();
$patient = $user->Patient();

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
    <nav class="navbar-fixed-left">
    <ul class="nav navbar-nav">
        <li>
            <h2 id="cuser">Naam + ...</h2>
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

<div class="offset-1 horizontalOffset col-md-8">

        <ul>
            <!--hier word via een foreachlus alle rijen opgehaald uit de modules met categorie interactie -->
            <?php foreach ($module as $row) :?>
                <div class="list border-bottom-yellow module">
                    <div class="toggleHolder">
                        <input type="button" class="toggler btn btn-warning" value="▾Show More">
                        <input type="button" class="toggler btn btn-warning" style="display:none;" value="▴ Show Less">
                    </div>
                    <li>
                        <!--hier word in de data-id ingevuld met de id van de desbetreffende rij die hier in de lus getoond wordt-->
                        <h4  class="post" data-id="<?php echo $row['id'] ?>">
                            <?php echo $row['naam'] ?>
                        </h4>
                    </li>
                    <div class="showpanel" style="display: none;">
                        <li>
                            <p>
                                <?php echo $row['beschrijving'] ?>
                            </p>
                        </li>


                        <!--in de eerste foreachlus word er nog een tweede gezet die per module alle users toont-->
                        <div class="taak-container">
                            <?php
                            $taak = new Taak();
                            $taak->setModuleId($row['id']);
                            $taken = $taak->SelectAllTakenPerModule();
                            ?>
                            <?php foreach ($taken as $row3): ?>
                                <div class="taak">
                                    <li>
                                        <!--elke rij voor users heeft ook een button die er voor zorgt dat de id van d desbetreffende user samenkomt met bijbehorende
                                        interactie module-->
                                        <class ="text-left border-bottom" data-id="<?php echo $row3['id'] ?>">
                                            <?php echo $row3['naam'];?>
                                        </>
                                        <p>
                                            <?php echo $row3['beschrijving'];?>
                                        </p>
                                    </li>
                                </div>
                            <?php endforeach; ?>
                            <input class="btnNext btn btn-warning" type="submit" value="doorgaan">
                        </div>

                        <div class="client-container">
                        <?php foreach ($patient as $row2): ?>
                            <div class="client">

                                    <li>
                                        <!--elke rij voor users heeft ook een button die er voor zorgt dat de id van d desbetreffende user samenkomt met bijbehorende
                                        interactie module-->
                                        <p class="text-left border-bottom-yellow post2" data-id="<?php echo $row2['id'] ?>">
                                            <?php echo $row2['voornaam'].' '.$row2['achternaam'];?>
                                            <input class="btnSubmit btn btn-warning" type="submit" value="Module toewijzen" />
                                        </p>
                                    </li>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </ul>
    </div>
    </div>
</div>
<script src="showtoggle.js"></script>
<script>
    $(function() {
        $(".btnSubmit").on("click", function(e) {
            e.preventDefault();
            console.log("clicked");
            //volgends de persoon waar mee ik gpraat heb op stackoverflow moest ik werken met claases en deze selecteren met DOM traversal

            // Je kon niet de juiste module id vinden omdat die niet in col-md-10 zit maar in 8
            // op deze manier krijg je de juiste id's
            var $container = $(this).closest('.client');
            var user_id = $container.closest('.module').find(".post").data('id');
            var module_id = $container.find(".post2").data('id');

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
                        alert("Module toegewezen");
                    }
                });

            e.preventDefault();
        });
    });


    $(function() {
        $(".toggler").on("click", function(e) {
            e.preventDefault();
            console.log("clicked");
            //volgends de persoon waar mee ik gpraat heb op stackoverflow moest ik werken met claases en deze selecteren met DOM traversal

            // Je kon niet de juiste module id vinden omdat die niet in col-md-10 zit maar in 8
            // op deze manier krijg je de juiste id's
            var $container = $(this).closest('.module');
            var module_id = $container.closest('.module').find(".post").data('id');
            //var user_id = $container.find(".post2").data('id');

            console.log("module : "+module_id);

            $.ajax({
                method: "POST",
                url: "AJAX/taken.php",
                data: {module_id: module_id} //update: is de naam en update is de waarde (value)

            })

                .done(function (response) {

                    // code + message
                    if (response.code == 200) {
                        console.log("werkt dit?");

                    }
                });

            e.preventDefault();
        });
    });

</script>
</body>
</html>
