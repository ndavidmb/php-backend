<?php
include('./controllers/paciente-controller.php');
include('./database/connection.php');
include('./helpers/http-headers.php');

$link = conectar();

$routes = array(
  "paciente",
  "doctor"
);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);
$requestMethod = $_SERVER["REQUEST_METHOD"]; //Get, Post, Put, Delete

switch ($uri[1]) {
  case 'paciente':
    $patient_controller = new PacienteController($link, $requestMethod);
    break;
  default:
	  header("HTTP/1.1 404 Not Found");
    break;
}
?>