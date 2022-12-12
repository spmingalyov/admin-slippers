<?php
function sort_items($db, $get_id) {
  $query = "SELECT * FROM `items`";

  if($get_id == 'pop') {
    $query .= "ORDER BY `items`.`popularity` DESC";
  } else if($get_id == 'chp') {
    $query .= "ORDER BY `items`.`price` ASC";
  } else if($get_id == 'rch') {
    $query .= "ORDER BY `items`.`price` DESC";
  } else if($get_id == 'sal') {
    $query .= "ORDER BY `items`.` discount` DESC";
  }

  $items = mysqli_query($db, $query);
  $items = mysqli_fetch_all($items);
  return $items;
}


function select_category($db, $select) {
  $query = "SELECT * FROM `items`";

  if($select == 'all') {
    $query = "SELECT * FROM `items`";
  } else if(($select == 'wom')) {
    $query.= "WHERE `category` = 'женские'";
  }else if(($select == 'man')) {
    $query.= "WHERE `category` = 'мужские'";
  } else if(($select == 'kid')) {
    $query.= "WHERE `category` = 'детские'";
  }

  $items = mysqli_query($db, $query);
  $items = mysqli_fetch_all($items);
  return $items;
}

function select_category_by_sort($db, $select, $get_id) {
  $query = "SELECT * FROM `items`";

  if($select == 'all') {
    $query = "SELECT * FROM `items`";
    if($get_id == 'pop') {
      $query .= "ORDER BY `items`.`popularity` DESC";
    } else if($get_id == 'chp') {
      $query .= "ORDER BY `items`.`price` ASC";
    } else if($get_id == 'rch') {
      $query .= "ORDER BY `items`.`price` DESC";
    } else if($get_id == 'sal') {
      $query .= "ORDER BY `items`.` discount` DESC";
    }

  } else if(($select == 'wom')) {
    $query.= "WHERE `category` = 'женские'";
    if($get_id == 'pop') {
      $query .= "ORDER BY `items`.`popularity` DESC";
    } else if($get_id == 'chp') {
      $query .= "ORDER BY `items`.`price` ASC";
    } else if($get_id == 'rch') {
      $query .= "ORDER BY `items`.`price` DESC";
    } else if($get_id == 'sal') {
      $query .= "ORDER BY `items`.` discount` DESC";
    }

  }else if(($select == 'man')) {
    $query.= "WHERE `category` = 'мужские'";
    if($get_id == 'pop') {
      $query .= "ORDER BY `items`.`popularity` DESC";
    } else if($get_id == 'chp') {
      $query .= "ORDER BY `items`.`price` ASC";
    } else if($get_id == 'rch') {
      $query .= "ORDER BY `items`.`price` DESC";
    } else if($get_id == 'sal') {
      $query .= "ORDER BY `items`.` discount` DESC";
    }

  } else if(($select == 'kid')) {
    $query.= "WHERE `category` = 'детские'";
    if($get_id == 'pop') {
      $query .= "ORDER BY `items`.`popularity` DESC";
    } else if($get_id == 'chp') {
      $query .= "ORDER BY `items`.`price` ASC";
    } else if($get_id == 'rch') {
      $query .= "ORDER BY `items`.`price` DESC";
    } else if($get_id == 'sal') {
      $query .= "ORDER BY `items`.` discount` DESC";
    }

  }

  $items = mysqli_query($db, $query);
  $items = mysqli_fetch_all($items);
  return $items;
}

function select_category_by_price($db, $select, $min, $max)  {
  $query = "SELECT * FROM `items`";

  if($select == 'all') {
    $query = "SELECT * FROM `items` WHERE `price` BETWEEN '$min' AND '$max'";
  } else if(($select == 'wom')) {
    $query.= "WHERE `category` = 'женские' AND `price` BETWEEN '$min' AND '$max'";
  } else if(($select == 'man')) {
    $query.= "WHERE `category` = 'мужские' AND `price` BETWEEN '$min' AND '$max'";
  } else if(($select == 'kid')) {
    $query.= "WHERE `category` = 'детские' AND `price` BETWEEN '$min' AND '$max'";
  }

  $items = mysqli_query($db, $query);
  $items = mysqli_fetch_all($items);
  return $items;
}

function filter_by_price($db, $min, $max) {
  $query = "SELECT * FROM `items` WHERE `price` BETWEEN '$min' AND '$max'";
  $items = mysqli_query($db, $query);
  $items = mysqli_fetch_all($items);
  return $items;
}

function filter_by_price_and_sorting($db, $get_id, $min, $max) {
  $query = "SELECT * FROM `items` WHERE `price` BETWEEN '$min' AND '$max'";

  if($get_id == 'pop') {
    $query .= "ORDER BY `items`.`popularity` DESC";
  } else if($get_id == 'chp') {
    $query .= "ORDER BY `items`.`price` ASC";
  } else if($get_id == 'rch') {
    $query .= "ORDER BY `items`.`price` DESC";
  } else if($get_id == 'sal') {
    $query .= "ORDER BY `items`.` discount` DESC";
  }

  $items = mysqli_query($db, $query);
  $items = mysqli_fetch_all($items);
  return $items;
}