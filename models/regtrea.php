<?php
include_once("./models/generic-model.php");

class RegTrea extends GenericModel
{

  public function __construct(
    ?int $idTreatment = null,
    ?int $idRegister = null,
  ) {
    parent::__construct("tratamientodoctor");
    $this->idTreatment = $idTreatment;
    $this->idRegister = $idRegister;
  }

  function createRegTrea()
  {
    $query = "INSERT INTO $this->table_name(IdTratamiento,IdRegistro)
      VALUES ('$this->idTreatment','$this->idRegister')";
    $res = $this->exec($query);
    return $res;
  }

  function updateRegTrea()
  {
    $query = "UPDATE `$this->table_name`
      SET `IdTratamiento` = '$this->idTreatment',
      `IdRegistro` = `$this->idRegister`
      WHERE  IdTratamiento=$this->idTreatment OR IdRegistro=$this->idRegister";
    $res = $this->exec($query);
    return $res;
  }

  function deleteRegTrea()
  {
    $query = "DELETE FROM $this->table_name WHERE IdTratamiento=$this->idTreatment OR IdRegistro=$this->idRegister";
    $res = $this->exec($query);
    return $res;
  }

  function readAllRegTrea()
  {
    $query = "SELECT r.IdCama, r.FechaIngreso, r.FechaSalida,t.Nombre as NombreTratamiento, t.Costo as CostoTratamiento
    FROM $this->table_name rt
    INNER JOIN registro r
    INNER JOIN tratamiento t
    ON rt.IdRegistro = r.IdRegistro 
    AND rt.IdTratamiento = t.IdTratamiento;";
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
    $query = "SELECT * FROM $this->table_name WHERE IdTratamiento=$this->idTreatment AND IdRegistro=$this->idRegister";
    $res = $this->exec($query);
    if (mysqli_num_rows($res) != 0) {
      $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
      return $row;
    }
    return null;
  }
}