<?php
class BaseController {
  
  public function __construct($method, $param, ?array $requiereParam = null) {
    $this->method = $method;
    $this->param = $param;
    $this->arrReq = $requiereParam;
    $this->requiereParam();
  }

  private function requiereParam() {
    if(isset($this->arrReq)){
    if(!in_array($this->method, $this->arrReq)) {
      return;
    }

    if(!isset($this->param)) {
      response([
        'error' => True,
        'status' => 'El parametro es requerido para el método '.$this->method
      ], 400);
      exit();
    }
  }
}
}
?>
