<?php
session_start();
header('Content-Type: application/json');

spl_autoload_register(function($class){
    include_once("../classes/" .  $class . ".class.php");
});

$connect = new Module();
$connect2 = new User();
$usermodule = new UserModule();

if (!empty($_POST)) {
    $connect->Text = $_POST['post'];
    $connect2->Text = $_POST['post'];
    $moduleId = $connect->GetAllInteractieModules()['id'];
    $userid = $connect2->patient()['id'];
    try {
        $usermodule->Save();
        $feedback = [
            "code" => 200,
            "module_id" => $moduleId,
            "user_id" => $userid,
        ];
    } catch (Exception $e) {
        $error = $e->getMessage();
        $feedback = [
            "code" => 500,
            "message" => $error
        ];
    }

    echo json_encode($feedback);
}
