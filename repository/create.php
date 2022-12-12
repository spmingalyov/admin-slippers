<?php
require_once '../connection/db.php';
$image = $_FILES["img"];

if (!is_dir('../storage')) {
  mkdir('../storage', 0777, true);
}

$file_name = time().$image['name'];
move_uploaded_file($image['tmp_name'], '../storage/'.$file_name);




$img = 'storage/'.$file_name;
$price = $_POST['price'];
$name = $_POST['name'];
$size = $_POST['size'];
$top = $_POST['material-top'];
$buttom = $_POST['material-buttom'];
$stock = $_POST['stock'];
$category = $_POST['category'];
$discount = $_POST['discount'];
$popularity = rand(0,100);
$url = $_POST['url'];





mysqli_query($connection,"INSERT INTO `items` (`id`, `img`, `price`, `name`, `category`, `size`, `material-top`, `material-buttom`, `stock`, ` discount`, `popularity`) VALUES (NULL, '$img', '$price', '$name', '$category', '$size', '$top', '$buttom', '$stock', '$discount', '$popularity')");

header('location: '.$url);