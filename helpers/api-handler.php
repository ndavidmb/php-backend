<?php
function request() {
  return (array) json_decode(file_get_contents('php://input'), TRUE);
}

function response($arr, $code) {
  $http=[
    404 => '404 Not Found', 
    400 => '400 Bad Request', 
    500 => '500 Internal Server Error', 
    201 => '201 Created', 
    200 => '200 Ok',
    202 => '202 Accept'
  ];
  header("HTTP/1.1 ".$http[$code]);
  echo json_encode($arr);
}

?>
