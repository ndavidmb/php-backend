<?php
include_once('./models/register.php');
include_once('./controllers/base-controller.php');

class RegisterController extends BaseController
{
  public function __construct($method, $param)
  {
    parent::__construct($method, $param, requiereParam: ['PUT', 'DELETE']);
  }

  public function init()
  {
    switch ($this->method) {
      case 'POST':
        $this->createRegister();
        break;
      case 'GET':
        $this->getRegister();
        break;
      case 'PUT':
        $this->changeRegister();
        break;
      case 'DELETE':
        $this->dropRegister();
        break;
      default:
        response(['error' => 'Method not found'], 404);
        break;
    }
  }

  function createRegister()
  {
    [
      'idPaciente' => $idP,
      'idCama' => $idB,
      'fechaEntrada' => $entrada,
      'fechaSalida' => $salida,
      'costo' => $costo
    ] = request();

    $Register = new Register(
        idPatient: $idP,
        idBed: $idB,
        dateEntry: $entrada,
        dateExit: $salida,
        costRegister: $costo
    );
    $result = $Register->createRegister();
    if ($result == 1) {
      response(['status' => 'El Registro Se Ha Creado', 'error' => False], 200);
    } else {
      response(['status' => 'Error Al Crear', 'error' => true], 400);
    }
    exit();
  }

  function getRegister()
  {
    $Register = new Register();
    $result = $Register->readAllRegister();
    if (gettype($result) == 'string') {
      response(['status' => $result], 200);
      exit();
    }
    response(['data' => mapped($result), 'status' => 'OK', 'error' => False], 200);
  }

  function changeRegister()
  {
    $p = $this->param;
    [
      'idPaciente' => $idP,
      'idCama' => $idB,
      'fechaEntrada' => $entrada,
      'fechaSalida' => $salida,
      'costo' => $costo
    ] = request();
    $Register = new Register(
        idRegister: $p, 
        idPatient: $idP,
        idBed: $idB,
        dateEntry: $entrada,
        dateExit: $salida,
        costRegister: $costo
    );
    $resC = $Register->selectOne();
    if (!isset($resC)) {
      response(['status' => 'El Registro no existe', 'error' => True], 400);
      exit();
    }
    $res = $Register->updateRegister();
    if ($res == 1) {
      response(['status' => 'El Registro Se Ha Actualizado', 'error' => False], 200);
    } else {
      response(['status' => 'Error En Actualizacion', 'error' => true], 400);
    }
  }

  function dropRegister()
  {
    $p = $this->param;
    $Register = new Register(idRegister: $p);
    $resC = $Register->selectOne();
    if (!isset($resC)) {
      response(['status' => 'Registro no existe', 'error' => True], 400);
      exit();
    }
    $res = $Register->deleteRegister();
    if ($res == 1) {
      response(['status' => 'El Registro Se Ha Eliminado', 'error' => False], 200);
    } else {
      response(['status' => 'Error En Eliminar', 'error' => true], 400);
    }
  }
}