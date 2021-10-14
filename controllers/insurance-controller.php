<?php
include_once('./models/insurance.php');
include_once('./controllers/base-controller.php');

class InsuranceController extends BaseController
{
  public function __construct($method, $param)
  {
    parent::__construct($method, $param, requiereParam: ['PUT', 'DELETE']);
  }

  public function init()
  {
    switch ($this->method) {
      case 'POST':
        $this->createInsurance();
        break;
      case 'GET':
        $this->getInsurance();
        break;
      case 'PUT':
        $this->changeInsurance();
        break;
      case 'DELETE':
        $this->dropInsurance();
        break;
      default:
        response(['error' => 'Method not found'], 404);
        break;
    }
  }

  function createInsurance()
  {
    [
      'nomSeguro' => $nombre
    ] = request();

    $Insurance = new Insurance(
        nomInsurance: $nombre
    );
    $result = $Insurance->createInsurance();
    if ($result == 1) {
      response(['status' => 'El Seguro Se Ha Creado', 'error' => False], 200);
    } else {
      response(['status' => 'Error Al Crear', 'error' => true], 400);
    }
    exit();
  }

  function getInsurance()
  {
    $Insurance = new Insurance();
    $result = $Insurance->readAllInsurance();
    if (gettype($result) == 'string') {
      response(['status' => $result], 200);
      exit();
    }
    response(['data' => mapped($result), 'status' => 'OK', 'error' => False], 200);
  }

  function changeInsurance()
  {
    $p = $this->param;
    [
        'nomSeguro' => $nombre
    ] = request();
    $Insurance = new Insurance(idInsurance: $p, nomInsurance: $nombre);
    $resC = $Insurance->selectOne();
    if (!isset($resC)) {
      response(['status' => 'Seguro no existe', 'error' => True], 400);
      exit();
    }
    $res = $Insurance->updateInsurance();
    if ($res == 1) {
      response(['status' => 'El Seguro Se Ha Actualizado', 'error' => False], 200);
    } else {
      response(['status' => 'Error En Actualizacion', 'error' => true], 400);
    }
  }

  function dropInsurance()
  {
    $p = $this->param;
    $Insurance = new Insurance(idInsurance: $p);
    $resC = $Insurance->selectOne();
    if (!isset($resC)) {
      response(['status' => 'Seguro no existe', 'error' => True], 400);
      exit();
    }
    $res = $Insurance->deleteInsurance();
    if ($res == 1) {
      response(['status' => 'El Seguro Se Ha Eliminado', 'error' => False], 200);
    } else {
      response(['status' => 'Error En Eliminar', 'error' => true], 400);
    }
  }
}
