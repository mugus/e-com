<?php 
// session_start();
include("./Config/db.php");

// Add product on cart
if(isset($_GET['itemid'])){
  $pen_id = $_GET['itemid'];
  $qty = $_POST['qty'];
  $pid = $_POST['pid'];
  $IP = $_SERVER['REMOTE_ADDR'];

  $sql = "UPDATE pending_cart pc SET pc.qty = :qty WHERE pc.id =  :id";
  $stmt = $db->prepare($sql);
  $stmt->execute(
    array(
      'id'=>$pen_id,
      'qty'=>$qty,
      // 'pid'=>$pid
      )
  );
  if($stmt->rowCount() == 1){
    $sql = "SELECT *, SUM(pai.price * pc.qty) AS all_total, SUM(pc.qty) AS all_qty 
            FROM pending_cart pc 
            LEFT JOIN paintings pai ON pc.pid = pai.pid 
            WHERE pc.cart_code =  :cart_code";
    $stmt = $db->prepare($sql);
    $stmt->execute(
      array(
        'cart_code'=>$IP
        )
    );
    $ans = $stmt->fetch(PDO::FETCH_ASSOC);
    if($ans['all_total'] > 50000){
      $delivery = (int)$ans['all_total']*(8/100);
      $main_total = $ans['all_total'] + $delivery;
      echo "
        <ul>
          <li>Quantities <span>".$ans['all_qty']." Items</span></li>
          <li>Subtotal <span> <i class='sub'>".number_format(sprintf("%.2f", $ans['all_total']))."</i> Rwf</span></li>
          <li>Delivery <span> <i class='delivery'></i>".number_format(sprintf("%.2f", $delivery))." Rwf</span></li>
          <li>Total <span> <i class='mainTotal'>".number_format($main_total)."</i>  Rwf</span></li>
        </ul>";
    }else{
      $delivery = 7500;
      $main_total = $ans['all_total'] + $delivery;
      echo "
        <ul>
          <li>Quantities <span>".$ans['all_qty']." Items</span></li>
          <li>Subtotal <span> <i class='sub'>".number_format(sprintf("%.2f", $ans['all_total']))."</i> Rwf</span></li>
          <li>Delivery <span> <i class='delivery'></i>".number_format(sprintf("%.2f", $delivery))." Rwf</span></li>
          <li>Total <span> <i class='mainTotal'>".number_format($main_total)."</i>  Rwf</span></li>
        </ul>";
    }


  }



  // if($stmt->rowCount() == 1){
  //   $sql = "SELECT pc.id,pc.cart_code,pc.pid,pc.qty,pc.Subtotal,pc.created_at, pai.price * pc.qty AS all_total
  //                   pai.pid,pai.name,pai.quantity,pai.price
  //           FROM pending_cart pc LEFT JOIN paintings pai ON pc.pid = pai.pid WHERE pc.cart_code = :cart_code";
  //   $stmt = $db->prepare($sql);
  //   $stmt->execute(
  //     array(
  //       'cart_code'=>$IP
  //       )
  //   );
  //   if($stmt->rowCount() > 0){
  //     $count = $stmt->rowCount();
  //     $ans = $stmt->fetch();
  //   }

  // }

 
}

?>