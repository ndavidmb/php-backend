<?php
include('./models/user.php');
class UserController {
  public function __construct($method) {
    $this->execute($method);
  }

  function execute($method) {
    switch ($method) {
      case 'POST':
        $this->createUser();
        break;
      case 'GET':
        $this->getAllUser();
        break;
      case 'PATCH':
        $this->login();
        break;
    }
  }

  function createUser() {
    [
      'password' => $password, 
      'email' => $email, 
      'username' => $username
    ] = request();

    $user = new User($email, $username, $password);
    $result = $user->createUser();
    print_r($result);
    exit();
  }

  function getAllUser() {

  }

  function login() {
    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
    $email = $input["email"];
    $password = $input["password"];
    $user = new User($email, "", $password);
    $result = $user->login();
    print_r($result);
    exit();
  }
}

?>
