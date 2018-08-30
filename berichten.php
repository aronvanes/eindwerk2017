<?php
spl_autoload_register(function($class){
    include_once("classes/" .  $class . ".class.php");
});

session_start();
if (empty($_SESSION['usernaam'])) { header('Location: login.php'); }

$bericht_obj = new Bericht();
$users_obj = new AppUser();
$users_obj->setId($_SESSION['user_id']);

$friends = $users_obj->getUsersByUser();

var_dump($friends)

?>
<!DOCTYPE html>
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
      <nav class="navbar-fixed-left">
        <ul class="nav navbar-nav">
          <li>
            <h2 id="cuser"><?php echo $_SESSION["voornaam"],' ',$_SESSION["achternaam"]?></h2>
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
    <div class="offset-3 col-md-7 berichten_container">
      <h2>Berichten</h2>
      <div class="inner_container">
        <?php foreach ($friends as $friend): ?>
          <div class="friend_container">
            <a href="#" id="friend_<?php echo $friend->id?>" data-id="<?php echo $friend->id?>" class="friend_name">
              <img src="<?php echo $friend->profielfoto; ?>"
              <p><?php echo $friend->voornaam.' '.$friend->achternaam; ?></p>
              <p class="message_preview">Hallo<p>
             </a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</body>

</html>
