<?php
var_dump($_POST);

$min = $_POST['min'];


// $select = 'select='.$_POST['select'];
$url = $_POST['url'];


$position = strpos($url, '?');
if($position > 1) {
  $param = '&';
} else {
  $param = '?';
}
$parts = parse_url($url);
parse_str($parts['query'], $query);

// Все GET-параметры
print_r($query);
echo $query['sort'];

if(isset($query['min'])) {
  $url = str_replace($query['min'], $min, $url);
} else {
  $url.= $param.'min='.$min;
};



header('location: '.$url);