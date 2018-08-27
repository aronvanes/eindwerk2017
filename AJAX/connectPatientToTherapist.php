<?php
session_start();
header('Content-Type: application/json');

spl_autoload_register(function($class){
    include_once("../classes/" .  $class . ".class.php");
});

if (!empty($_POST)){

  $therapist_id = $_POST['therapist_id'];
  $u_key = $_POST['u_key'];

  if (User::connectPatientToTherapist($therapist_id, $u_key)){

    $feedback = [
      "code" => 200,
      "module_id" => $module,
      "user_id" => $user,
    ];

    echo json_encode($feedback);

  } else {
    $feedback = [
      "code" => 500,
      "error" => "error connecting patient to therapist"
    ];

    echo json_encode($feedback);

  }

}
