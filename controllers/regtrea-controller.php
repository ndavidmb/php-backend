<?php
include_once('./models/regtrea.php');
include_once('./controllers/base-controller.php');

class RegTreaController extends BaseController
{
  public function __construct($method, $param)
  {
    parent::__construct($method, $param, requiereParam: ['PUT', 'DELETE']);
  }

  public function init()
  {
    switch ($this->method) {
      case 'POST':
        $this->createRegT();
        break;
      case 'GET':
        $this->getRegT();
        break;
      case 'PUT':
        $this->changeRegT();
        break;
      case 'DELETE':
        $this->dropRegT();
        break;
      default:
        response(['error' => 'Method not found'], 404);
        break;
    }
  }

  function createRegT()
  {
    [
      'idTreatment' => $idT,
      'idRegister' => $idR
    ] = request();

    $Regt = new RegTrea(
        idTreatment: $idT,
        idRegister: $idR
    );
    $result = $Regt->createRegTrea();
    if ($result == 1) {
      response(['status' => 'Se Ha Creado', 'error' => False], 200);
    } else {
      response(['status' => 'Error Al Crear', 'error' => true], 400);
    }
    exit();
  }

  function getRegT()
  {
    $Regt = new RegTrea();
    $result = $Regt->readAllRegTrea();
    if (gettype($result) == 'string') {
      response(['status' => $result], 200);
      exit();
    }
    response(['data' => mapped($result), 'status' => 'OK', 'error' => False], 200);
  }

  function changeRegT()
  {
    $p = $this->param;
    [
      'idTreatment' => $idT,
      'idRegister' => $idR
    ] = request();
    $Regt = new RegTrea(
        idTreatment: $idT, 
        idRegister: $idR
    );
    $resC = $Regt->selectOne();
    if (!isset($resC)) {
      response(['status' => 'El Registro no existe', 'error' => True], 400);
      exit();
    }
    $res = $Regt->updateRegTrea();
    if ($res == 1) {
      response(['status' => 'Se Ha Actualizado', 'error' => False], 200);
    } else {
      response(['status' => 'Error En Actualizacion', 'error' => true], 400);
    }
  }

  function dropRegT()
  {
    $p = $this->param;
    $Regt = new RegTrea(idTreatment: $p,idRegister: $p);
    $resC = $Regt->selectOne();
    if (!isset($resC)) {
      response(['status' => 'Registro no existe', 'error' => True], 400);
      exit();
    }
    $res = $Regt->deleteRegTrea();
    if ($res == 1) {
      response(['status' => 'El Registro Se Ha Eliminado', 'error' => False], 200);
    } else {
      response(['status' => 'Error En Eliminar', 'error' => true], 400);
    }
  }
}