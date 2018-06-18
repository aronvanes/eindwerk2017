<?php
session_start();
header('Content-Type: application/json');

spl_autoload_register(function($class){
    include_once("../classes/" .  $class . ".class.php");
});

$module = new Module();
$taak = new Taak();


if (!empty($_POST)) {
    //hier worden de 2 ids opgeslagen in met de functie Save in tbl_users_module
    $module->Text = $_POST['module_id'];
    try {
        $taak->SelectAllTakenPerModule();
        $feedback = [
            "code" => 200,
            "module_id" => $module
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
