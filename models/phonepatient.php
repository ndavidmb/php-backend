<?php
include_once("./models/generic-model.php");

class PhonePatient extends GenericModel
{
  public function __construct(
    ?int $idPatient = null,
    ?string $telPatient = null
  ) {
    parent::__construct("telefonopaciente");
    $this->idPatient = $idPatient;
    $this->telPatient = $telPatient;
  }

  function createPhonePatient()
  {
    $query = "INSERT INTO $this->table_name(IdPaciente, Telefono)
      VALUES ($this->idPatient, '$this->telPatient')";
    $res = $this->exec($query);
    return $res;
  }

  function updatePhonePatient()
  {
    $query = "UPDATE `$this->table_name`
      SET `Telefono` = $this->telPatient
      WHERE IdPaciente=$this->idPatient";
    $res = $this->exec($query);
    return $res;
  }

  function deletePhonePatient()
  {
    $query = "DELETE FROM $this->table_name WHERE IdPaciente=$this->idPatient AND 'Telefono'=$this->telPatient";
    $res = $this->exec($query);
    return $res;
  }

  function readAllPhonePatient()
  {
    $query = "SELECT p.IdPaciente, d.NomPaciente, d.ApellPaciente, p.Telefono as TelefonoPaciente
              FROM $this->table_name p
              INNER JOIN paciente d
              ON p.IdPaciente = d.IdPaciente;";
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
    $query = "SELECT * FROM $this->table_name WHERE IdPaciente=$this->idPatient AND Telefono=$this->telPatient";
    $res = $this->exec($query);
    if (mysqli_num_rows($res) != 0) {
      $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
      return $row;
    }
    return null;
  }
}