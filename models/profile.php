<?php
include_once("./models/generic-model.php");

class Profile extends GenericModel
{

  public function __construct(
    ?int $idProfile = null,
    ?string $nomProfile = null
  ) {
    parent::__construct("perfil");
    $this->idProfile = $idProfile;
    $this->nomProfile = $nomProfile;
  }

  function createProfile()
  {
    $query = "INSERT INTO $this->table_name(Nombre)
      VALUES ('$this->nomProfile')";
    $res = $this->exec($query);
    return $res;
  }

  function updateProfile()
  {
    $query = "UPDATE `$this->table_name`
      SET `Nombre` = '$this->nomProfile'
      WHERE IdPerfil=$this->idProfile";
    $res = $this->exec($query);
    return $res;
  }

  function deleteProfile()
  {
    $query = "DELETE FROM $this->table_name WHERE IdPerfil=$this->idProfile";
    $res = $this->exec($query);
    return $res;
  }

  function readAllProfile()
  {
    $query = "SELECT p.IdPerfil, p.Nombre, u.NomUsuario, u.Correo
    FROM $this->table_name p
    INNER JOIN usuario u
    ON p.IdPerfil = u.IdPerfil;";
    $res = $this->exec($query);
    if (mysqli_num_rows($res) != 0) {
      while ($row = $res->fetch_array()) {
        $rows[] = $row;
      }
      return $rows;
    }
    return "No se encontro ningún registro";
  }

  function selectOne()
  {
    $query = "SELECT * FROM $this->table_name WHERE IdPerfil=$this->idProfile";
    $res = $this->exec($query);
    if (mysqli_num_rows($res) != 0) {
      $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
      return $row;
    }
    return null;
  }
}