<?php
  session_start();

include('../database/db.php');

if(isset($_POST['order_tx_ref'])){
  $order_tx_ref = $_POST['order_tx_ref'];
  
  $sql = "SELECT f.farmer_firstname,f.farmer_lastname,o.qty,o.farmer_address,o.coop_address,o.coop_phone,
                o.farmer_reg_no, p.name AS product_name, o.farmer_phone, ps.product_size, ps.price FROM orders o 
        LEFT JOIN products p ON o.product_id = p.product_id
        LEFT JOIN farmers f ON o.farmer_reg_no = f.farmer_reg_no
        LEFT JOIN payments pa ON o.tx_ref = pa.tx_ref
        LEFT JOIN products_size ps ON o.ps_id = ps.id WHERE o.tx_ref  = :tx_ref";
  $stmt = $db->prepare($sql);
  $stmt->execute(
    array('tx_ref' => $order_tx_ref)
  );
  if($stmt->rowCount() > 0){
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $product = $row["product_name"];
      $product_size = $row["product_size"];
      $items = $row["qty"];
      $price = $row["price"];
      // $total_price += (int)$row["qty"] * (int)$row['price'];
      $farmer_names = $row["farmer_lastname"]." ".$row["farmer_firstname"];
      echo '
      <div class="row">
        <div class="col-md-12">
          <span class="text-muted">Product name: </span><span class="text-primary">'.$product.'</span>
        </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <span class="text-muted">Product Size: </span><span class="text-primary">'.$product_size.'</span>
            <span class="text-muted">Quantity: </span><span class="text-primary">'.$items.'</span>
          </div>
          <div class="col-md-6">
            <span class="text-muted">Product price: </span><span class="text-primary">'.$price.' Rwf</span>
          </div>
        </div><hr>
      ';
      // echo json_encode($row['product_name']);
    // echo json_encode("message"=>"More Details Found");
    }
  }else{
    echo "message No Details Found";
  }

  // echo "jfngoerngoern";
  // $row = $stmt->fetch(PDO::FETCH_ASSOC);
  // echo $_POST['order_tx_ref'];
  // echo json_encode($row);

}

?>