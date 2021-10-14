<?php
include_once("./models/generic-model.php");

class DocTrea extends GenericModel
{

  public function __construct(
    ?int $idTreatment = null,
    ?int $idDoctor = null,
  ) {
    parent::__construct("tratamientodoctor");
    $this->idTreatment = $idTreatment;
    $this->idDoctor = $idDoctor;
  }

  function createDocTrea()
  {
    $query = "INSERT INTO $this->table_name(IdTratamiento,IdDoctor)
      VALUES ('$this->idTreatment','$this->idDoctor')";
    $res = $this->exec($query);
    return $res;
  }

  function updateDocTrea()
  {
    $query = "UPDATE `$this->table_name`
      SET `IdTratamiento` = $this->idTreatment,
      `IdDoctor` = $this->idDoctor
      WHERE IdTratamiento=$this->idTreatment OR IdDoctor=$this->idDoctor";
    $res = $this->exec($query);
    return $res;
  }

  function deleteDocTrea()
  {
    $query = "DELETE FROM $this->table_name WHERE IdTratamiento=$this->idTreatment OR IdDoctor=$this->idDoctor";
    $res = $this->exec($query);
    return $res;
  }

  function readAllDocTrea()
  {
    $query = "SELECT d.NomDoctor, d.ApellDoctor, t.Nombre as NombreTratamiento, t.Costo
    FROM $this->table_name dt
    INNER JOIN doctor d
    INNER JOIN tratamiento t
    ON dt.IdDoctor = d.IdDoctor 
    AND dt.IdTratamiento = t.IdTratamiento;";
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
    $query = "SELECT * FROM $this->table_name WHERE IdTratamiento=$this->idTreatment AND IdDoctor=$this->idDoctor";
    $res = $this->exec($query);
    if (mysqli_num_rows($res) != 0) {
      $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
      return $row;
    }
    return null;
  }
}