<?php
session_start();
header('Content-Type: application/json');

spl_autoload_register(function($class){
    include_once("../classes/" .  $class . ".class.php");
});

$module = new Module();
$user = new User();
$userModule = new UserModule();

if (!empty($_POST)) {
    $module->Text = $_POST['module_id'];
    $user->Text = $_POST['user_id'];
    $moduleId = $module->GetAllInteractieModules()['id'];
    $userId = $user->patient()['id'];
    try {
        $usermodule->Save();
        $feedback = [
            "code" => 200,
            "module_id" => $moduleId,
            "user_id" => $userId,
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
