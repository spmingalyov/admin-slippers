<?php
session_start();
require_once 'connection/db.php';
  $query = "SELECT * FROM `items`";
  $items = mysqli_query($connection, $query);
  $items = mysqli_fetch_all($items);

  $count = "SELECT COUNT(*) as count FROM  `items`";
  $count = mysqli_query($connection, $count);
  $count = mysqli_fetch_all($count);

  if(isset($_GET['min'])){
    $min = $_GET['min'];
  };
  if(isset($_GET['max'])){
    $max = $_GET['max'];
  };
  if(isset($_GET['sort'])){
    $id = $_GET['sort'];
  };
  if(isset($_GET['select'])){
    $category = $_GET['select'];
  } else $category = NULL;
  $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
  $get_data = $_SERVER['QUERY_STRING'];

  if(!empty($get_data)) {
    $data = $get_data;
  } else {
    $data = NULL;
  }

  $_SESSION['data'] = $data;

  function get_selected($string, $category){
    if($string == $category) {
      echo 'selected';
    } else {
      echo "class='null'";
    }
  }


require_once 'repository/functions.php';

  if(isset($_GET['select'])) {
    if(isset($_GET['sort'])){
      $items = select_category_by_sort($connection, $category, $id);
    } else if(isset($_GET['min']) && isset($_GET['max'])) {
      $items = select_category_by_price($connection, $category, $min, $max);
    } else {
      $items = select_category($connection, $category);
    }
  } else if(isset($_GET['sort'])) {
    if(isset($_GET['min']) && isset($_GET['max'])){
      $items = filter_by_price_and_sorting($connection, $id, $min, $max);
    } else {
      $items = sort_items($connection, $id);
    }
  } else if(isset($_GET['min']) && isset($_GET['max'] )) {
    $items = filter_by_price($connection, $min, $max);
  } else if(isset($_GET['min']) &&
            isset($_GET['max']) &&
            isset($_GET['max']) &&
            isset($_GET['max'])) {

    $items = blender($connection, $category, $id, $min, $max);
  }


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link href="css/style.css" rel="stylesheet">
  <title>Тапочки купить по выгодной цене в магазине HOFF.ru</title>
</head>
<body>
<div class="header">
  <div class="container">
    <a href="http://localhost:8888/admin-slippers/" style="text-decoration: none; color: black;"><h2 class="header__title mt-2">Тапочки <span class="py-1 px-2 rounded-pill align-self-start"  style="background: #d70721;font-size: 12px; color: #fff; "><?=$count[0][0]?> Товаров</span></h2></a>
  </div>
  <hr>
</div>

