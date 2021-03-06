<?php
include_once('./models/speciality.php');
include_once('./controllers/base-controller.php');

class SpecialityController extends BaseController
{
  public function __construct($method, $param)
  {
    parent::__construct($method, $param, requiereParam: ['PUT', 'DELETE']);
  }

  public function init()
  {
    switch ($this->method) {
      case 'POST':
        $this->createSpeciality();
        break;
      case 'GET':
        $this->getSpeciality();
        break;
      case 'PUT':
        $this->changeSpeciality();
        break;
      case 'DELETE':
        $this->dropSpeciality();
        break;
      default:
        response(['error' => 'Method not found'], 404);
        break;
    }
  }

  function createSpeciality()
  {
    [
      'nomEspecialidad' => $nombre
    ] = request();

    $speciality = new Speciality(nomEspecialidad: $nombre);
    $result = $speciality->createSpeciality();
    if ($result == 1) {
      response(['status' => 'La Especialidad Se Ha Creado', 'error' => False], 200);
    } else {
      response(['status' => 'Error Al Crear', 'error' => true], 400);
    }
    exit();
  }

  function getSpeciality()
  {
    $speciality = new Speciality();
    $result = $speciality->readAllSpeciality();
    if (gettype($result) == 'string') {
      response(['status' => $result], 200);
      exit();
    }
    response(['data' => mapped($result), 'status' => 'OK', 'error' => False], 200);
  }

  function changeSpeciality()
  {
    $p = $this->param;
    ['nomSpeciality' => $nombre] = request();
    $speciality = new Speciality(idEspecialidad: $p, nomEspecialidad: $nombre);
    $resC = $speciality->selectSpeciality();
    if (!isset($resC)) {
      response(['status' => 'Especialidad no existe', 'error' => True], 400);
      exit();
    }
    $res = $speciality->updateSpeciality();
    if ($res == 1) {
      response(['status' => 'La Especialidad Se Ha Actualizado', 'error' => False], 200);
    } else {
      response(['status' => 'Error En Actualizacion', 'error' => true], 400);
    }
  }

  function dropSpeciality()
  {
    $p = $this->param;
    $speciality = new Speciality(idEspecialidad: $p);
    $resC = $speciality->selectSpeciality();
    if (!isset($resC)) {
      response(['status' => 'Especialidad no existe', 'error' => True], 400);
      exit();
    }
    $res = $speciality->deleteSpeciality();
    if ($res == 1) {
      response(['status' => 'La Especialidad Se Ha Eliminado', 'error' => False], 200);
    } else {
      response(['status' => 'Error En Eliminar', 'error' => true], 400);
    }
  }
}
