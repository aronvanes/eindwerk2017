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
    //hier worden de 2 ids opgeslagen in met de functie Save in tbl_users_module
    $module->Text = $_POST['module_id'];
    $user->Text = $_POST['user_id'];
    try {
        $userModule->Save();
        $feedback = [
            "code" => 200,
            "module_id" => $module,
            "user_id" => $user,
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
