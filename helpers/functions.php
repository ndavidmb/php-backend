<?php


function mapped(array $arr) {

  $nArr = [];
  foreach($arr as $value) {
    $item = [];
    foreach($value as $field => $name) {
      if(gettype($field) == "string") {
        $item += [lcfirst($field) => $name];
      }
    }
    array_push($nArr,(object) $item);
  }


  return $nArr;
} 


?>
