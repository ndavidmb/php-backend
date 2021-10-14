<?php
include_once('./models/phonedoctor.php');
include_once('./controllers/base-controller.php');

class PhoneDoctorController extends BaseController
{
  public function __construct($method, $param)
  {
    parent::__construct($method, $param, requiereParam: ['PUT', 'DELETE']);
  }

  public function init()
  {
    switch ($this->method) {
      case 'POST':
        $this->createPhoneD();
        break;
      case 'GET':
        $this->getPhoneD();
        break;
      case 'PUT':
        $this->changePhoneD();
        break;
      case 'DELETE':
        $this->dropPhoneD();
        break;
      default:
        response(['error' => 'Method not found'], 404);
        break;
    }
  }

  function createPhoneD()
  {
    [
      'idDoctor' => $id,
      'telDoctor' => $tel
    ] = request();

    $PhoneD = new PhoneDoctor(
        idDoctor: $id,
        telDoctor: $tel
    );
    $result = $PhoneD->createPhoneDoctor();
    if ($result == 1) {
      response(['status' => 'El Telefono Se Ha Creado', 'error' => False], 200);
    } else {
      response(['status' => 'Error Al Crear', 'error' => true], 400);
    }
    exit();
  }

  function getPhoneD()
  {
    $PhoneD = new PhoneDoctor();
    $result = $PhoneD->readAllPhoneDoctors();
    if (gettype($result) == 'string') {
      response(['status' => $result], 200);
      exit();
    }
    response(['data' => mapped($result), 'status' => 'OK', 'error' => False], 200);
  }

  function changePhoneD()
  {
    $p = $this->param;
    [
        'telDoctor' => $tel
    ] = request();
    $PhoneD = new PhoneDoctor(idDoctor: $p, telDoctor: $tel);
    $resC = $PhoneD->selectOne();
    if (!isset($resC)) {
      response(['status' => 'El Telefono no existe', 'error' => True], 400);
      exit();
    }
    $res = $PhoneD->updatePhoneDoctor();
    if ($res == 1) {
      response(['status' => 'El telefono Se Ha Actualizado', 'error' => False], 200);
    } else {
      response(['status' => 'Error En Actualizacion', 'error' => true], 400);
    }
  }

  function dropPhoneD()
  {
    $p = $this->param;
    $PhoneD = new PhoneDoctor(idDoctor: $p);
    $resC = $PhoneD->selectOne();
    if (!isset($resC)) {
      response(['status' => 'Especialidad no existe', 'error' => True], 400);
      exit();
    }
    $res = $PhoneD->deletePhoneDoctor();
    if ($res == 1) {
      response(['status' => 'La Especialidad Se Ha Eliminado', 'error' => False], 200);
    } else {
      response(['status' => 'Error En Eliminar', 'error' => true], 400);
    }
  }
}
