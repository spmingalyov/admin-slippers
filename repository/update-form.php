<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link href="../css/style.css" rel="stylesheet">
  <title>Document</title>
</head>
<body>
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


  $item = mysqli_query($connection, "SELECT * FROM `items` WHERE `id` = '$id'");
  $item = mysqli_fetch_assoc($item);



  function get_selected($string){
    global $item;
    if($item['category'] == $string){
      echo 'selected';
    }
  }

  // echo '<pre>';
  // var_dump($item);
  // echo '</pre>';

?>

<div class="wrapper-add">

    <form action="update.php" class="form-control mt-5 d-flex flex-column p-4" method="post" style="width:60%; margin: auto;" enctype="multipart/form-data">

      <label class="form-label d-flex justify-content-center py-2 btn btn-outline-secondary" style="width:100%;">
          <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
          </svg>
          <input type="file" name="img"  class="form-control" style="width:100%; display:none;" accept="image/*" >
      </label>
      <input type="text" name="image" value="<?=$item['img']?>" class="form-control my-2" style="width:100%;">

      <label class="form-label d-flex justify-content-center py-2" style="width:100%;">
          <input type="text" name="name" value="<?=$item['name']?>" placeholder="Название"  class="form-control" style="width:100%;">
      </label>
      <label class="form-label d-flex justify-content-center py-2" style="width:100%;">
          <input type="text" name="price" value="<?=$item['price']?>" placeholder="Цена"  class="form-control" style="width:100%;">
      </label>

      <label class="form-label d-flex justify-content-center py-2" style="width:100%;">
          <input type="text" name="size" value="<?=$item['size']?>" placeholder="Размер"  class="form-control" style="width:100%;">
      </label>

      <label class="form-label d-flex justify-content-center py-2" style="width:100%;">
          <input type="text" name="material-top" value="<?=$item['material-top']?>" placeholder="Материал верха"  class="form-control" style="width:100%;">
      </label>

      <label class="form-label d-flex justify-content-center py-2" style="width:100%;">
          <input type="text" name="material-buttom" value="<?=$item['material-buttom']?>" placeholder="Материал подкладки"  class="form-control" style="width:100%;">
      </label>

      <label class="form-label d-flex justify-content-center py-2" style="width:100%;">
          <input type="text" name="stock" value="<?=$item['stock']?>" placeholder="В наличии"  class="form-control" style="width:100%;">
      </label>

      <select name="category" id="" class="form-select mt-2">
        <option value="мужские" <?php get_selected('мужские')?>>Мужские</option>
        <option value="женские" <?php get_selected('женские')?>>Женские</option>
        <option value="детские"<?php get_selected('детские')?>>Детские</option>
      </select>

      <select name="discount" id="" class="form-select my-3">
        <option selected value="0">Не выбрано</option>
        <option value="20">20%</option>
        <option value="30">30%</option>
        <option value="50">50%</option>
      </select>

      <input type="hidden" name="url" value="<?=$url?>">
      <input type="hidden" name="id" value="<?=$id?>">
      <input type="hidden" name="popularity" value="<?=$item['popularity']?>">
      <button type="submit" class="btn btn-outline-success" >Сохранить</button>
    </form>
  </div>

</body>
</html>