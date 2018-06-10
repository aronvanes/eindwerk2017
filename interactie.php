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
                    <div class="toggleHolder">
                        <span class="toggler"><span>▾</span>Show More</span>
                        <span class="toggler" style="display:none;"><span>▴</span> Show Less</span>
                    </div>
                    <li><p id="post" data-id="<?php echo $row['id'] ?>"><?php echo $row['naam'] ?></p></li>

                    <div class="showpanel" style="display: none;">
                        <li><p><?php echo $row['beschrijving'] ?></p></li>

                                    <?php foreach ($patient as $row2): ?>
                                    <div class="col-md-10">
                                            <div class='lists'>
                                                <li class="flex-item">
                                                    <p class="text-left border-bottom" id="post2" data-id="<?php echo $row2['id'] ?>"><?php echo $row2['voornaam'].' '.$row2['achternaam'];?></p>
                                                    <input id="btnSubmit" type="submit" value="Share"/>
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
    $(document).ready(function () {
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
    });
</script>
</body>
</html>
