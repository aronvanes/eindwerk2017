<?php
spl_autoload_register(function($class){
    include_once(dirname(__DIR__)."/classes/" .  $class . ".class.php");
});

//Receive the RAW post data.
$content = trim(file_get_contents("php://input"));

$decoded = json_decode($content, true);

// We make an array to hold the parsed json object
$parsed_content = [];

// If json_decode failed, the JSON is invalid.
if(is_array($decoded)) {

  foreach ($decoded['user_data'] as $row) {
    $parsed_content[$row[0]] = $row[1];
  };

  $user = new AppUser();

  $user->setUsernaam($parsed_content['@UserStorage:username']);
  $user->setWachtwoord($parsed_content['@UserStorage:password']);
  $user->setVoornaam($parsed_content['@UserStorage:firstName']);
  $user->setAchternaam($parsed_content['@UserStorage:lastName']);
  $user->setGeboorteDatum($parsed_content['@UserStorage:birthDate']);
  $user->setWoonplaats($parsed_content['@UserStorage:location']);
  $user->setTewerkgesteld($parsed_content['@UserStorage:employed']);
  $user->setSector($parsed_content['@UserStorage:sector']);
  $user->setJobTitel($parsed_content['@UserStorage:jobTitle']);
  $user->setUKey($decoded['u_key']);

  echo json_encode($user->register());

} else {
  // Send error back to user.
  echo ('json_format');
}
