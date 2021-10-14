<?php
include_once("./models/generic-model.php");

class Treatment extends GenericModel
{

  public function __construct(
    ?int $idTreatment = null,
    ?string $nomTreatment = null,
    ?int $cosTreatment =null
  ) {
    parent::__construct("tratamiento");
    $this->idTreatment = $idTreatment;
    $this->nomTreatment = $nomTreatment;
    $this->cosTreatment = $cosTreatment;
  }

  function createTraetment()
  {
    $query = "INSERT INTO $this->table_name(Nombre,Costo)
      VALUES ('$this->nomTreatment','$this->cosTreatment')";
    $res = $this->exec($query);
    return $res;
  }

  function updateTraetment()
  {
    $query = "UPDATE `$this->table_name`
      SET `Nombre` = '$this->nomTreatment',
      `Costo` = $this->cosTreatment
      WHERE IdTratamiento=$this->idTreatment";
    $res = $this->exec($query);
    return $res;
  }

  function deleteTraetment()
  {
    $query = "DELETE FROM $this->table_name WHERE IdTratamiento=$this->idTreatment";
    $res = $this->exec($query);
    return $res;
  }

  function readAllTraetment()
  {
    $query = "SELECT *
    FROM $this->table_name;";
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
    $query = "SELECT * FROM $this->table_name WHERE IdTratamiento='$this->idTreatment'";
    $res = $this->exec($query);
    if (mysqli_num_rows($res) != 0) {
      $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
      return $row;
    }
    return null;
  }
}