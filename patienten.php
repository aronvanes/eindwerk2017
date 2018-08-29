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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body>

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

<div class="content offset-3 col-md-7">
<br>
<form action="search.php" method="GET">
    <input name="var1" type="text" id="var1">
      <input type="submit" value="Search"></th>
    </form>
<br>
<div class='connect'>
    <br>
    <div class="col-md-5 col-features text-left">
    <br>
  <p>Nieuwe gebruiker toevoegen</p>
  <p id='error_msg_p' class='error_msg'></p>
  <input type='text' id='connect_patient_input' placeholder="6 cijfers">
  <button type='button' disabled id='connect_patient_button'> KOPPELEN </button>
</div>
</div>

<div class="aanvragen">
    <h2>Nieuwe aanvragen</h2>
</div>

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


<div id="pbehandeling">
    <h2>Patiënten in behandeling</h2>
</div>

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
<script>
  $(document).ready(function(){
    console.log($('#connect_patient_input'))

    $('#connect_patient_input').on('keyup', function(){
      if ($(this).val().length < 6) {
        $(this).prev().text('Code moet minimaal 6 cijfers bevatten').show()
        $(this).addClass('error');
        $(this).siblings('button').prop('disabled', true)
      } else if ($(this).val().length > 6) {
        $(this).addClass('error');
        $(this).siblings('button').prop('disabled', true)
        $(this).prev().text('Code mag maximaal 6 cijfers bevatten').show()
      } else {
        $(this).removeClass('error')
        $(this).prev().text('').hide()
        $(this).siblings('button').prop('disabled', false)
      }
    });

    $('#connect_patient_button').click(function(e){
      e.preventDefault();
      var value = $('#connect_patient_input').val()

      $.ajax({
        method: 'POST',
        url: 'AJAX/connectPatientToTherapist.php',
        data: {
          therapist_id:  <?= $_SESSION['id']; ?>,
          u_key: value,
        }
      })
      .done(function(response){
        console.log(response)
      })
    })
  })
</script>

</html>
