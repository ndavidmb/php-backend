<?php
foreach (glob("./controllers/*.php") as $filename)
{
    include $filename;
}

function main() {
  $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $arr = explode('/', $uri);
  $requestMethod = $_SERVER["REQUEST_METHOD"]; //Get, Post, Put, Delete
  $param=null;
  if(count($arr)>2){
    $param = $arr[2];
    echo $param;
  }
  switch ($arr[1]) {
    case 'patient':
      $patient_controller = new PatientController($requestMethod, $param);
      $patient_controller->init();
      break;
    case 'user':
      $user_controller = new UserController($requestMethod, $param);
      $user_controller->init();
      break;
    case 'doctor':
      $doctor = new DoctorController($requestMethod, $arr[2]);
      $doctor->init();
      break;
    case 'speciality':
      $speciality_controller = new SpecialityController($requestMethod, $param);
      $speciality_controller->init();
      break;
    default:
      response(['error' => 'Method not found'], 404);
      break;
  }
}

?>
