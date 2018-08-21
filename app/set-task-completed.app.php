<?php
spl_autoload_register(function($class){
    include_once(dirname(__DIR__)."/classes/" .  $class . ".class.php");
});

//Receive the RAW post data.
$content = trim(file_get_contents("php://input"));

$decoded = json_decode($content, true);

//If json_decode failed, the JSON is invalid.
if(is_array($decoded)) {

  echo json_encode(Taak::setTaskCompleted($decoded['task_id'], $decoded['completed']));

} else {
  // Send error back to user.
  echo ('json_format');
}
