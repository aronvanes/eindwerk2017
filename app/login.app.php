<?php
spl_autoload_register(function($class){
    include_once(dirname(__DIR__)."\classes/" .  $class . ".class.php");
});

$json = $_POST['email'];

// $credentials = (object) [
//   'email' => $_REQUEST['email'],
//   'wachtwoord' => $_REQUEST['password']
// ];
//
// $user = new AppUser ($credentials->email, $credentials->wachtwoord);

echo json_encode($json);
// $user->getEmail()
