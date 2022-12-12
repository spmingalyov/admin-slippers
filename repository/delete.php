<?php
session_start();
require_once '../connection/db.php';

$id = $_GET['id'];

$data = $_SESSION['data'];

if(isset($data)) {
  $url = 'http://localhost:8888/admin-slippers/?'.$data;
} else {
  $url = $_GET['url'];
};

mysqli_query($connection, "DELETE FROM `items` WHERE `items`.`id` = '$id'");

header('location: '.$url);