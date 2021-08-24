<?php
include("./Config/db.php");
$user_ip = $_SERVER['REMOTE_ADDR'];
$qty = $_POST['tquant'];
$subtotal = $_POST['subtotal'];
$total = $_POST['mainSubtotal'];

// $stmt = $db->prepare("SELECT pc.id, pc.cart_code, pc.pid, pc.created_at, p.name, p.catid, p.quantity, p.vendorid, p.price, p.madeDate FROM pending_cart pc
//                       LEFT JOIN paintings p ON pc.pid=p.pid
//                       WHERE pc.cart_code = :cart_code");
// $stmt->execute(array('cart_code'=> $user_ip));
// $row = $stmt->fetch(PDO::FETCH_ASSOC);
// if($stmt->rowCount() > 0){
//   $stmt = $db->prepare("INSERT INTO cart (qty, tprice, cart_code) VALUES (:qty, :tprice, :cart_code)");
//   $stmt->execute(
//     array(
//       'cart_code'=> $user_ip,
//       'tprice'=> $total,
//       'qty'=> $qty
//     )
//   );
//   if($stmt->rowCount() > 0){
//     $stmt = $db->prepare("DELETE FROM pending_cart WHERE cart_code=:cart_code");
//     $stmt->execute(array('cart_code'=> $user_ip));
//   }

//   print_r($_SESSION['cart']);
//   echo "Data is ready $qty with $total Rwf";

// }else{
  echo $user_ip." Not FOUND";
// }



?>