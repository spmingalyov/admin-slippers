<?php
var_dump($_POST);


$max = $_POST['max'];

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

if(isset($query['max'])) {
  $url = str_replace($query['max'], $max, $url);
} else {
  $url.= $param.'max='.$max;
};


header('location: '.$url);