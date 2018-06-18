<?php
spl_autoload_register(function($class){
    include_once("classes/" .  $class . ".class.php");
});
session_start();
if (!empty($_SESSION['usernaam'])) {
} else {
    header('Location: login.php');
}
if (!empty($_POST)){
    try {
    $extra = new Info();
    //$extra->setUsers_id($_SESSION['id']);
    $extra->setGeboortedatum($_POST['geboortedatum']);
    $extra->setWoonplaats($_POST['woonplaats']);
    $extra->setTewerkgesteld($_POST['tewerkgesteld']);
    $extra->setJobtitel($_POST['jobtitel']);
    $extra->setSector($_POST['sector']);
    if($extra->Profiel()){
        header('location: dashboard.php');
    }
    }
    catch (Exception $e) {
        $message = $e->getMessage();
    }
}

?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin - Start Bootstrap Template</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

</head>

<body>
  <div class="container">

<div class="logo"></div>
<?php if ( isset($message)): ?>
        <div class="error">
            <label for="error"> <?php echo $message; ?>  </label>
        </div>
 <?php endif;?>
<h3>Extra informatie</h3>
  <form action="#" method="post">
    <input type="text" name="geboortedatum" id="geboortedatum" placeholder="geboortedatum yyyy-mm-dd">
    <br>
    <input type="text" name="diploma" id="diploma" placeholder="Diploma">
    <br>
    <input type="text" name="aantaljaar" id="aantaljaar" placeholder="Aantal jaar ervaring">
    <br>
    <input type="text" name="praktijk" id="praktijk" placeholder="Adres praktijk">
    <br>
    <input type="text" name="registratienummer" id="registratienummer" placeholder="registratienummer psychologencommisie">
    <br>
    <input type="submit" name="button" id="button" placeholder="Klaar!">
</form>



  </div>
</body>

</html>