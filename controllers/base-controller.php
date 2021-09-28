<?php
//require_once('./models/user.php');
class BaseController {
  
  //public function __construct(string $method, string $param, array $protected_routes = []) {
  public function __construct($method, $param) {
    $this->method = $method;
    $this->param = $param;
    //$this->protected_routes = $protected_routes;
    //if(in_array($method, $protected_routes)) {
      //$this->validateToken();
    //}
  }

  //private function validateToken() {
    //['token' => $token] = request();
    //$arr = explode('=', $token);
    //print_r($arr);
    //$user = new User();
  //}
}
?>
