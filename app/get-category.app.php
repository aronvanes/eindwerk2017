<?php
spl_autoload_register(function($class){
    include_once(dirname(__DIR__)."/classes/" .  $class . ".class.php");
});

//Receive the RAW post data.
$content = trim(file_get_contents("php://input"));

$decoded = json_decode($content, true);

if(is_array($decoded)) {

  $module = new Module();
  $module->setCategorie($decoded['category_id']);

  echo json_encode($module->getCategory());

} else {
  // Send error back to user.
  echo ('json_format');
}
