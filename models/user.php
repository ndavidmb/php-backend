<?php
include_once("./models/generic-model.php");

class User extends GenericModel {
  public $token = null;

  public function __construct(
    string $email,
    string $password, 
    ?string $username = null, 
    ?int $user_id = null
  ) {
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
    if(mysqli_num_rows($res) != 0) {
      $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
      return $row;
    }
    return null;
  }

  function findUserByEmail() {
    $query = "SELECT * FROM $this->table_name WHERE email='$this->email'";
    $res = $this->exec($query);
    return $res;
  }

  function changePassword() {
    $query = "UPDATE $this->table_name SET password='$this->password' WHERE email='$this->email'";
    $res = $this->exec($query);
    return $res;
  }

  function generateToken() {
    $query = "UPDATE $this->table_name SET token='$this->token' WHERE user_id=$this->user_id";
    $res = $this->exec($query);
    return $res;
  }

  function validateToken($token) {
    $query = "SELECT * FROM $this->table_name WHERE token='$token'";
    $res = $this->exec($query);
    return $res;
  }

}

?>
