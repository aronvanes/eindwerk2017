<?php
spl_autoload_register(function($class){
    include_once(dirname(__DIR__)."\classes/" .  $class . ".class.php");
});

//Receive the RAW post data.
$content = trim(file_get_contents("php://input"));

$decoded = json_decode($content, true);

<<<<<<< HEAD
echo $content;
=======
if(is_array($decoded)) {

  echo json_encode(Module::getModulesPerPatient($decoded['user_id']));

} else {
  // Send error back to user.
  echo ('json_format');
}
>>>>>>> 59e9515cc1bff9a6f78f6d82989356d4136d6f34
