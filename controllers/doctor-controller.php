<?php
include('./models/doctor');
include_once('./controllers/base-controller.php');

class DoctorController extends BaseController {

  public function __construct($method, $param = null) {
    parent::__construct(method: $method,param: $param);
  }

  public function init() {
    switch ($this->method) {
      case 'POST':
        $this->createDoctor();
        break;
      case 'GET':
        $this->getAllDoctors();
        break;
      case 'PUT':
        $this->updateDoctor();
        break;
      case 'DELETE':
        break;
      default:
        response(['error' => 'Method not found'], 404);
        break;
    }
  }

  private function createDoctor() {
    [
      'doctorName' => $nomDoctor,
      'doctorLastname' => $apellDoctor,
      'idSpeciality' => $idEspecialidad,
    ] = request();

    $doctor = new Doctor(
      nomDoctor: $nomDoctor, 
      apellDoctor: $apellDoctor,
      idEspecialidad: $idEspecialidad
    );
    $res = $doctor->createDoctor();
    if($res == 1) {
      response([
        'status' => 'Se ha creado correctamente el doctor',
        'error' => False], 201
      );
      exit();
    }
    response([
      'status' => 'No se ha podido crear correctamente el doctor', 
      'error' => True
    ], 400);
  }

  private function updateDoctor() {
    [
      'doctorName' => $nomDoctor,
      'doctorLastname' => $apellDoctor,
      'idSpeciality' => $idEspecialidad,
    ] = request();
    $doctor = new Doctor(
      idDoctor: $this->param,
      nomDoctor: $nomDoctor,
      apellDoctor: $apellDoctor,
      idEspecialidad: $idEspecialidad
    );
    $res = $doctor->updateDoctor();
    if($res == 1) {
      response([
        'status' => 'Se ha actualizado correctamente el doctor',
        'error' => False], 200
      );
      exit();
    }
    response([
      'status' => 'No se ha podido actualizar correctamente el doctor', 
      'error' => True
    ], 400);
  }

  private function getAllDoctors() {
    $doctor = new Doctor();
    $res = $doctor->readAllDoctors();
    if(gettype($res) == 'string') {
      response([
        'data' => 'No se ha registrado ningún doctor',
        'error' => False
      ], 200);
      exit();
    }
    print_r($res);
  }

}
?>
