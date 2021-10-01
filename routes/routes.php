<?php
include('./controllers/patient-controller.php');
include('./controllers/user-controller.php');

function main() {
  $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $arr = explode('/', $uri);
  $requestMethod = $_SERVER["REQUEST_METHOD"]; //Get, Post, Put, Delete

  switch ($arr[1]) {
    case 'patient':
      $patient_controller = new PatientController($requestMethod, $arr[2]);
      $patient_controller->init();
      break;
    case 'user':
      $user_controller = new UserController($requestMethod, $arr[2]);
      $user_controller->init();
      break;
    case 'doctor':
      //$doctor = new Doctor();
      break;
    default:
      response(['error' => 'Method not found'], 404);
      break;
  }
}

?>
