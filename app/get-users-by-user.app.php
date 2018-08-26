<?php
spl_autoload_register(function($class){
    include_once(dirname(__DIR__)."/classes/" .  $class . ".class.php");
});

//Receive the RAW post data.
$content = trim(file_get_contents("php://input"));

$decoded = json_decode($content, true);

//If json_decode failed, the JSON is invalid.
if(is_array($decoded)) {

  $user = new AppUser();
  $user->setId($decoded['user_id']);

  echo json_encode($user->getUsersByUser());

} else {
  // Send error back to user.
  echo ('json_format');
}
