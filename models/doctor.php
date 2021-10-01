<?php
include_once("./models/generic-model.php");

class Doctor extends GenericModel {
  public function __construct(
    int $idDoctor,
    string $nomDoctor,
    string $apellDoctor,
    int $idEspecialidad
  ) {
    parent::__construct("doctor");
    $this->idDoctor = $idDoctor;
    $this->nomDoctor = $nomDoctor;
    $this->apellDoctor = $apellDoctor;
    $this->idEspecialidad = $idEspecialidad;
  }

  function createDoctor() {
    $query = "INSERT INTO $this->table(NomDoctor, ApellDoctor, IdEspecial)
      VALUES ('$this->nomDoctor', '$this->apellDoctor', $this->idEspecialidad)";
    $res = $this->exec($query);
    return $res;
  }

  function updateDoctor() {
    $query = "UPDATE $this->table_name(NomDoctor, ApellDoctor, IdEspecialidad)
      SET NomDoctor = '$this->nomDoctor',
          ApellDoctor = '$this->apellDoctor',
          IdEspecialidad = $this->idEspecialidad
      WHERE IdDoctor=$this->idDoctor";
    $res = $this->exec($query);
    return $res;
  }

  function deleteDoctor() {
    $query = "DELETE FROM $this->table_name WHERE IdDoctor=$this->idDoctor";
    $res = $this->exec($query);
    return $res;
  }

  function readAllDoctors() {
    $query = "SELECT * FROM $this->table_name";
    $res = $this->exec($query);
    if(mysqli_num_rows($res) != 0) {
      $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
      return $row;
    }
    return "No se encontro ningún regitro";
  }
}
?>
