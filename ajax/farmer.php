<?php
  session_start();
  include('../database/db.php');

  if(isset($_POST['farmer_reg_no'])){
    $farmer_reg_no = $_POST['farmer_reg_no'];
  
    $sql = "SELECT * FROM farmers WHERE farmer_reg_no=:farmer_reg_no";
    $ema = $db->prepare($sql);
    $ema->execute(
      array(
        ':farmer_reg_no'=>$farmer_reg_no
        )
      );
    if($ema->rowCount()==1){
      echo "<b>$farmer_reg_no<b> is not available(Reload page to renew code)";
      echo '<script>';
      echo "$('#add_new_farmer').prop('disabled', true)";
      echo '</script>';
    }else{
      echo '<script>';
      echo "$('#add_new_farmer').prop('disabled', false)";
      echo '</script>';
    }

  }


  if(isset($_POST['farmer_opt'])){
    $farmer_opt = $_POST['farmer_opt'];
    $sql = "SELECT * FROM farmers f WHERE f.farmer_id = :farmer_id";
    $stmt = $db->prepare($sql);
    $stmt->execute(
      array('farmer_id' => $farmer_opt)
    );
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $names = $row['farmer_lastname']." ".$row['farmer_firstname'];
    $province = $row['province'];
    $district = $row['district'];
    $sector = $row['sector'];
    $cell = $row['cell'];
    $village = $row['village'];
    $phone = $row['farmer_phone'];
    $farmer_address = $row['sector'].', '.$row['cell'].', '.$row['village'];
    $farmer_reg_no = $row['farmer_reg_no'];
    echo '
      <div class="col-md-12">
        <h2 class="text-primary login-title">'.$names.'</h2>
        <input type="hidden" name="fullname" value="'.$names.'">
        <input type="hidden" name="farmer_address" value="'.$farmer_address.'">
        <input type="hidden" name="farmer_phone" value="'.$phone.'">
        <input type="hidden" name="farmer_reg_no" value="'.$farmer_reg_no.'">
      </div>
      <div class="col-md-6">
        <p><span class="text-muted">Province : </span> <span class="text-primary">'.$province.'</span></p>
      </div>
      <div class="col-md-6">
        <p><span class="text-muted">District : </span> <span class="text-primary">'.$district.'</span></p>
      </div>
      <div class="col-md-6">
        <p><span class="text-muted">Sector : </span> <span class="text-primary">'.$sector.'</span></p>
      </div>
      <div class="col-md-6">
        <p><span class="text-muted">Cell : </span> <span class="text-primary">'.$cell.'</span></p>
      </div>
      <div class="col-md-6">
        <p><span class="text-muted">Village	: </span> <span class="text-primary">'.$village.'</span></p>
      </div>
      <div class="col-md-6">
        <p><span class="text-muted">Phone N<sup>o</sup> :</span> <span class="text-primary">'.$phone.'</span></p>
      </div>
    ';
  }



  if(isset($_POST['farmer_phone'])){
    $farmer_phone = $_POST['farmer_phone'];
  
    $sql = "SELECT * FROM farmers WHERE farmer_phone=:farmer_phone";
    $sql = $db->prepare($sql);
    $sql->execute(
      array(
        ':farmer_phone'=>$farmer_phone
        )
      );
    if($sql->rowCount()==1){
      echo "Phone No is not available (Try New Phone No)";
      echo '<script>';
      echo "$('#add_new_farmer').prop('disabled', true)";
      echo '</script>';
    }else{
      echo '<script>';
      echo "$('#add_new_farmer').prop('disabled', false)";
      echo '</script>';
    }

  }

?>