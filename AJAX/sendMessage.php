<?php
session_start();
header('Content-Type: application/json');

spl_autoload_register(function($class){
    include_once("../classes/" .  $class . ".class.php");
});

if (!empty($_POST)){

  $msg_obj = new Bericht();
  $msg_obj->setOntvangerId($_POST['receiver_id']);
  $msg_obj->setVerzenderId($_POST['sender_id']);
  $msg_obj->setBericht($_POST['text']);

  echo json_encode($msg_obj->sendMessage());

} else {
  echo 'Error: could not send message.';
}
