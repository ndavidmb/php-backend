<?php
include('./models/patient.php');
include_once('./controllers/base-controller.php');

class PatientController extends BaseController
{
  public function __construct($method, $param = null)
  {
    parent::__construct(
      method: $method,
      param: $param,
      requiereParam: ['PUT', 'DELETE']
    );
  }

  function init()
  {
    switch ($this->method) {
      case 'POST':
        $this->createPatient();
        break;
      case 'GET':
        $this->getAllPatients();
        break;
      case 'PUT':
        $this->updatePatient();
        break;
      case 'DELETE':
        $this->deletePatient();
        break;
      default:
        response(['status' => 'Method not found'], 404);
        break;
    }
  }

  function createPatient()
  {
    [
      'nomPaciente' => $nomPaciente,
      'apellPaciente' => $apellPaciente,
      'idSeguro' => $idSeguro
    ] = request();

    $patient = new Patient(
      nomPaciente: $nomPaciente,
      apellPaciente: $apellPaciente,
      idSeguro: $idSeguro
    );
    $res = $patient->createPatient();
    if ($res == 1) {
      response([
        'status' => 'Se ha creado correctamente el paciente',
        'error' => False
      ], 201);
      exit();
    }
    response([
      'status' => 'No se ha podido crear correctamente el paciente',
      'error' => True
    ], 400);
  }


  private function updatePatient()
  {
    [
      'nomPaciente' => $nomPaciente,
      'apellPaciente' => $apellPaciente,
      'idSeguro' => $idSeguro
    ] = request();


    $patient = new Patient(
      idPaciente: $this->param,
      nomPaciente: $nomPaciente,
      apellPaciente: $apellPaciente,
      idSeguro: $idSeguro
    );
    $res = $patient->updatePatient();
    if ($res == 1) {
      response(
        [
          'status' => 'Se ha actualizado correctamente el paciente',
          'error' => False
        ],
        200
      );
      exit();
    }
    response([
      'status' => 'No se ha podido actualizar correctamente el paciente',
      'error' => True
    ], 400);
  }

  private function getAllPatients()
  {
    $patient = new Patient();
    $res = $patient->readAllPatients();
    if (gettype($res) == 'string') {
      response([
        'status' => 'No se ha registrado ningún paciente',
        'error' => True
      ], 202);
      exit();
    }

    response([
      'data' => mapped($res),
      'status' => 'Ok',
      'error' => False
    ], 200);
  }

  private function deletePatient()
  {
    $patient = new Patient(idPaciente: $this->param);
    $exist = $patient->selectOne();
    if (!isset($exist)) {
      response([
        "error" => True,
        "status" => "No se ha encontrado ningún registro con el id: " . $this->param
      ], 400);
      exit();
    }
    $res = $patient->deletePatient();
    echo $res;
    response(["error" => False, "status" => "Se ha eliminado correctamente el paciente"], 200);
  }
}
