<?php
include("./database/connection.php");

class GenericModel {
  protected $table_name = "";

  public function __construct($table_name) {
    $this->link = conectar();
    $this->table_name = $table_name;
  }

  public function exec($query) {
    $res = mysqli_query($this->link, $query);
    if(!$res) {
      header('HTTP/1.1 400 Bad Request');
      echo json_encode(['error' => mysqli_error($this->link), 'status' => 'Error in database']);
      exit();
    }
    return $res;
  }


}
?>
