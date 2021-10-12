<?php
include_once('./models/user.php');
include_once('./controllers/base-controller.php');

class UserController extends BaseController
{
  public function __construct($method, $param)
  {
    parent::__construct(
      method: $method,
      param: $param,
      requiereParam: ['PATCH', 'PUT', 'DELETE']
    );
  }

  function init()
  {
    switch ($this->method) {
      case 'POST':
        $this->createUser();
        break;
      case 'PATCH':
        if ($this->param == 'login') {
          $this->login();
        } elseif ('changePassword') {
          $this->changePassword();
        } else {
          response(['error' => 'Method not found'], 404);
        }
        break;
      case 'PUT':
        $this->updateUser();
        break;
      case 'GET':
        $this->getAll();
        break;
      case 'DELETE':
        $this->dropUser();
        break;
      default:
        response(['error' => 'Method not found'], 404);
        break;
    }
  }

  private function createUser()
  {
    [
      'contra' => $contra,
      'correo' => $correo,
      'nomUsuario' => $nomUsuario,
      'idPerfil' => $idPerfil
    ] = request();

    $user = new User(correo: $correo, nomUsuario: $nomUsuario, contra: $contra, idPerfil: $idPerfil);
    $result = $user->createUser();
    if ($result == 1) {
      response([
        'status' => 'Se ha creado correctamente el usuario',
        'error' => False
      ], 201);
      exit();
    }
    response([
      'status' => 'No se ha podido crear correctamente el usuario',
      'error' => True
    ], 400);
  }

  private function updateUser()
  {
    [
      'nomUsuario' => $nomUsuario,
      'correo' => $correo,
      'contra' => $contra,
      'idPerfil' => $idPerfil
    ] = request();
    $user = new User(
      nomUsuario: $nomUsuario,
      correo: $correo,
      contra: $contra,
      idUsuario: $this->param,
      idPerfil: $idPerfil
    );
    $userLogin = $user->login();
    if (!isset($userLogin)) {
      response([
        'status' => 'Correo o contraseña invalida',
        'error' => True
      ], 202);
      exit();
    }

    $res = $user->updateUser();
    if ($res == 1) {
      response(
        [
          'status' => 'Se ha actualizado correctamente el usuario',
          'error' => False
        ],
        200
      );
    }
  }

  private function getAll()
  {
    $user = new User();
    $res = $user->readAllUser();
    if (gettype($res) == 'string') {
      response(['status' => $res, 'error' => False], 202);
      exit();
    }

    response([
      'data' => mapped($res),
      'status' => 'Ok',
      'error' => False,
    ], 200);
  }

  private function login()
  {
    [
      'email' => $email,
      'password' => $password
    ] = request();
    $user = new User(correo: $email, contra: $password, nomUsuario: $email);
    $result = $user->login();
    if (isset($result)) {
      $user->idUsuario = $result['IdUsuario'];
      $token = base64_encode($user->correo)
        . base64_encode(' ')
        . base64_encode($user->contra)
        . base64_encode(' ')
        . base64_encode(date("m/d/y"));
      $user->token = $token;
      $tok = $user->generateToken($token);
      if ($tok == 1) {
        response([
          'token' => $token,
          'status' => 'El usuario se ha loggeado'
        ], 200);
      }
      exit();
    }
    response(['status' => 'Correo o contraseña invalida'], 400);
  }

  private function changePassword()
  {
    [
      'email' => $email,
      'newPassword' => $newPassword
    ] = request();
    $user = new User(correo: $email, contra: $newPassword);
    $res = $user->changePassword();
    echo $res;
  }

  function dropUser()
  {
    $p = $this->param;
    $user = new User(idUsuario: $p);
    $resC = $user->selectUser();
    if (!isset($resC)) {
      response(['status' => 'Usuario no existe', 'error' => True], 400);
      exit();
    }
    $res = $user->deleteUser();
    if ($res == 1) {
      response(['status' => 'El Usuario Se Ha Eliminado', 'error' => False], 200);
    } else {
      response(['status' => 'Error En Eliminar', 'error' => true], 400);
    }
  }
}
