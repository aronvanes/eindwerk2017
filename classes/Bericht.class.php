<?php
include_once("Db.class.php");

class Bericht {

  private $verzender_id;
  private $ontvanger_id;
  private $bericht;
  private $datum_verstuurd;
  private $gelezen;

  public function setVerzenderId($value){
    $this->$verzender_id = $value
  }

  public function setOntvangerId($value){
    $this->$ontvanger_id = $value
  }

  public function setBericht($value){
    $this->$bericht = $value
  }

  public function setDatumVerstuurd($value){
    $this->$datum_verstuurd = $value
  }

  public function setGelezen($value){
    $this->$gelezen = $value
  }

  public function sendMessage() {
    $conn = Db::getInstance()

    $statement = $conn->prepare('INSERT INTO tbl_messages (verzender_id, ontvanger_id, bericht, datum_verstuurd, gelezen) VALUES (:verzender_id, :ontvanger_id, :bericht, CURRENT_TIMESTAMP(), 0)');
    $statement->bindParam(':verzender_id', $this->verzender_id);
    $statement->bindParam(':ontvanger_id', $this->ontvanger_id);
    $statement->bindParam(':bericht', $this->bericht);

    return $statement->execute();
  }
