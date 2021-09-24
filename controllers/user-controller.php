<?php
include('./models/user.php');
class UsuarioController {
  public function __construct($link, $method) {
    $this->link = $link;
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
    }
  }

  function createUser() {
    // Esto transforma el json enviado en array php
	  $input = (array) json_decode(file_get_contents('php://input'), TRUE);
    $correo = $input["correo"];
    $username = $input["usernamename"];
    $password = $input["password"];
    $usuario = new user($correo, $username, $password, $this->link);
    $result = $usuario->crearUsuario();
    print_r($result);
    exit();
  }

  function getAllUser() {

  }
}

?>