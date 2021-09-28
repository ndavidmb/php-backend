<?php
include_once('./models/user.php');
include_once('./controllers/base-controller.php');

class UserController extends BaseController{
  public function __construct($method, $param) {
    parent::__construct($method, $param);
  }

  function init() {
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

  function createUser() {
    [
      'password' => $password, 
      'email' => $email, 
      'username' => $username
    ] = request();

    $user = new User(email: $email, username: $username, password: $password);
    $result = $user->createUser();
    print_r($result);
    exit();
  }

  function getAllUser() {

  }

  function login() {
    [
      'email'=> $email, 
      'password'=> $password
    ] = request();
    $user = new User(email: $email, password: $password);
    $result = $user->login();
    if(isset($result)) {
      $user->user_id = $result['user_id'];
      $token = base64_encode($user->email) 
        .base64_encode(' ') 
        .base64_encode($user->password)
        .base64_encode(' ') 
        .base64_encode(date("m/d/y"));
      $user->token = $token;
      $tok = $user->generateToken($token);
      if($tok == 1) {
        response([
          'token' => $token,
          'status' => 'El usuario se ha loggeado'
        ], 200);
      }
      exit();
    }
    response(['status' => 'Correo o contraseña invalida'], 202);
  }

  function changePassword() {
    [
      'email' => $email, 
      'newPassword' => $newPassword
    ] = request();
    $user = new User(email: $email, password: $newPassword);
    $res = $user->findUserByEmail();
    echo $res;
  }


}

?>
