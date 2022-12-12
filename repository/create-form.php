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


  $url = $_GET['url'];
  $data = $_SESSION['data'];

  if(isset($data)) {
    $url = 'http://localhost:8888/admin-slippers/?'.$data;
  } else {
    $url = $_GET['url'];
  }
?>
  <div class="wrapper-add">

    <form action="create.php" class="form-control mt-5 d-flex flex-column p-5" method="post" style="width:60%; margin: auto;" enctype="multipart/form-data">

      <label class="form-label d-flex justify-content-center py-2 btn btn-outline-secondary" style="width:100%;">
          <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
          </svg>
          <input type="file" name="img"  class="form-control" style="width:100%; display:none;">
      </label>

      <label class="form-label d-flex justify-content-center py-2" style="width:100%;">
          <input type="text" name="name" placeholder="Название"  class="form-control" style="width:100%;">
      </label>
      <label class="form-label d-flex justify-content-center py-2" style="width:100%;">
          <input type="text" name="price" placeholder="Цена"  class="form-control" style="width:100%;">
      </label>

      <label class="form-label d-flex justify-content-center py-2" style="width:100%;">
          <input type="text" name="size" placeholder="Размер"  class="form-control" style="width:100%;">
      </label>

      <label class="form-label d-flex justify-content-center py-2" style="width:100%;">
          <input type="text" name="material-top" placeholder="Материал верха"  class="form-control" style="width:100%;">
      </label>

      <label class="form-label d-flex justify-content-center py-2" style="width:100%;">
          <input type="text" name="material-buttom" placeholder="Материал подкладки"  class="form-control" style="width:100%;">
      </label>

      <label class="form-label d-flex justify-content-center py-2" style="width:100%;">
          <input type="text" name="stock" placeholder="В наличии"  class="form-control" style="width:100%;">
      </label>

      <select name="category" id="" class="form-select mt-2">
        <option selected disabled>Не выбрано</option>
        <option value="мужские">Мужские</option>
        <option value="женские">Женские</option>
        <option value="детские">Детские</option>
      </select>

      <select name="discount" id="" class="form-select my-3">
        <option selected value="0">Не выбрано</option>
        <option value="20">20%</option>
        <option value="30">30%</option>
        <option value="50">50%</option>
      </select>

      <input type="hidden" name="url" value="<?=$url?>">
      <button type="submit" class="btn btn-outline-success" >Создать</button>
    </form>
  </div>

</body>
</html>