<?php
include_once('./models/treatment.php');
include_once('./controllers/base-controller.php');

class TreatmentController extends BaseController
{
  public function __construct($method, $param)
  {
    parent::__construct($method, $param, requiereParam: ['PUT', 'DELETE']);
  }

  public function init()
  {
    switch ($this->method) {
      case 'POST':
        $this->createTreatment();
        break;
      case 'GET':
        $this->getTreatment();
        break;
      case 'PUT':
        $this->changeTreatment();
        break;
      case 'DELETE':
        $this->dropTreatment();
        break;
    }
  }

  function createTreatment()
  {
    [
      'nomTratamiento' => $nombre,
      'cosTratamiento' => $costo
    ] = request();

    $Treatment = new Treatment(
        nomTreatment: $nombre,
        cosTreatment: $costo
    );
    $result = $Treatment->createTraetment();
    if ($result == 1) {
      response(['status' => 'La Especialidad Se Ha Creado', 'error' => False], 200);
    } else {
      response(['status' => 'Error Al Crear', 'error' => true], 400);
    }
    exit();
  }

  function getTreatment()
  {
    $Treatment = new Treatment();
    $result = $Treatment->readAllTraetment();
    if (gettype($result) == 'string') {
      response(['status' => $result], 200);
      exit();
    }
    response(['data' => mapped($result), 'status' => 'OK', 'error' => False], 200);
  }

  function changeTreatment()
  {
    $p = $this->param;
    [
        'nomTratamiento' => $nombre,
        'cosTratamiento' => $costo
    ] = request();
    $Treatment = new Treatment(idTreatment: $p, nomTreatment: $nombre, cosTreatment: $costo);
    $resC = $Treatment->selectOne();
    if (!isset($resC)) {
      response(['status' => 'Tratamiento no existe', 'error' => True], 400);
      exit();
    }
    $res = $Treatment->updateTraetment();
    if ($res == 1) {
      response(['status' => 'El tratamiento Se Ha Actualizado', 'error' => False], 200);
    } else {
      response(['status' => 'Error En Actualizacion', 'error' => true], 400);
    }
  }

  function dropTreatment()
  {
    $p = $this->param;
    $Treatment = new Treatment(idTreatment: $p);
    $resC = $Treatment->selectOne();
    if (!isset($resC)) {
      response(['status' => 'Tratamiento no existe', 'error' => True], 400);
      exit();
    }
    $res = $Treatment->deleteTraetment();
    if ($res == 1) {
      response(['status' => 'El Tratamiento Se Ha Eliminado', 'error' => False], 200);
    } else {
      response(['status' => 'Error En Eliminar', 'error' => true], 400);
    }
  }
}
