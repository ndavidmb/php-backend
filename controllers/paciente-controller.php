<?php
include('./models/paciente.php');
class PacienteController {
  public function __construct($link, $method) {
    $this->link = $link;
    $this->execute($method);
  }

  function execute($method) {
    switch ($method) {
      case 'POST':
        $this->createPatient();
        break;
      case 'GET':
        $this->getAllPatients();
        break;
    }
  }

  function createPatient() {
    // Esto transforma el json enviado en array php
	  $input = (array) json_decode(file_get_contents('php://input'), TRUE);
    $name = $input["name"];
    $paciente = new Paciente(0, $name, $this->link);
    $result = $paciente->crearPaciente();
    print_r($result);
    exit();
  }

  function getAllPatients() {

  }
}

?>