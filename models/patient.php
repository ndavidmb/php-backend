<?php
include_once("./models/generic-model.php");

class Patient extends GenericModel {

  public function __construct($name, $id = 0) {
    parent::__construct("patient");
    $this->id = $id;
    $this->name = $name;
  }

  function createPatient() {
    $query = "INSERT INTO $this->table_name(name) VALUES ('$this->name')";
    $res = $this->exec($query);
    return $res;
  }
}

?>
