<?php
include_once('./models/profile.php');
include_once('./controllers/base-controller.php');

class ProfileController extends BaseController
{
  public function __construct($method, $param)
  {
    parent::__construct($method, $param, requiereParam: ['PUT', 'DELETE']);
  }

  public function init()
  {
    switch ($this->method) {
      case 'POST':
        $this->createProfile();
        break;
      case 'GET':
        $this->getProfile();
        break;
      case 'PUT':
        $this->changeProfile();
        break;
      case 'DELETE':
        $this->dropProfile();
        break;
      default:
        response(['error' => 'Method not found'], 404);
        break;
    }
  }

  function createProfile()
  {
    [
      'nomPerfil' => $nombre
    ] = request();

    $Profile = new Profile(
        nomProfile: $nombre
    );
    $result = $Profile->createProfile();
    if ($result == 1) {
      response(['status' => 'El perfil Se Ha Creado', 'error' => False], 200);
    } else {
      response(['status' => 'Error Al Crear', 'error' => true], 400);
    }
    exit();
  }

  function getProfile()
  {
    $Profile = new Profile();
    $result = $Profile->readAllProfile();
    if (gettype($result) == 'string') {
      response(['status' => $result], 200);
      exit();
    }
    response(['data' => mapped($result), 'status' => 'OK', 'error' => False], 200);
  }

  function changeProfile()
  {
    $p = $this->param;
    [
        'nomPerfil' => $nombre
    ] = request();
    $Profile = new Profile(idProfile: $p, nomProfile: $nombre);
    $resC = $Profile->selectOne();
    if (!isset($resC)) {
      response(['status' => 'Perfil no existe', 'error' => True], 400);
      exit();
    }
    $res = $Profile->updateProfile();
    if ($res == 1) {
      response(['status' => 'El Perfil Se Ha Actualizado', 'error' => False], 200);
    } else {
      response(['status' => 'Error En Actualizacion', 'error' => true], 400);
    }
  }

  function dropProfile()
  {
    $p = $this->param;
    $Profile = new Profile(idProfile: $p);
    $resC = $Profile->selectOne();
    if (!isset($resC)) {
      response(['status' => 'Perfil no existe', 'error' => True], 400);
      exit();
    }
    $res = $Profile->deleteProfile();
    if ($res == 1) {
      response(['status' => 'El perfil Se Ha Eliminado', 'error' => False], 200);
    } else {
      response(['status' => 'Error En Eliminar', 'error' => true], 400);
    }
  }
}
