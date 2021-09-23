<?php
class Paciente {
  public $id = 0;
  public $name = "";
  private $link;

  public function __construct($id, $name, $link) {
    $this->id = $id;
    $this->name = $name;
    $this->link = $link;
  }

  function crearPaciente() {
    $query = "INSERT INTO paciente(name) VALUES ('$this->name')";
      $res = mysqli_query($this->link, $query);
      if(!$res) {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(array('error' => 'Error al crear el paciente'));
     }
     return $res;
  }
}

?>