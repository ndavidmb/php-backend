<?php
include('./controllers/patient-controller.php');
include('./controllers/user-controller.php');

$routes = [
  "patient",
  "user",
];
 

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
[1 => $controller, 2 => $val] = explode('/', $uri);
$requestMethod = $_SERVER["REQUEST_METHOD"]; //Get, Post, Put, Delete

switch ($controller) {
  case 'patient':
    $patient_controller = new PatientController($requestMethod);
    break;
  case 'user':
    $user_controller = new UserController($requestMethod);
    break;
  default:
    response(['error' => 'Method not found'], 404);
    break;
}
?>
