<?php
  session_start();

include('../database/db.php');

if(isset($_POST['order_tx_ref'])){
  $order_tx_ref = $_POST['order_tx_ref'];
  
  $sql = "SELECT f.farmer_firstname,f.farmer_phone,f.farmer_lastname,f.district AS farmer_district, f.sector AS farmer_sector,
   f.sector AS farmer_sector, f.cell AS farmer_cell, f.village AS farmer_village,o.qty,coop.coop_name,coop.phone_to_contact,
            coop.province AS coop_province,coop.district AS coop_district,o.tx_ref,pa.sales_status,
            coop.sector AS coop_sector,coop.cell AS coop_cell,coop.village AS coop_village,
            o.farmer_reg_no, p.name AS product_name, ps.product_size, ps.price FROM orders o 
          LEFT JOIN products p ON o.product_id = p.product_id
          LEFT JOIN cooperatives coop ON o.coop_id = coop.coop_id
          LEFT JOIN farmers f ON o.farmer_reg_no = f.farmer_reg_no
          LEFT JOIN payments pa ON o.tx_ref = pa.tx_ref
          LEFT JOIN products_size ps ON o.ps_id = ps.id WHERE o.tx_ref  = :tx_ref";
  $stmt = $db->prepare($sql);
  $stmt->execute(
    array('tx_ref' => $order_tx_ref)
  );
  if($stmt->rowCount() > 0){
    $total_price = 0;
    $sales_status = 0;
    $coop_name = "";
    $ref = "";
    $coop_location = "";
    $farmer_location = "";
    $phone_to_contact = "";
    $farmer_lastname = "";
    $farmer_firstname = "";
    $farmer_phone = "";
    $farmer_reg_no = "";
    foreach($stmt AS $row){
      $ref = $row['tx_ref'];
      $sales_status = $row["sales_status"];
      $farmer_lastname = $row["farmer_lastname"];
      $farmer_firstname = $row["farmer_firstname"];
      $farmer_phone = $row["farmer_phone"];
      $farmer_reg_no = $row["farmer_reg_no"];
      $phone_to_contact = $row["phone_to_contact"];
      $coop_name = $row["coop_name"];
      $coop_location = $row["coop_district"].', '.$row["coop_sector"].', '.$row["coop_cell"].', '.$row["coop_village"];
      $farmer_location = $row["farmer_district"].', '.$row["farmer_sector"].', '.$row["farmer_cell"].', '.$row["farmer_village"];
      $product = $row["product_name"];
      $product_size = $row["product_size"];
      $items = $row["qty"];
      $price = $row["price"];
      $total = (int)$row["qty"] * (int)$row['price'];
      $total_price += $total;
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
      
    }

    echo '<h2>Total: <span class="text-primary">Rwf '.$total_price.'</span></h2>';
    // if($sales_status == 0){
      echo '
          <div class="row">
            <div class="col-sm-6">
              <h2 class="success">Coop Address</h2>
              <small>Coop Name: <span class="text-primary">'.$coop_name.''.$sales_status.'</span><br></small>
              <small>Coop Location: <span class="text-primary">'.$coop_location.'</span><br></small>
              <small>Coop Phone: <span class="text-primary">'.$phone_to_contact.'</span></small>
            </div>
            <div class="col-sm-6">
              <h2 class="success">Farmer Address</h2>
              <small>Farmer Name: <span class="text-primary">'.$farmer_lastname.' '.$farmer_firstname.'</span><br></small>
              <small>Farmer Location: <span class="text-primary">'.$farmer_location.'</span><br></small>
              <small>Farmer Reg No: <span class="text-primary">'.$farmer_reg_no.'</span></small>
              <small>Farmer Phone No: <span class="text-primary">'.$farmer_phone.'</span></small>
            </div>
          </div>
          ';

  }else{
    echo "No Details Found";
  }


}

?>