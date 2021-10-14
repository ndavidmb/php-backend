<?php
include_once('./models/doctrea.php');
include_once('./controllers/base-controller.php');

class DocTreaController extends BaseController
{
  public function __construct($method, $param)
  {
    parent::__construct($method, $param, requiereParam: ['PUT', 'DELETE']);
  }

  public function init()
  {
    switch ($this->method) {
      case 'POST':
        $this->createDocT();
        break;
      case 'GET':
        $this->getDocT();
        break;
      case 'PUT':
        $this->changeDocT();
        break;
      case 'DELETE':
        $this->dropDocT();
        break;
      default:
        response(['error' => 'Method not found'], 404);
        break;
    }
  }

  function createDocT()
  {
    [
      'idTreatment' => $idT,
      'idDoctor' => $idD
    ] = request();

    $Doct = new DocTrea(
        idTreatment: $idT,
        idDoctor: $idD
    );
    $result = $Doct->createDocTrea();
    if ($result == 1) {
      response(['status' => 'Se Ha Creado', 'error' => False], 200);
    } else {
      response(['status' => 'Error Al Crear', 'error' => true], 400);
    }
    exit();
  }

  function getDocT()
  {
    $Doct = new DocTrea();
    $result = $Doct->readAllDocTrea();
    if (gettype($result) == 'string') {
      response(['status' => $result], 200);
      exit();
    }
    response(['data' => mapped($result), 'status' => 'OK', 'error' => False], 200);
  }

  function changeDocT()
  {
    $p = $this->param;
    [
      'idTreatment' => $idT,
      'idDoctor' => $idD
    ] = request();
    $Doct = new DocTrea(
        idTreatment: $idT, 
        idDoctor: $idD
    );
    $resC = $Doct->selectOne();
    if (!isset($resC)) {
      response(['status' => 'El Registro no existe', 'error' => True], 400);
      exit();
    }
    $res = $Doct->updateDocTrea();
    if ($res == 1) {
      response(['status' => 'Se Ha Actualizado', 'error' => False], 200);
    } else {
      response(['status' => 'Error En Actualizacion', 'error' => true], 400);
    }
  }

  function dropDocT()
  {
    $p = $this->param;
    $Doct = new DocTrea(idTreatment: $p,idDoctor: $p);
    $resC = $Doct->selectOne();
    if (!isset($resC)) {
      response(['status' => 'Registro no existe', 'error' => True], 400);
      exit();
    }
    $res = $Doct->deleteDocTrea();
    if ($res == 1) {
      response(['status' => 'El Registro Se Ha Eliminado', 'error' => False], 200);
    } else {
      response(['status' => 'Error En Eliminar', 'error' => true], 400);
    }
  }
}