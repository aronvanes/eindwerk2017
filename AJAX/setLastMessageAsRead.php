<?php
session_start();
header('Content-Type: application/json');

spl_autoload_register(function($class){
    include_once("../classes/" .  $class . ".class.php");
});

if (!empty($_POST)){

  $msg_obj = new Bericht();
  $msg_obj->setOntvangerId($_POST['user_id']);
  $msg_obj->setVerzenderId($_POST['partner_id']);

  echo json_encode($msg_obj->setLastMessageAsRead());

} else {
  echo 'Error: could not send message.';
}
