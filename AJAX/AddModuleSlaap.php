<?php
session_start();
header('Content-Type: application/json');

spl_autoload_register(function($class){
    include_once("../classes/" .  $class . ".class.php");
});
$mod = new Module;


if (!empty($_POST)) {

    // Dit is niet juist, hier denk ik dat je een fout maakt in hoe je variabelen in de klasse declareert.

    // $mod->Text = $_POST['ModuleNaam'];
    // $mod->Text = $_POST['ModuleBeschrijving'];

    // Hieronder is hoe ik het zou doen

    // Niet vergeten: wanneer je met AJAX data doorstuurt naar PHP dan moet je goed kijken
    // naar hoe je de variabelen noemt in je data-object (hetgeen je verstuurt in je AJAX call)
    // Deze namen steken nu in de $_POST en je moet ze op deze manier gebruiken.
    $mod->setNaam($_POST['naam']);
    $mod->setBeschrijving($_POST['beschrijving']);
    $mod->setCategorie($_POST['categorie']);
    $mod->setViewLevel($_POST['view_level']);

    // Verder gebruik je ook best setters en getters, omdat je soms protected properties hebt
    // die je niet op de alternatieve wijze kan zetten ($mod->beschrijving = $_POST['beschrijving'])

    try {
        if($mod->CreateModule()){ // Je moet dit in een if steken, anders gaat de AJAX altijd denken dat het goed gegaan is.
            $feedback = [
                "code" => 200,
                "naam" => htmlspecialchars($_POST['naam']), // Ook hier worden de variabelen anders genoemd
                "beschrijving" => htmlspecialchars($_POST['beschrijving']),
                "categorie" => 3,
                "view_level" => 2,
            ];
        } else {
            $feedback = [
                "code" => 500,
                "message" => 'Query failed'
            ];
        }

    } catch (Exception $e) {
        $error = $e->getMessage();
        $feedback = [
            "code" => 500,
            "message" => $error
        ];
    }

    echo json_encode($feedback);
}
