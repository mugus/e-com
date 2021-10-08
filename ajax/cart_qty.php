<?php
  session_start();

include('../database/db.php');

$cart_id = $_POST['cart_id'];
$qty = $_POST['qty'];

$sql = "UPDATE cart c SET c.qty=:qty WHERE c.cart_id = :cart_id";
  $stmt = $db->prepare($sql);
  $stmt->execute(
    array(
      'cart_id' => $cart_id,
      'qty' => $qty
    )
  );
// echo "qty: ".$qty." Cart id:". $cart_id;

?>