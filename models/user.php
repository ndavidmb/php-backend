<?php
include_once("./models/generic-model.php");

class User extends GenericModel {

  public function __construct($email, $username, $password, $user_id = 0) {
    parent::__construct("user");
    $this->user_id = $user_id;
    $this->email = $email;
    $this->username = $username;
    $this->password = $password;
  }

  function createUser() {
    $query = "INSERT INTO $this->table_name(email,username,password)
    VALUES ('$this->email','$this->username','$this->password')";
    $res = mysqli_query($this->link, $query);
    if(!$res) {
      response(['error' => 'Error al crear el usuario'], 400);
    }
    return $res;
  }

  function login() {
    $query = "SELECT * FROM $this->table_name 
              WHERE (email='$this->email' OR username='$this->username') 
              AND password='$this->password'";
    $res = $this->exec($query);
    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
    return $row;
  }

  function findUser() {
    $query = "SELECT * FROM $this->table_name WHERE email='$this->email' AND password='this->password'";
      $res = mysqli_query($this->link, $query);
      if(!$res) {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(array('error' => 'Error al crear el usuario'));
     }
     return $res;
  }
}

?>
