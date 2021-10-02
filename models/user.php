<?php
include_once("./models/generic-model.php");

class User extends GenericModel
{
  public $token = null;

  public function __construct(
    ?string $correo = null,
    ?string $contra = null,
    ?string $nomUsuario = null,
    ?int $idUsuario = null
  ) {
    parent::__construct("usuario");
    $this->idUsuario = $idUsuario;
    $this->correo = $correo;
    $this->nomUsuario = $nomUsuario;
    $this->contra = $contra;
  }

  //CRUD
  function createUser()
  {
    $query = "INSERT INTO $this->table_name(correo,nomUsuario,contra)
    VALUES ('$this->correo','$this->nomUsuario','$this->contra')";
    $res = $this->exec($query);
    return $res;
  }

  function updateUser()
  {
    $query = "UPDATE $this->table_name
      SET NomUsuario='$this->nomUsuario',
      SET correo='$this->correo'
      WHERE IdUsuario = $this->idUsuario";
    $res = $this->exec($query);
    return $res;
  }

  function login()
  {
    $query = "SELECT * FROM $this->table_name
              WHERE (correo='$this->correo' OR nomUsuario='$this->nomUsuario')
              AND contra='$this->contra'";
    $res = $this->exec($query);
    if (mysqli_num_rows($res) != 0) {
      $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
      return $row;
    }
    return null;
  }

  function changePassword()
  {
    $query = "UPDATE $this->table_name
      SET contra='$this->contra'
      WHERE correo='$this->correo'";
    $res = $this->exec($query);
    return $res;
  }

  function generateToken()
  {
    $query = "UPDATE $this->table_name
      SET token='$this->token' WHERE idUsuario=$this->idUsuario";
    $res = $this->exec($query);
    return $res;
  }

  function validateToken($token)
  {
    $query = "SELECT * FROM $this->table_name WHERE token='$token'";
    $res = $this->exec($query);
    return $res;
  }

  function readAllUser()
  {
    $query = "SELECT * FROM $this->table_name";
    $res = $this->exec($query);
    if (mysqli_num_rows($res) != 0) {
      while ($row = $res->fetch_array()) {
        $rows[] = $row;
      }
      return $rows;
    }
    return "No se encontro ningún regitro";
  }

  function deleteUser()
  {
    $query = "DELETE FROM $this->table_name WHERE IdUsuario=$this->idUsuario";
    $res = $this->exec($query);
    return $res;
  }
  function selectUser()
  {
    $query = "SELECT * FROM $this->table_name WHERE IdUsuario=$this->idUsuario";
    $res = $this->exec($query);
    if (mysqli_num_rows($res) != 0) {
      $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
      return $row;
    }
    return null;
  }
}
