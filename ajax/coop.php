<?php
  session_start();

include('../database/db.php');


if(isset($_POST['coop_opt'])){
  $coop_opt = $_POST['coop_opt'];
  
  $sql = "SELECT * FROM cooperatives coop WHERE coop.coop_id = :coop_id";
  $stmt = $db->prepare($sql);
  $stmt->execute(
    array('coop_id' => $coop_opt)
  );
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $name = $row['coop_name'];
  $province = $row['province'];
  $district = $row['district'];
  $sector = $row['sector'];
  $cell = $row['cell'];
  $village = $row['village'];
  $phone = $row['phone_to_contact'];
  $coop_address = $row['sector'].', '.$row['cell'].', '.$row['village'];
  echo '
    <div class="col-md-12">
      <h2 class="text-primary login-title">'.$name.'</h2>
      <input type="hidden" name="coop_address" value="'.$coop_address.'">
      <input type="hidden" name="coop_phone" value="'.$phone.'">
    </div>
    <div class="col-md-6">
      <p><span class="text-muted">Province : </span> <span class="text-primary">'.$province.'</span></p>
    </div>
    <div class="col-md-6">
      <p><span class="text-muted">Sector :</span> <span class="text-primary">'.$sector.'</span></p>
    </div>
    <div class="col-md-6">
      <p><span class="text-muted">Cell :</span> <span class="text-primary">'.$cell.'</span></p>
    </div>
    <div class="col-md-6">
      <p><span class="text-muted">District :</span> <span class="text-primary">'.$district.'</span></p>
    </div>
    <div class="col-md-6">
      <p><span class="text-muted">Village :</span> <span class="text-primary">'.$village.'</span></p>
    </div>
    <div class="col-md-6">
      <p><span class="text-muted">Phone N<sup>o</sup> :</span> <span class="text-primary">'.$phone.'</span></p>
    </div>
  ';
  // echo json_encode($row);

}

// echo "Working: ".$coop_opt;
?>