<?php
session_start();
header('Content-Type: application/json');

spl_autoload_register(function($class){
    include_once("../classes/" .  $class . ".class.php");
});

if (!empty($_POST)){

  $patient_id = $_POST['patient_id'];
  $module_id = $_POST['module_id'];

  echo json_encode(User::connectPatientToModule($patient_id, $module_id));

}