<div class="wrapper">
  <div class="content d-flex ps-5">
    <!-- filter-product -->
    <div class="content__filter container mt-5 pt-5" style="width:20%; height: 79vh;" >
        <form action="repository/filter-select.php" method="post" id="formSelect">
          <select name="select" class="form-select" aria-label="Default select example" id="select">
            <option selected disabled>Для кого</option>
            <option value="all" <?=get_selected('all',$category)?>>Все</option>
            <option value="man" <?=get_selected('man',$category)?>>Мужские</option>
            <option value="wom" <?=get_selected('wom',$category)?>>Женские</option>
            <option value="kid" <?=get_selected('kid',$category)?>>Детские</option>
          </select>
          <input type="hidden" name="url" value="<?=$url?>">
        </form>
        <div class="d-flex gap-1 justify-content-center mt-4">
           <form action="repository/filter-range.php" id="formRange" method="post">
              <label for="" class="d-flex align-items-center gap-2">
                от
              <input type="hidden" name="url" value="<?=$url?>">
              <input type="text" style="width: 75px;" name="min" class="form-control" value="<?php if(isset($_GET['min'])){echo $_GET['min'];} ?>" placeholder="159" id="min">
              -
              </label>

          </form>

          <form action="repository/filter-range-max.php" id="maxRange" method="post">
              <label for="" class="d-flex align-items-center gap-2 pe-2">
               до
              <input type="hidden" name="url" value="<?=$url?>">
              <input type="text" style="width: 75px;" name="max" class="form-control" value="<?php if(isset($_GET['max'])){echo $_GET['max'];} ?>" placeholder="1999" id="max">
              </label>
          </form>
        </div>

        <form action="repository/switch.php" class="switch" method="post" id="formSwitch">
          <label for="" class="d-flex justify-content-between fw-semibold">
            Только в наличии
            <input id="switch" type="checkbox">
          </label>
        </form>

      </div><!-- filter-product -->




    <div class="content__products container " style="width:80%; height: 85vh;">
       <!-- sorting-product -->
      <div class="sorting d-flex text-black-50 ps-4">
        <form action="repository/sorting.php" method="post">
          <input type="hidden" name="sort" value="pop">
          <input type="hidden" name="url" value="<?=$url?>">
          <button type="submit" class="btn">По популярности</button>
        </form>
        <form action="repository/sorting.php" method="post">
          <input type="hidden" name="sort" value="chp">
          <input type="hidden" name="url" value="<?=$url?>">
          <button type="submit" class="btn">Сначала дешевле</button>
        </form>
        <form action="repository/sorting.php" method="post">
          <input type="hidden" name="sort" value="rch">
          <input type="hidden" name="url" value="<?=$url?>">
          <button type="submit" class="btn">Сначала дороже</button>
        </form>
        <form action="repository/sorting.php" method="post">
          <input type="hidden" name="sort" value="sal">
          <input type="hidden" name="url" value="<?=$url?>">
          <button type="submit" class="btn">По скидке</button>
        </form>
      </div> <!-- sorting-product -->


      <!-- render-product -->
      <div class="content__products-list row ps-5 mt-2">
        <?php foreach($items as $item) { ?>
          <div class="card mt-3 col-3 me-5">
                <a href="repository/update-form.php?id=<?=$item[0]?>&url=<?=$url?>" class="btn btn-outline-success update" id="update">
                 <input type="hidden" value="<?=$item[0]?>">
                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                   </svg>
              </a>
              <a href="repository/delete.php?id=<?=$item[0]?>&url=<?=$url?>" class="btn btn-outline-danger delete">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                </svg>
              </a>
              <img src="<?=$item[1]?>" alt="" class="card-img-top">
              <div class="card-body">
                <h5 class="card-title mb-4"><?php if($item[9]>0){echo "<span class='discount'>-$item[9]%</span>"; $new_price = ($item[2]/100)*(100-$item[9]); echo ' '.ceil($new_price).' ₽'; echo ' '.'<s style="font-size: 14px">'.$item[2].'₽ </s>';}else {
                  echo $item[2];
                }?> </h5>
                <h6 class="card-text mb-4 fw-bold"><?=$item[3]?></h6>

                <div class="flex flex-column">
                  <div class="d-flex justify-content-between">
                    <div class="card-text">Размер:</div>
                    <div class="card-text"><?=$item[5]?></div>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="card-text">Верх:</div>
                    <div class="card-text"><?=$item[6]?></div>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="card-text">Подкладка:</div>
                    <div class="card-text"><?=$item[7]?></div>
                  </div>
                </div>
                <div class="flex text-center pt-4 ">
                  <button class="btn btn-outline-danger d-md-block px-5" style="margin: auto;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="20" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 19">
                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg> В корзину</button>
                </div>
                <div style="font-size: 12px; color: #17ab9d;" class="text-center mt-3">Доступно для доставки <?=$item[8]?> шт</div>
              </div>
            </div>
        <?php } ?>
          <a href="repository/create-form.php?url=<?=$url?>" class="btn btn-outline-secondary p-4 my-4" style="width:84%;" id="btn-add"><svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/></svg></a>
      </div><!-- render-product -->
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="js/select.js"></script>
<!-- <script src="js/switch.js"></script> -->
<script src="js/range.js"></script>
<script src="js/range-max.js"></script>
</body>
</html>