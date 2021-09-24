<?php
class user {
  public $correo = "";
  public $username = "";
  public $password = "";

  private $link;

  public function __construct($correo, $username, $password, $link) {
    $this->correo = $correo;
    $this->username = $username;
    $this->password = $password;
    $this->link = $link;
  }

  function crearUsuario() {
    $query = "INSERT INTO usuario(correo,username,password) 
    VALUES ('$this->correo','$this->username','$this->password')";
      $res = mysqli_query($this->link, $query);
      if(!$res) {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(array('error' => 'Error al crear el paciente'));
     }
     return $res;
  }

  function buscarUsuario() {
    $query = "SELECT correo,password FROM usuario WHERE correo='$this->correo'";
      $res = mysqli_query($this->link, $query);
      if(!$res) {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(array('error' => 'Error al crear el paciente'));
     }
     return $res;
  }
}

?>