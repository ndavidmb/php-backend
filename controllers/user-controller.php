<?php
include_once('./models/user.php');
include_once('./controllers/base-controller.php');

class UserController extends BaseController
{
  public function __construct($method, $param) {
    parent::__construct(
      method: $method,
      param: $param,
      requiereParam: ['PATCH', 'PUT', 'DELETE']
    );
  }

  function init() {
    switch ($this->method) {
      case 'POST':
        $this->createUser();
        break;
      case 'PATCH':
        if($this->param == 'login') {
          $this->login();
        } elseif('changePassword') {
          $this->changePassword();
        } else {
          response(['error' => 'Method not found'], 404);
        }
        break;
      case 'PUT':
        $this->updateUser();
        break;
      default:
        response(['error' => 'Method not found'], 404);
        break;
    }
  }

  private function createUser() {
    [
      'contra' => $contra,
      'correo' => $correo,
      'nomUsuario' => $nomUsuario
    ] = request();

    $user = new User(correo: $correo, nomUsuario: $nomUsuario, contra: $contra);
    $result = $user->createUser();
    if($result == 1) {
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

  private function updateUser() {
    [
      'nomDoctor' => $nomDoctor,
      'apellDoctor' => $apellDoctor,
      'idEspecialidad' => $idEspecialidad,
    ] = request();
    // $user = new User(
    // );
    // $res = $user->updateUser();
    // if($res == 1) {
    //   response([
    //     'status' => 'Se ha actualizado correctamente el doctor',
    //     'error' => False], 200
    //   );
    //   exit();
    // }
    // response([
    //   'status' => 'No se ha podido actualizar correctamente el doctor', 
    //   'error' => True
    // ], 400);
  }

  private function login() {
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

  private function changePassword() {
    [
      'email' => $email,
      'newPassword' => $newPassword
    ] = request();
    $user = new User(correo: $email, contra: $newPassword);
    $res = $user->changePassword();
    echo $res;
  }

  /*function dropUser() {
    $p= $this->param;
    $user = new User(idUser:$p);
    $resC = $user->select();
    if(!isset($resC)){
      response(['status' => 'Especialidad no existe','error' => True],400);
      exit();
    }
    $res = $speciality->deleteSpeciality();
    if($res==1){
      response(['status' => 'La Especialidad Se Ha Eliminado','error' => False],200);
    }else{
      response(['status' => 'Error En Eliminar','error' => true], 400);
    }
  }*/
}
