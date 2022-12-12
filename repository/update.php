<?php
require_once '../connection/db.php';


echo '<pre>';
var_dump($_POST);
echo '</pre>';

$id = $_POST['id'];
$img = $_POST['image'];
$price = $_POST['price'];
$name = $_POST['name'];
$size = $_POST['size'];
$top = $_POST['material-top'];
$buttom = $_POST['material-buttom'];
$stock = $_POST['stock'];
$category = $_POST['category'];
$discount = $_POST['discount'];
$popularity = $_POST['popularity'];
$url = $_POST['url'];


if(isset($_FILES)){
  $image = $_FILES['img'];
  var_dump($image = $_FILES['img']);
  if(move_uploaded_file($image['tmp_name'], '../storage/'.$image['name'])) {
    $path = 'storage/'.$image['name'];
  } else {
    $path = $img;
  }
};

mysqli_query($connection, "UPDATE `items` SET `img` = '$path', `price` = '$price', `name` = '$name', `category` = '$category', `size` = '$size', `material-top` = '$top', `material-buttom` = '$buttom', `stock` = '$stock ', ` discount` = '$discount', `popularity` = '$popularity' WHERE `items`.`id` = '$id'");

header('location: '.$url);
