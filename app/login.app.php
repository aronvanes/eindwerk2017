<?php
spl_autoload_register(function($class){
    include_once("../classes/" .  $class . "app.class.php");
});

$credentials = (object) [
  'email' => $_REQUEST['email']
  'wachtwoord' => $_REQUEST['password']
]

$user = new AppUser ($credentials->email, $credentials->wachtwoord);

echo $use->getEmail();
