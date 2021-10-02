<?php
include_once('./models/speciality.php');
include_once('./controllers/base-controller.php');

class SpecialityController extends BaseController{
  public function __construct($method, $param) {
    parent::__construct($method, $param);
  }

  public function init() {
    switch ($this->method) {
      case 'POST':
        $this->createSpeciality();
        break;
      case 'GET':
        $this->getSpeciality();
        break;
      case 'PUT':
        $this->changeSpeciality();
        break;
      case 'DELETE':
        $this->dropSpeciality();
        break; 
    }
  }

  function createSpeciality() {
    [
      'nomEspecialidad' => $nombre 
    ] = request();

    $speciality = new Speciality(nomEspecialidad : $nombre);
    $result = $speciality->createSpeciality();
    if($result==1){
      response(['status' => 'La Especialidad Se Ha Creado','error' => False],200);
    }else{
      response(['status' => 'Error Al Crear','error' => true], 400);
    }
    exit();
  }

  function getSpeciality() {
    $speciality = new Speciality();
    $result = $speciality->readAllSpeciality();
    if(gettype($result)=='string'){
        response(['status'=> $result],200);
        exit();
    }
    for($i=0;$i<count($result);$i++){
        $ps[$i] = ['name'=>$result[$i]['Nombre'],'id'=>$result[$i]['IdEspecialidad']]; 
    }
    response(['data' => $ps,'status' => 'OK'],200);
  }

  function changeSpeciality() {
    $p= $this->param; 
    ['nomSpeciality'=> $nombre]=request();
    $speciality = new Speciality(idEspecialidad:$p, nomEspecialidad:$nombre);
    $resC = $speciality->selectSpeciality();
    if(!isset($resC)){
      response(['status' => 'Especialidad no existe','error' => True],400);
      exit();
    }
    $res = $speciality->updateSpeciality();
    if($res==1){
      response(['status' => 'La Especialidad Se Ha Actualizado','error' => False],200);
    }else{
      response(['status' => 'Error En Actualizacion','error' => true], 400);
    }
  }
  
  function dropSpeciality() {
    $p= $this->param;
    $speciality = new Speciality(idEspecialidad:$p);
    $resC = $speciality->selectSpeciality();
    if(!isset($resC)){
      response(['status' => 'Especialidad no existe','error' => True],400);
      exit();
    }
    $res = $speciality->deleteSpeciality();
    if($res==1){
      response(['status' => 'La Especialidad Se Ha Eliminado','error' => False],200);
    }else{
      response(['status' => 'Error En Eliminar','error' => true], 400);
    }
  }

}

?>
