<?php
include_once('./models/phonepatient.php');
include_once('./controllers/base-controller.php');

class PhonePatientController extends BaseController
{
  public function __construct($method, $param)
  {
    parent::__construct($method, $param, requiereParam: ['PUT', 'DELETE']);
  }

  public function init()
  {
    switch ($this->method) {
      case 'POST':
        $this->createPhoneP();
        break;
      case 'GET':
        $this->getPhoneP();
        break;
      case 'PUT':
        $this->changePhoneP();
        break;
      case 'DELETE':
        $this->dropPhoneP();
        break;
      default:
        response(['error' => 'Method not found'], 404);
        break;
    }
  }

  function createPhoneP()
  {
    [
      'idPatient' => $id,
      'telPatient' => $tel
    ] = request();

    $PhoneP = new PhonePatient(
        idPatient: $id,
        telPatient: $tel
    );
    $result = $PhoneP->createPhonePatient();
    if ($result == 1) {
      response(['status' => 'El Telefono Se Ha Creado', 'error' => False], 200);
    } else {
      response(['status' => 'Error Al Crear', 'error' => true], 400);
    }
    exit();
  }

  function getPhoneP()
  {
    $PhoneP = new PhonePatient();
    $result = $PhoneP->readAllPhonePatient();
    if (gettype($result) == 'string') {
      response(['status' => $result], 200);
      exit();
    }
    response(['data' => mapped($result), 'status' => 'OK', 'error' => False], 200);
  }

  function changePhoneP()
  {
    $p = $this->param;
    [
        'idPatient' => $id,
        'telPatient' => $tel
    ] = request();
    $PhoneP = new PhonePatient(idPatient: $p, telPatient: $tel);
    $resC = $PhoneP->selectOne();
    if (!isset($resC)) {
      response(['status' => 'El Telefono no existe', 'error' => True], 400);
      exit();
    }
    $res = $PhoneP->updatePhonePatient();
    if ($res == 1) {
      response(['status' => 'El telefono Se Ha Actualizado', 'error' => False], 200);
    } else {
      response(['status' => 'Error En Actualizacion', 'error' => true], 400);
    }
  }

  function dropPhoneP()
  {
    $p = $this->param;
    $PhoneP = new PhonePatient(idPatient: $p);
    $resC = $PhoneP->selectOne();
    if (!isset($resC)) {
      response(['status' => 'Especialidad no existe', 'error' => True], 400);
      exit();
    }
    $res = $PhoneP->deletePhonePatient();
    if ($res == 1) {
      response(['status' => 'La Especialidad Se Ha Eliminado', 'error' => False], 200);
    } else {
      response(['status' => 'Error En Eliminar', 'error' => true], 400);
    }
  }
}