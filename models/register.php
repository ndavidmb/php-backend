<?php
include_once("./models/generic-model.php");

class Register extends GenericModel
{

  public function __construct(
    ?int $idRegister = null,
    ?int $idPatient = null,
    ?int $idBed =null,
    ?string $dateEntry =null,
    ?string $dateExit =null,
    ?int $costRegister =null
  ) {
    parent::__construct("registro");
    $this->idRegister = $idRegister;
    $this->idPatient = $idPatient;
    $this->idBed = $idBed;
    $this->dateEntry = $dateEntry;
    $this->dateExit = $dateExit;
    $this->costRegister = $costRegister;
  }

  function createRegister()
  {
    $query = "INSERT INTO registro( IdPaciente, IdCama, FechaIngreso, FechaSalida, Costo)
      SELECT $this->idPatient,$this->idBed, '$this->dateEntry','$this->dateExit', RES.total
      FROM(
        SELECT SUM(C.costo + T.costo) AS total 
        FROM (SELECT costo FROM cama WHERE IdCama=$this->idBed) as C 
          INNER JOIN (SELECT costo FROM tratamiento WHERE IdTratamiento=) as T
    ) AS RES;";
    $res = $this->exec($query);
    return $res;
  }

  function updateRegister()
  {
    $query = "UPDATE `$this->table_name`
      SET `IdPaciente` = $this->idPatient,
      `IdCama` = $this->idBed,
      `FechaIngreso` = '$this->dateEntry',
      `FechaSalida` = '$this->dateExit',
      `Costo` = $this->costRegister
      WHERE IdRegistro=$this->idRegister";
    $res = $this->exec($query);
    return $res;
  }

  function deleteRegister()
  {
    $query = "DELETE FROM $this->table_name WHERE IdRegistro=$this->idRegister";
    $res = $this->exec($query);
    return $res;
  }

  function readAllRegister()
  {
    $query = "SELECT 
r.IdCama, r.FechaIngreso, r.FechaSalida ,r.costo ,
    p.NomPaciente, p.ApellPaciente, 
    t.Nombre as NombreTratamiento, t.Costo as CostoTratamiento,
    d.NomDoctor, d.ApellDoctor
    FROM $this->table_name r
    INNER JOIN paciente p
    INNER JOIN tratamientoregistro tg
    INNER JOIN tratamiento t
    INNER JOIN tratamientodoctor td
    INNER JOIN doctor d
    ON r.IdPaciente = p.IdPaciente
    AND r.IdRegistro = tg.IdRegistro
    AND tg.IdTratamiento = t.IdTratamiento
    AND t.IdTratamiento = td.IdTratamiento
    AND td.IdDoctor = d.IdDoctor;";
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
    $query = "SELECT * FROM $this->table_name WHERE IdRegistro=$this->idRegister";
    $res = $this->exec($query);
    if (mysqli_num_rows($res) != 0) {
      $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
      return $row;
    }
    return null;
  }
}