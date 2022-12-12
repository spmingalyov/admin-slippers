<?php
$select = 'select='.$_POST['select'];
$url = $_POST['url'];


$position = strpos($url, '?');
if($position > 1) {
  $param = '&';
} else {
  $param = '?';
}

function check_url($string) {
  global $select;
  global $url;
  global $param;
  $res1 = strpos($url, $string);
  if($res1 > 1) {
    $res1 = str_replace($string, $select, $url);
    return $res1;
  }
}
if  (str_contains($url, 'select=man') || str_contains($url, 'select=wom') || str_contains($url, 'select=kid') || str_contains($url, 'select=all') ) {
  $url = check_url('select=man').check_url('select=all').check_url('select=wom').check_url('select=kid');
} else {
  $url .= $param.$select;
}


header('location: '.$url);