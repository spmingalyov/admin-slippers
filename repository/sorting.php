<?php
$sort = 'sort='.$_POST['sort'];
$url = $_POST['url'];


$position = strpos($url, '?');
if($position > 1) {
  $param = '&';
} else {
  $param = '?';
}

function check_url($string) {
  global $sort;
  global $url;
  global $param;
  $res1 = strpos($url, $string);
  if($res1 > 1) {
    $res1 = str_replace($string, $sort, $url);
    return $res1;
  }
}
if  (str_contains($url, 'sort=pop') || str_contains($url, 'sort=chp') || str_contains($url, 'sort=rch') || str_contains($url, 'sort=sal') ) {
  $url = check_url('sort=pop').check_url('sort=chp').check_url('sort=rch').check_url('sort=sal');
} else {
  $url .= $param.$sort;
}


header('location: '.$url);