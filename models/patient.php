<?php
include_once("./models/generic-model.php");

class Patient extends GenericModel
{

  public function __construct(
    ?int $idPaciente = null,
    ?string $nomPaciente = null,
    ?string $apellPaciente = null,
    ?int $idSeguro = null
  ) {
    parent::__construct("paciente");
    $this->idPaciente = $idPaciente;
    $this->nomPaciente = $nomPaciente;
    $this->apellPaciente = $apellPaciente;
    $this->idSeguro = $idSeguro;
  }

  function createPatient()
  {
    $query = "INSERT INTO $this->table_name(NomPaciente, ApellPaciente, IdSeguro)
      VALUES ('$this->nomPaciente', '$this->apellPaciente', $this->idSeguro)";
    $res = $this->exec($query);
    return $res;
  }

  function updatePatient()
  {
    $query = "UPDATE `$this->table_name`
      SET `NomPaciente` = '$this->nomPaciente',
          `ApellPaciente` = '$this->apellPaciente',
          `IdSeguro` = $this->idSeguro
      WHERE IdPaciente=$this->idPaciente";
    $res = $this->exec($query);
    return $res;
  }

  function deletePatient()
  {
    $query = "DELETE FROM $this->table_name WHERE IdPaciente=$this->idPaciente";
    $res = $this->exec($query);
    return $res;
  }

  function readAllPatients()
  {
    $query = "SELECT * FROM $this->table_name";
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
    $query = "SELECT * FROM $this->table_name WHERE IdPaciente=$this->idPaciente";
    $res = $this->exec($query);
    if (mysqli_num_rows($res) != 0) {
      $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
      return $row;
    }
    return null;
  }
}
