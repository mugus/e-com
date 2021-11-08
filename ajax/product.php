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



if(isset($_POST['product_size_details'])){

  $product = $_POST['product_size_details'];
  $sql = "SELECT * FROM products_size ps 
  LEFT JOIN products p ON p.product_id = ps.product_id WHERE p.product_id = :product_id;";
  $stmt = $db->prepare($sql);
  $stmt->execute(
    array('product_id' => $product)
  );
  $i = 1;
  $product_id = 0;
  $product_name = "";
  if($stmt->rowCount() > 0){
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $product_id = $row['product_id'];
      $product_name = $row['name'];
      $ps_id = $row['id'];
      $product_size = $row['product_size'];
      $price = $row['price'];
      $stock = $row['stock'];
      $man_date = $row['man_date'];
      $exp_date = $row['exp_date'];
  
  
      echo '
        <div class="row">
          <div class="col-md-12">
          '.$product_name.' size No: '.$i.'
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <span class="text-muted">Size Name: </span><span class="text-info">'.$product_size.'</span><br>
            <div class="row">
              <div class="col-md-6">
                <span class="text-muted">Price: </span><span class="text-info">'.$price.'</span>
              </div>
              <div class="col-md-6">
                <span class="text-muted">Stock: </span><span class="text-info">'.$stock.'</span>
              </div>
            </div>
          </div>
          <div class="col-md-6">
              <span class="text-muted">Man-date: </span><span class="text-info">'.$man_date.'</span><br>
              <span class="text-muted">Exp-Date: </span><span class="text-info">'.$exp_date.'</span>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-6">
              <button class="text-success ps_id" data-toggle="modal" data-target="#ps_id" data-id="'.$ps_id.'" href=""><span class="fa fa-pencil"></span>Update</button>
          </div>
          <div class="col-md-6">
            <div class="text-right">
              <button class="text-danger show_ps_id" onclick="ShowWarning('.$ps_id.')">Remove<span class="fa fa-trash"></span></button>
            </div>
          </div>
          
        </div>
        <div class="row" id="div'.$ps_id.'" style="display: none">
          <div class="col-md-2"></div>
          <div class="col-md-10">
            <h4 class="text-danger">Are you sure to delete this product details?</h4>
            <a href="./new_product.php?delete_ps_id='.$ps_id.'" class="btn Delete_ps_id">Yes Delete<span class="fa fa-trash"></span></a>
            <button onclick="HideWarning('.$ps_id.')" class="btn">Not Now</button>
          </div>
        </div>
  
        <hr>
        ';
        $i++;
    }
    echo '
      <div class="text-center">
        <button class="text-success new_ps" data-toggle="modal" data-target="#new_ps" data-id="'.$product_id.'">Add New Size</button>
      </div><br>
    ';

  }else{
    $last_product_id = $_POST['product_size_details'];
    $_SESSION['last_product_id'] = $last_product_id;
    // header('location: ./product_size.php');
    echo '
      <div class="text-left"><br>
        <h2>No Size Found</h2>
        <a class="text-success" href="./product_size.php">Record First New Size</a>
      </div><br>
    ';
  }
  // echo json_encode($row);
}

if(isset($_POST['product_name'])){
  $product_name = $_POST['product_name'];
  $sql = "SELECT * FROM products p WHERE p.name = :name";
  $stmt = $db->prepare($sql);
  $stmt->execute(
    array('name' => $product_name)
  );
  if($stmt->rowCount() > 0){
    echo '<strong>('.$product_name.')</strong> -> Product Exist in Db!';
    echo '<script>';
    echo "$('.addpro').prop('disabled', true)";
    echo '</script>';
  }else{
    echo '<script>';
    echo "$('.addpro').prop('disabled', false)";
    echo '</script>';
  }
}


if(isset($_POST['ps_id'])){
  $ps_id = $_POST['ps_id'];
  $sql = "SELECT * FROM products_size p WHERE p.id = :id";
  $stmt = $db->prepare($sql);
  $stmt->execute(
    array('id' => $ps_id)
  );
  if($stmt->rowCount() == 1){
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($row);
  }
  // echo $ps_id;
}

// add new p size
if(isset($_POST['new_ps'])){
  $new_ps = $_POST['new_ps'];
  $sql = "SELECT * FROM products p WHERE p.product_id = :product_id";
  $stmt = $db->prepare($sql);
  $stmt->execute(
    array('product_id' => $new_ps)
  );
  if($stmt->rowCount() == 1){
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($row);
  }
  // echo $ps_id;
}

// Edit stock
if(isset($_POST['edit_stock'])){
  $edit_stock = $_POST['edit_stock'];
  $sql = "SELECT st.id, ps.id AS ps_id, st.stock, ps.product_size, ps.price, cop.coop_name FROM stock_mgt st
          LEFT JOIN cooperatives cop ON st.coop_id = cop.coop_id
          LEFT JOIN products_size ps ON ps.id = st.ps_id
          WHERE st.id = :id";
  $stmt = $db->prepare($sql);
  $stmt->execute(
    array('id' => $edit_stock)
  );
  if($stmt->rowCount() == 1){
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($row);
  }
  // echo $ps_id;
}
?>