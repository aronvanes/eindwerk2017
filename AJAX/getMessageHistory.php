<?php
session_start();
header('Content-Type: application/json');

spl_autoload_register(function($class){
    include_once("../classes/" .  $class . ".class.php");
});

if (!empty($_POST)){

    echo json_encode(Bericht::getMessageHistory($_POST['user_id'], $_POST['partner_id']));

} else {
  echo 'Error: could not get message history.';
}
