<?php
spl_autoload_register(function($class){
    include_once(dirname(__DIR__)."/classes/" .  $class . ".class.php");
});

//Receive the RAW post data.
$content = trim(file_get_contents("php://input"));

$decoded = json_decode($content, true);

if(is_array($decoded)) {

  $numberOfSuccesses = 0;

  $berichtStart = 'Hey! '.$decoded['sender']['firstName'].' wilt zijn-haar vooruitgang in de module '.$decoded['module']['naam'].' met je delen. Hij-zij heeft reeds '.$decoded['completed_tasks'].' van de '.$decoded['total_tasks'].' taken behaald.';
  $berichtMiddle = '';
  if ($decoded['message']){
    $berichtMiddle = ' Hij-zij wou ook het volgende zeggen: "'.htmlspecialchars($decoded['message']).'""';
  }
  $berichtEnd = ' Antwoord op dit bericht om hem-haar te feliciteren met zijn-haar inspanningen!';

  foreach ($decoded['destination'] as $destination){
    $bericht = new Bericht();
    $bericht->setVerzenderId((int)$decoded['sender']['user_id']);
    $bericht->setOntvangerId((int)$destination['id']);
    $bericht->setBericht($berichtStart.$berichtMiddle.$berichtEnd);

    if($bericht->sendMessage()){
      $numberOfSuccesses += 1;
    }
  }

  echo json_encode($numberOfSuccesses == count($decoded['destination']));

} else {
  // Send error back to user.
  echo ('json_format');
}
