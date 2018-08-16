<?php
spl_autoload_register(function($class){
    include_once(dirname(__DIR__)."\classes/" .  $class . ".class.php");
});

//Receive the RAW post data.
$content = trim(file_get_contents("php://input"));

$decoded = json_decode($content, true);

echo $content;
