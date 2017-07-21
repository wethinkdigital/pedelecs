<?php

function lossless_array_merge() {
  $arrays = func_get_args();
  $data = array();
  foreach ($arrays as $a) {
    foreach ($a as $k => $v) {
      $data[$k][] = $v;
    }
  }
  return $data;
}

?>