<?php
// header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
// header("Access-Control-Allow-Methods: OPTIONS, PATCH,GET,POST,PUT,DELETE");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST, PUT, DELETE");
header("Allow: OPTIONS, GET, POST, PUT, DELETE");
