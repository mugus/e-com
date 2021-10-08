<?php
  session_start();

include('../database/db.php');

if(isset($_POST['cart'])){
  $cart = $_POST['cart'];
  
  $sql = "SELECT c.qty,c.user_id,c.cart_id,p.product_id,p.name,p.cat_id,cat.cat_name,p.stock,p.price,
            p.man_date,p.exp_date,p.product_status,p.descriptions,p.photo,p.creation_date
          FROM cart c 
          LEFT JOIN products p ON c.product_id = p.product_id
          LEFT JOIN categories cat ON cat.cat_id = p.cat_id
          WHERE c.cart_id = :cart_id";
  $stmt = $db->prepare($sql);
  $stmt->execute(
    array('cart_id' => $cart)
  );
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  echo json_encode($row);

}

if(isset($_POST['qtyplus_cart_id'])){
  $qtyplus_cart_id = $_POST['qtyplus_cart_id'];

  $sql = "SELECT * FROM cart c WHERE c.cart_id = :cart_id";
  $stmt = $db->prepare($sql);
  $stmt->execute(
    array(
      'cart_id' => $qtyplus_cart_id
      )
  );
  if($stmt->rowCount() == 1){
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $qty = (int)$row['qty'] + 1;
    $sql = "UPDATE cart c SET c.qty=:qty WHERE c.cart_id = :cart_id";
    $stmt = $db->prepare($sql);
    $stmt->execute(
      array(
        'cart_id' => $qtyplus_cart_id,
        'qty' => $qty
      )
    );
  }
}

  if(isset($_POST['qtyminus_cart_id'])){
    $qtyminus_cart_id = $_POST['qtyminus_cart_id'];
  
    $sql = "SELECT * FROM cart c WHERE c.cart_id = :cart_id";
    $stmt = $db->prepare($sql);
    $stmt->execute(
      array(
        'cart_id' => $qtyminus_cart_id
        )
    );
    if($stmt->rowCount() == 1){
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $qty = (int)$row['qty'] - 1;
      if($qty > 0){
        $sql = "UPDATE cart c SET c.qty=:qty WHERE c.cart_id = :cart_id";
        $stmt = $db->prepare($sql);
        $stmt->execute(
          array(
            'cart_id' => $qtyminus_cart_id,
            'qty' => $qty
          )
        );
      }
    }
  }


?>