<?php
include_once('./models/user.php');
include_once('./controllers/base-controller.php');

class UserController extends BaseController
{
  public function __construct($method, $param)
  {
    parent::__construct($method, $param);
  }

  function init()
  {
    switch ($this->method) {
      case 'POST':
        $this->createUser();
        break;
      case 'PATCH':
        $this->login();
        break;
      case 'PUT':
        $this->changePassword();
        break;
    }
  }

  private function createUser()
  {
    [
      'password' => $password,
      'email' => $email,
      'username' => $username
    ] = request();

    $user = new User(correo: $email, nomUsuario: $username, contra: $password);
    $result = $user->createUser();
    print_r($result);
    exit();
  }

  private function login()
  {
    [
      'email' => $email,
      'password' => $password
    ] = request();
    $user = new User(correo: $email, contra: $password);
    $result = $user->login();
    if (isset($result)) {
      $user->nomUsuario = $result['IdUsuario'];
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
    response(['status' => 'Correo o contraseña invalida'], 202);
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
}
