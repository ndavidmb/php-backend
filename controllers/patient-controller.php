<?php
include('./models/patient.php');

class PatientController {
  public function __construct($method) {
    $this->execute($method);
  }

  function execute($method) {
    switch ($method) {
      case 'POST':
        $this->createPatient();
        break;
    }
  }

  function createPatient() {
    ['name' => $name] = request();
    if(!isset($name)) {
      response(['error' => 'El campo es obligatorio'], 400);
      exit();
    }
    $patient = new Patient($name);
    $result = $patient->createPatient();
    if($result == 1) {
      response(['state' => 'El paciente ha sido creado correctamente'], 201);
    }
  }
}

?>
