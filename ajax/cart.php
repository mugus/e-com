<?php
  session_start();

include('../database/db.php');

if(isset($_POST['cart'])){
  $cart = $_POST['cart'];
  
  $sql = "SELECT * FROM cart c 
  LEFT JOIN products p ON c.product_id = p.product_id
  LEFT JOIN products_size ps ON c.ps_id = ps.id
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
    $sql_st = "SELECT ps.id, st.id AS st_id, st.coop_id, st.stock, p.name AS product_name, ps.product_size, ps.price FROM stock_mgt st 
            LEFT JOIN products_size ps ON st.ps_id = ps.id
            LEFT JOIN products p ON ps.product_id = p.product_id
            WHERE st.coop_id = :coop_id";
    $stmt_st = $db->prepare($sql_st);
    $stmt_st->execute(
      array(
        'coop_id' => $_SESSION['cooperative']
      )
    );
    if($stmt_st->rowCount() > 0){
      $row_st = $stmt_st->fetch(PDO::FETCH_ASSOC);
      $stock_in_db = (int)$row_st['stock'];
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if(((int)$row['qty'] + 1) <= $stock_in_db){
        $qty = (int)$row['qty'] + 1;
        $sql = "UPDATE cart c SET c.qty=:qty WHERE c.cart_id = :cart_id";
        $stmt = $db->prepare($sql);
        $stmt->execute(
          array(
            'cart_id' => $qtyplus_cart_id,
            'qty' => $qty
          )
        );
      }else{
        // echo "<script language='javascript'>";
        // echo "if(!alert('Qty can not exceed Stock in Db')){
        //   window.location.replace('./cart');
        // }";
        // echo "</script>";
        $result = "<small>Qty can not exceed Stock in Db</small>";
        $alert = "alert-danger";
      }
    }else{
      $result = "<small>Out of Stock</small>";
      $alert = "alert-danger";
    }


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