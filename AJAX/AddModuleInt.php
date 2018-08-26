<?php
session_start();
header('Content-Type: application/json');

spl_autoload_register(function($class){
    include_once("../classes/" .  $class . ".class.php");
});
$mod = new Module;


if (!empty($_POST)) {

    try {
        $mod->CreateModule();
        $feedback = [
            "code" => 200,
            "naam" => htmlspecialchars($_POST['ModuleNaam']),
            "beschrijving" => htmlspecialchars($_POST['ModuleBeschrijving']),
            "categorie" => 1,
            "view_level" => 4,

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