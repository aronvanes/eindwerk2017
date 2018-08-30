<?php
include_once("Db.class.php");

class Bericht {

  private $verzender_id;
  private $ontvanger_id;
  private $bericht;
  private $datum_verstuurd;
  private $gelezen;

  public function setVerzenderId($value){
    $this->verzender_id = $value;
  }

  public function setOntvangerId($value){
    $this->ontvanger_id = $value;
  }

  public function setBericht($value){
    $this->bericht = $value;
  }

  public function setDatumVerstuurd($value){
    $this->datum_verstuurd = $value;
  }

  public function setGelezen($value){
    $this->gelezen = $value;
  }

  public function sendMessage() {
    $conn = Db::getInstance();

    $statement = $conn->prepare('INSERT INTO tbl_berichten (verzender_id, ontvanger_id, bericht, datum_tijd_verstuurd, gelezen) VALUES (:verzender_id, :ontvanger_id, :bericht, CURRENT_TIMESTAMP(), 0)');
    $statement->bindParam(':verzender_id', $this->verzender_id);
    $statement->bindParam(':ontvanger_id', $this->ontvanger_id);
    $statement->bindParam(':bericht', $this->bericht);

    return $statement->execute();
  }

  public static function getMessageHistory($person_a, $person_b){
    $conn = Db::getInstance();

    // Dit staat op aan om dezelfde parameter te hergebruiken in 1 query.
    // Wordt later in de functie terug uit gezet voor veiligheid.
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);

    $statement = $conn->prepare('SELECT * FROM tbl_berichten WHERE verzender_id IN (:person_a, :person_b) AND ontvanger_id IN (:person_a, :person_b) ORDER BY datum_tijd_verstuurd ASC');
    $statement->bindParam(':person_a', $person_a);
    $statement->bindParam(':person_b', $person_b);

    if ($statement->execute()){
      return $statement->fetchAll(PDO::FETCH_OBJ);
      $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
  }

  public function setLastMessageAsRead() {
    $conn = Db::getInstance();

    $statement = $conn->prepare('UPDATE tbl_berichten SET gelezen = 1 WHERE verzender_id = :verzender_id AND ontvanger_id = :ontvanger_id and gelezen = 0');
    $statement->bindParam(':verzender_id', $this->verzender_id);
    $statement->bindParam(':ontvanger_id', $this->ontvanger_id);

    return $statement->execute();
  }

  public static function checkForNewMessages($user_id, $partner_id){
    $conn = Db::getInstance();

    $statement = $conn->prepare('SELECT * FROM tbl_berichten WHERE ontvanger_id = :receiver_id AND verzender_id = :sender_id AND gelezen = 0');
    $statement->bindParam(':sender_id', $user_id);
    $statement->bindParam(':receiver_id', $partner_id);

    if ($statement->execute()){
      return $statement->rowCount();
    }
  }
}
