<?php
spl_autoload_register(function($class){
    include_once(dirname(__DIR__)."\classes/" .  $class . ".class.php");
});

$credentials = (object) [
  'usernaam' => $_REQUEST['username'],
  'wachtwoord' => $_REQUEST['password']
];

$user = new AppUser ($credentials->usernaam, $credentials->wachtwoord);

echo json_encode(var_dump($_REQUEST));
