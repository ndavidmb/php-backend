<?php
include_once('./models/bed.php');
include_once('./controllers/base-controller.php');

class BedController extends BaseController
{
  public function __construct($method, $param)
  {
    parent::__construct($method, $param, requiereParam: ['PUT', 'DELETE']);
  }

  public function init()
  {
    switch ($this->method) {
      case 'POST':
        $this->createBed();
        break;
      case 'GET':
        $this->getBed();
        break;
      case 'PUT':
        $this->changeBed();
        break;
      case 'DELETE':
        $this->dropBed();
        break;
      default:
        response(['error' => 'Method not found'], 404);
        break;
    }
  }

  function createBed()
  {
    [
      'disponible' => $disponible,
      'costo' => $costo
    ] = request();

    $Bed = new Bed(
        availability: $disponible,
        cost: $costo
    );
    $result = $Bed->createBed();
    if ($result == 1) {
      response(['status' => 'La Cama Se Ha Creado', 'error' => False], 200);
    } else {
      response(['status' => 'Error Al Crear', 'error' => true], 400);
    }
    exit();
  }

  function getBed()
  {
    $Bed = new Bed();
    $result = $Bed->readAllBeds();
    if (gettype($result) == 'string') {
      response(['status' => $result], 200);
      exit();
    }
    response(['data' => mapped($result), 'status' => 'OK', 'error' => False], 200);
  }

  function changeBed()
  {
    $p = $this->param;
    [
        'availability' => $disponible,
        'cost' => $costo
    ] = request();
    $Bed = new Bed(idBed: $p, availability: $disponible, cost: $costo);
    $resC = $Bed->selectOne();
    if (!isset($resC)) {
      response(['status' => 'Cama no existe', 'error' => True], 400);
      exit();
    }
    $res = $Bed->updateBed();
    if ($res == 1) {
      response(['status' => 'La Cama Se Ha Actualizado', 'error' => False], 200);
    } else {
      response(['status' => 'Error En Actualizacion', 'error' => true], 400);
    }
  }

  function dropBed()
  {
    $p = $this->param;
    $Bed = new Bed(idBed: $p);
    $resC = $Bed->selectOne();
    if (!isset($resC)) {
      response(['status' => 'Cama no existe', 'error' => True], 400);
      exit();
    }
    $res = $Bed->deleteBed();
    if ($res == 1) {
      response(['status' => 'La Cama Se Ha Eliminado', 'error' => False], 200);
    } else {
      response(['status' => 'Error En Eliminar', 'error' => true], 400);
    }
  }
}
