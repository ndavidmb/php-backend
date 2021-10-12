<?php
include('./models/patient.php');
include_once('./controllers/base-controller.php');

class PatientController extends BaseController {
  public function __construct($method, $param = null) {
    parent::__construct(method: $method,param: $param);
  }

  function init() {
    switch ($this->method) {
      case 'POST':
        $this->createPatient();
        break;
      default:
        response(['status' => 'Method not found'], 404);
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
