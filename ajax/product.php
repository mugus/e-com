<?php
  session_start();

include('../database/db.php');

if(isset($_POST['product_id'])){
  $product_id = $_POST['product_id'];
  
  $sql = "SELECT p.product_id,p.name,p.cat_id,cat.cat_name,p.stock,p.price,
  p.man_date,p.exp_date,p.product_status,p.descriptions,p.photo,p.creation_date
  FROM products p 
  LEFT JOIN categories cat ON cat.cat_id = p.cat_id
  WHERE p.product_id = :product_id";
  $stmt = $db->prepare($sql);
  $stmt->execute(
    array('product_id' => $product_id)
  );
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  echo json_encode($row);
}



if(isset($_POST['option_value'])){
// $selected_option = $_POST['option_value'];

  $product_id = $_POST['option_value'];
  echo $product_id.' Rwf';
  // $sql = "SELECT p.product_id,p.name,p.cat_id,cat.cat_name,p.stock,p.price,
  // p.man_date,p.exp_date,p.product_status,p.descriptions,p.photo,p.creation_date
  // FROM products p 
  // LEFT JOIN categories cat ON cat.cat_id = p.cat_id
  // WHERE p.product_id = :product_id";
  // $stmt = $db->prepare($sql);
  // $stmt->execute(
  //   array('product_id' => $product_id)
  // );
  // $row = $stmt->fetch(PDO::FETCH_ASSOC);
  // echo json_encode($row);
}
?>