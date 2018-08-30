<?php
session_start();
header('Content-Type: application/json');

spl_autoload_register(function($class){
    include_once("../classes/" .  $class . ".class.php");
});

$taak = new Taak();
$user = new User();
$usertaak = new UserTaak();

if (!empty($_POST)) {
    //hier worden de 2 ids opgeslagen in met de functie Save in tbl_users_module
    $taak->Text = $_POST['taak_id'];
    $user->Text = $_POST['user_id'];
    try {
        $usertaak->Save();
        $feedback = [
            "code" => 200,
            "taak_id" => $taak,
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
