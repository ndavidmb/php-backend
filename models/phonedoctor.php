<?php
include_once("./models/generic-model.php");

class PhoneDoctor extends GenericModel
{
  public function __construct(
    ?int $idDoctor = null,
    ?string $telDoctor = null
  ) {
    parent::__construct("telefonodoctor");
    $this->idDoctor = $idDoctor;
    $this->telDoctor = $telDoctor;
  }

  function createPhoneDoctor()
  {
    $query = "INSERT INTO $this->table_name(IdDoctor, Telefono)
      VALUES ($this->idDoctor, '$this->telDoctor')";
    $res = $this->exec($query);
    return $res;
  }

  function updatePhoneDoctor()
  {
    $query = "UPDATE `$this->table_name`
      SET `Telefono` = $this->telDoctor
      WHERE IdDoctor=$this->idDoctor";
    $res = $this->exec($query);
    return $res;
  }

  function deletePhoneDoctor()
  {
    $query = "DELETE FROM $this->table_name WHERE IdDoctor=$this->idDoctor AND 'Telefono'=$this->telDoctor";
    $res = $this->exec($query);
    return $res;
  }

  function readAllPhoneDoctors()
  {
    $query = "SELECT p.IdDoctor, d.NomDoctor, d.ApellDoctor, p.Telefono as TelefonoDoctor
              FROM $this->table_name p
              INNER JOIN doctor d
              ON p.IdDoctor = d.IdDoctor;";
    $res = $this->exec($query);
    if (mysqli_num_rows($res) != 0) {
      while ($row = $res->fetch_array()) {
        $rows[] = $row;
      }
      return $rows;
    }
    return "No se encontro ningún regitro";
  }

  function selectOne()
  {
    $query = "SELECT * FROM $this->table_name WHERE IdDoctor=$this->idDoctor OR Telefono=$this->telDoctor";
    $res = $this->exec($query);
    if (mysqli_num_rows($res) != 0) {
      $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
      return $row;
    }
    return null;
  }
}