<?php
spl_autoload_register(function($class){
    include_once(dirname(__DIR__)."/classes/" .  $class . ".class.php");
});

//Receive the RAW post data.
$content = trim(file_get_contents("php://input"));

$decoded = json_decode($content, true);

if(is_array($decoded)) {

  $message = new Bericht();

  $message->setVerzenderId((int)$decoded['partner']);
  $message->setOntvangerId((int)$decoded['current_user']);

  echo json_encode($message->setLastMessageAsRead());

} else {
  // Send error back to user.
  echo ('json_format');
}
