<?php
spl_autoload_register(function($class){
    include_once("classes/" .  $class . ".class.php");
});
session_start();
if (empty($_SESSION['usernaam'])) { header('Location: login.php'); }


$mod = new Module;
$interactie_modules = $mod->GetAllInteractieModules();
// $moduleAdd = $mod->CreateModule();

$user = new User();
$user->setId($_SESSION['user_id']);
$patients = $user->getPatientsByTherapist();
$page = ("interactie");
?>
<!DOCTYPE html>
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
              <h2 id="cuser" data-id=<?php echo $_SESSION['user_id']?>><?php echo $_SESSION["voornaam"],' ',$_SESSION["achternaam"]?></h2>
            </li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="patienten.php">Patiënten</a></li>
            <li><a href="modules.php">Modules</a></li>
            <li><a href="berichten.php">Berichten</a></li>
            <li><a href="extramodules.php" id="extra">Extra modules</a></li>
            <li><a href="mijnaccount.php">Profiel</a>
            <li>
            <li><a href="logout.php">Uitloggen</a>
            <li>
          </ul>
        </nav>
      </div>
      <div id="overlay">
        <form action="#" method="post" class="col-md-5 ">
          <div class="formstyle">
            <h3>Nieuwe module aanmaken</h3>
            <input type="text" class="form-control" name="Naam" id="ModuleNaam" placeholder="Naam module">
            <input type="text" class="form-control" name="Beschrijving" id="ModuleBeschrijving" placeholder="Beschrijving">
            <input type="submit" class="form-control btn BtnAdd" name="button" id="button" placeholder="Aanmaken" onclick="myFunction()">
          </div>
        </form>
      </div>
      <div class="offset-3 horizontalOffset col-md-8">
        <div class="col-3">
          <img src="images/158-couple.svg" alt="" class="interactieIcon">
        </div>
        <div class="NavModules">
          <a href="interactie.php" class="interactielink <?php echo ($page == "interactie" ? "active1" : "")?>">Interactie</a>
          <a href="sport.php" class="sportlink  <?php echo ($page == "sport" ? "active2" : "")?>">Sport</a>
          <a href="slaap.php" class="slaaplink  <?php echo ($page == "slaap" ? "active3" : "")?>">Slaap</a>
        </div>
        <ul class="ModuleListInt">
          <!--hier word via een foreachlus alle rijen opgehaald uit de modules met categorie interactie -->
          <?php foreach ($interactie_modules as $module) :?>
          <div class="list border-bottom-yellow module">
            <div class="toggleHolder">
              <input type="button" class="toggler btn btn-warning" value="▾Show More">
              <input type="button" class="toggler btn btn-warning" style="display:none;" value="▴ Show Less">
            </div>
            <li>
              <!--hier word in de data-id ingevuld met de id van de desbetreffende rij die hier in de lus getoond wordt-->
              <h4  class="post" data-id="<?php echo $module['id'] ?>"><?php echo $module['naam'] ?></h4>
            </li>
            <div class="showpanel" style="display: none;">
              <li>
                <p>
                  <?php echo $module['beschrijving'] ?>
                </p>
              </li>
              <!--in de eerste foreachlus word er nog een tweede gezet die per module alle users toont-->
              <div class="taak-container" id="taak-container">
                <?php
                            $taak = new Taak();
                            $taak->setModuleId($module['id']);
                            $taken = $taak->SelectAllTakenPerModule();
                            ?>
                <div class="taakcontainer">
                  <?php foreach ($taken as $taak): ?>

                  <ul class="taak">
                    <li class="taakitems">
                      <!--elke rij voor users heeft ook een button die er voor zorgt dat de id van d desbetreffende user samenkomt met bijbehorende
                                        interactie module-->
                      <comment>Taaknaam</comment>
                      <h6 class ="text-left post3"  data-id=" <?php echo $taak['id'] ?>"><?php echo $taak['naam'];?></h6>
                      <comment>Beschrijving</comment>
                      <p><?php echo $taak['beschrijving'];?></p>
                    </li>
                  </ul>

                  <?php endforeach; ?>
                </div>
                <h4>Nieuwe taak aanmaken</h4>
                <form action="" method="post" class="taakinput">
                  <input type="text" class="form-control inputnaam" name="Naam" id="TaakNaam_<?php echo $module['id'] ?>" placeholder="Naam taak">
                  <input type="text" class="form-control inputbeschrijving" name="Beschrijving" id="TaakBeschrijving_<?php echo $module['id'] ?>" placeholder="Beschrijving">
                  <input class="btnNext btn btn-secondary add_task" type="button" value="nieuwe taak aanmaken">
                </form>
                <input class="btnNext btn btn-secondary connect_patient" type="button" value="Deze module koppelen aan patient">
              </div>
              <div class="client-container" id="client-container">
                <?php foreach ($patients as $patient): ?>
                <div class="client">
                  <li>
                    <!--elke rij voor users heeft ook een button die er voor zorgt dat de id van d desbetreffende user samenkomt met bijbehorende
                                        interactie module-->
                    <p class="text-left border-bottom-yellow post2" data-id="<?php echo $patient['id'] ?>">
                      <?php echo $patient['voornaam'].' '.$patient['achternaam'];?>
                      <input class="btnSubmit btn btn-warning btn_connect_patient" data-module="<?php echo $module['id']?>" type="submit" value="Module toewijzen" /></p>
                  </li>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </ul>
        <input type="button" class="btn btn-secondary"  value="Nieuwe module">
    </div>
    </div>
  </div>

  <script src="showtoggle.js"></script>
  <script>
    function on() {
      document.getElementById("overlay").style.display = "flex";
    }

    function off() {
      document.getElementById("overlay").style.display = "none";
    }

    function on2() {
      document.getElementById("overlay2").style.display = "flex";
    }

    $('.connect_patient').on('click', function(e){
      e.preventDefault()

      $(this).parent().siblings('.client-container').toggle()
    })

    $('.btn_connect_patient').on('click', function(e){
      e.preventDefault();

      let patient_id = $(this).parent().data('id');
      let module_id = $(this).data('module');

      console.log(patient_id);
      console.log(module_id);

      $.ajax({
        method: 'POST',
        url: 'AJAX/connectPatientToModule.php',
        data: {
          patient_id: patient_id,
          module_id: module_id
        }
      }).done(function(response){
        console.log(response)
      })
    })

    function myFunction() {
      location.reload();
    }
  </script>
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

        console.log("module : " + module_id);
        console.log("user : " + user_id);

        $.ajax({
            method: "POST",
            url: "AJAX/clientmodule.php",
            data: {
              user_id: user_id,
              module_id: module_id
            } //update: is de naam en update is de waarde (value)

          })

          .done(function(response) {

            // code + message
            if (response.code == 200) {
              console.log("werkt dit?")
              alert("Module toegewezen");
            }
          });

        e.preventDefault();
      });
    });

   /* $(function() {
        $(".btnSubmit").on("click", function(e) {
            e.preventDefault();
            console.log("clicked");
            //volgends de persoon waar mee ik gpraat heb op stackoverflow moest ik werken met claases en deze selecteren met DOM traversal

            // Je kon niet de juiste module id vinden omdat die niet in col-md-10 zit maar in 8
            // op deze manier krijg je de juiste id's
            var $container = $(this).closest('.client');
            var taak_id = $container.closest('.module').find(".post3").data('id');
            var user_id = $container.find(".post2").data('id');

            console.log("taak : " + taak_id);
            console.log("user : " + user_id);

            $.ajax({
                method: "POST",
                url: "AJAX/ClientTaak.php",
                data: {
                    user_id: user_id,
                    taak_id: taak_id
                } //update: is de naam en update is de waarde (value)

            })

                .done(function(response) {

                    // code + message
                    if (response.code == 200) {
                        console.log("werkt dit?")
                        alert("Module toegewezen");
                    }
                });

            e.preventDefault();
        });
    });

*/
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

        console.log("module : " + module_id);

        $.ajax({
            method: "POST",
            url: "AJAX/taken.php",
            data: {
              module_id: module_id
            } //update: is de naam en update is de waarde (value)
          })

          .done(function(response) {
            // code + message
            if (response.code == 200) {
              console.log("werkt dit?");
            }
          });

        e.preventDefault();
      });
    });

    $(document).ready(function() {
      $(".BtnAdd").on("click", function(e) {
        console.log("clicked");


        // tekst vak uitlezen
        var naam = $("#ModuleNaam").val();
        var beschrijving = $("#ModuleBeschrijving").val();
        var categorie = 1 // aangezien het in interactie.php zit, maakt het niet uit dat dit hardcoded is
        var view_level = 4 // Ben eerlijk gezegd vergeten waarom we dit hadden geimplementeerd ... lol :p


        // via AJAX update naar databank sturen

        $.ajax({
            method: "POST",
            url: "AJAX/AddModuleInt.php",
            data: {
              naam: naam,
              beschrijving: beschrijving,
              categorie: categorie,
              view_level: view_level,
            } //update: is de naam en update is de waarde (value)

          })

          .done(function(response) {
            console.log(response)
            // code + message
            if (response.code == 200) {
              var li = $("<li>");
              li.html("<h4 id='post'>" + response.naam + "</h4>");
              $(".ModuleList").prepend(li);
              $(".ModuleList li").last().slideDown();

              li.html("<p>" + response.beschrijving + "</p>");
              $(".showpanel").prepend(li);
              $(".showpanel li").last()
              console.log("werkt dit?");
            }
          });

        e.preventDefault();
      });
    });

    $(document).ready(function() {
      $(".add_task").on("click", function(e) {
        console.log("clicked");

        // tekst vak uitlezen
        var $container = $(this).closest(".taakinput");
        var naam = $container.closest('.taakinput').find(".inputnaam").val();
        var beschrijving = $container.closest('.taakinput').find(".inputbeschrijving").val();

        var $container2 = $(this).closest('.module');
        var module_id = $container2.find(".post").data('id');

        // via AJAX update naar databank sturen

        console.log(naam)
        console.log(beschrijving)
        console.log(module_id)

        $.ajax({
            method: "POST",
            url: "AJAX/AddTaakInt.php",
            data: {
              naam: naam,
              beschrijving: beschrijving,
              module_id: module_id
            } //update: is de naam en update is de waarde (value)

          })

          .done(function(response) {
            console.log(response)
            // code + message
            if (response.code == 200) {
              var li = $("<li>");
              li.html("<h6 class ='text-left border-bottom'>" + response.naam + "</h6>" + "<p>" + response.beschrijving + "</p>");
              $('#TaakNaam_'+module_id).parent().siblings('.taakcontainer').append("<ul style='display:none' class='taak'><li class='taakitems'><comment>Taaknaam</comment><h6 class ='text-left'  data-id='"+response.id+"'>"+response.naam+"</h6><comment>Beschrijving</comment><p>"+response.beschrijving+"</p></li></ul>");
              $('#TaakNaam_'+module_id).parent().siblings('.taakcontainer').children().last().slideDown();
              console.log("werkt dit?");
            }
          });

        e.preventDefault();
      });
    });
  </script>
</body>

</html>
