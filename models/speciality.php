<?php
include_once("./models/generic-model.php");

class Speciality extends GenericModel {
  public function __construct(
    ?int $idEspecialidad=null,
    ?string $nomEspecialidad= null,
  ) {
    parent::__construct("especialidad");
    $this->idEspecialidad = $idEspecialidad;
    $this->nomEspecialidad = $nomEspecialidad;
  }

  function createSpeciality() {
    $query = "INSERT INTO $this->table_name(Nombre)
      VALUES ('$this->nomEspecialidad')";
    $res = $this->exec($query);
    return $res;
  }

  function updateSpeciality() {
    $query = "UPDATE $this->table_name
      SET Nombre = '$this->nomEspecialidad'
      WHERE IdEspecialidad=$this->idEspecialidad";
    $res = $this->exec($query);
    return $res;
  }

  function deleteSpeciality() {
    $query = "DELETE FROM $this->table_name WHERE IdEspecialidad=$this->idEspecialidad";
    $res = $this->exec($query);
    return $res;
  }

  function readAllSpeciality() {
    $query = "SELECT * FROM $this->table_name";
    $res = $this->exec($query);
    if(mysqli_num_rows($res) != 0) {
      //$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
      while($row = $res->fetch_array())
        {
            $rows[] = $row;
        }
      return $rows;
    }
   
    return "No se encontro ningún regitro";
  }

  function selectSpeciality(){
    $query = "SELECT * FROM $this->table_name WHERE IdEspecialidad=$this->idEspecialidad";
    $res = $this->exec($query);
    if(mysqli_num_rows($res) != 0) {
      $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
      return $row;
    }
    return null;
  }
}
?>
