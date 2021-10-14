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
  }

  if($requestMethod == 'OPTIONS') {
    response(["Status" => "Ok"], 200);
    exit();
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
    case 'specialty':
      $speciality_controller = new SpecialityController($requestMethod, $param);
      $speciality_controller->init();
      break;
    case 'treatment':
      $treatment_controller = new TreatmentController($requestMethod, $param);
      $treatment_controller->init();
      break;
    case 'insurance':
      $insurance_controller = new InsuranceController($requestMethod, $param);
      $insurance_controller->init();
      break;
    case 'bed':
      $bed_controller = new BedController($requestMethod, $param);
      $bed_controller->init();
        break;
    case 'profile':
      $profile_controller = new ProfileController($requestMethod, $param);
      $profile_controller->init();
        break;
    case 'phonedoctor':
        $phonedoctor_controller = new PhoneDoctorController($requestMethod, $param);
        $phonedoctor_controller->init();
          break;
    default:
      response(['error' => 'Method not found'], 404);
      break;
    
  }
}
