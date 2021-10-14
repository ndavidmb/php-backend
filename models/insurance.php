<?php
include_once("./models/generic-model.php");

class Insurance extends GenericModel
{

  public function __construct(
    ?int $idInsurance = null,
    ?string $nomInsurance = null
  ) {
    parent::__construct("seguro");
    $this->idInsurance = $idInsurance;
    $this->nomInsurance = $nomInsurance;
  }

  function createInsurance()
  {
    $query = "INSERT INTO $this->table_name(Nombre)
      VALUES ('$this->nomInsurance')";
    $res = $this->exec($query);
    return $res;
  }

  function updateInsurance()
  {
    $query = "UPDATE `$this->table_name`
      SET `Nombre` = '$this->nomInsurance'
      WHERE IdSeguro=$this->idInsurance";
    $res = $this->exec($query);
    return $res;
  }

  function deleteInsurance()
  {
    $query = "DELETE FROM $this->table_name WHERE IdSeguro=$this->idInsurance";
    $res = $this->exec($query);
    return $res;
  }

  function readAllInsurance()
  {
    $query = "SELECT i.IdSeguro, i.Nombre, p.NomPaciente, p.ApellPaciente
    FROM $this->table_name i
    INNER JOIN paciente p
    ON i.IdSeguro = p.IdSeguro;";
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
    $query = "SELECT * FROM $this->table_name WHERE IdSeguro=$this->idInsurance";
    $res = $this->exec($query);
    if (mysqli_num_rows($res) != 0) {
      $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
      return $row;
    }
    return null;
  }
}
