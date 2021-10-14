<?php
include_once("./models/generic-model.php");

class bed extends GenericModel
{
  public function __construct(
    ?int $idBed = null,
    ?bool $availability = null,
    ?int $cost = null
  ) {
    parent::__construct("cama");
    $this->idBed = $idBed;
    $this->availability = $availability;
    $this->cost = $cost;
  }

  function createBed()
  {
    $query = "INSERT INTO $this->table_name(Disponibilidad, Costo)
      VALUES ($this->availability, '$this->cost')";
    $res = $this->exec($query);
    return $res;
  }

  function updateBed()
  {
    $query = "UPDATE `$this->table_name`
      SET `Disponibilidad` = $this->availability,
          `Costo` = $this->cost
      WHERE IdCama=$this->idBed";
    $res = $this->exec($query);
    return $res;
  }

  function deleteBed()
  {
    $query = "DELETE FROM $this->table_name WHERE IdCama=$this->idBed";
    $res = $this->exec($query);
    return $res;
  }

  function readAllBeds()
  {
    $query = "SELECT DISTINCT c.IdCama  as Cama, c.Disponibilidad, r.FechaIngreso, r.FechaSalida, p.NomPaciente, p.ApellPaciente
              FROM $this->table_name c
              INNER JOIN registro r
              INNER JOIN paciente p
              ON c.IdCama = r.IdCama
              AND r.IdPaciente = p.IdPaciente;";
    $res = $this->exec($query);
    if (mysqli_num_rows($res) != 0) {
      while ($row = $res->fetch_array()) {
        $rows[] = $row;
      }
      return $rows;
    }
    return "No se encontro ningúna cama";
  }

  function selectOne()
  {
    $query = "SELECT * FROM $this->table_name WHERE IdCama=$this->idBed";
    $res = $this->exec($query);
    if (mysqli_num_rows($res) != 0) {
      $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
      return $row;
    }
    return null;
  }
}