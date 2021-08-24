<?php
include("../../config/db.php");
?>

<?php

if(isset($_POST['add_new_paint'])){
  // Get all Tecnics in form
  $te = "SELECT * FROM technics";
  $technic = $db->prepare($te);
  $technic->execute();
  
  // Get All CAtegories
  $cate = "SELECT * FROM category";
  $categor = $db->prepare($cate);
  $categor->execute();

  // Get All form Fields value
  $catid = htmlspecialchars(strip_tags($_POST['category']));
  $tech_id = htmlspecialchars(strip_tags($_POST['technics']));
  $vendorid = htmlspecialchars(strip_tags($_SESSION['vendorid']));
  $name = htmlspecialchars(strip_tags($_POST['name']));
  $height = htmlspecialchars(strip_tags($_POST['height']));
  $width = htmlspecialchars(strip_tags($_POST['width']));
  $price = htmlspecialchars(strip_tags($_POST['price']));
  $quantity = htmlspecialchars(strip_tags($_POST['quantity']));
  $description = htmlspecialchars(strip_tags($_POST['description']));
  $madeDate = htmlspecialchars(strip_tags($_POST['madeDate']));

  // create a Random Code to use when recording multiple images on one painting
  $randCode = rand(10, 360780);
  $photoid = $catid.''.$tech_id.''.$randCode.''.$vendorid;
  // verify if the Painting exist 
  try {
    $chksql = "SELECT * FROM paintings WHERE name=:name"; 
    $chkstmt = $db->prepare($chksql);
    $chkstmt->execute(
      array(
        ':name'=>$name
        )
      );
    $chkrow = $chkstmt->fetch(PDO::FETCH_ASSOC);

  } catch(PDOException $ex){
    $alert_class = "class='alert alert-info alert-dismissable alert-sm'";
    $result = "<small>".$ex->getMessage()."</small>";
    $msg = "<strong>Ooops!</strong>";
  }
  if($chkstmt->rowCount()<=0){
    // insert Painting first information except Images
    $sql = "INSERT INTO paintings (catid, tech_id, vendorid, name, height, width, price, quantity, description, madeDate, photoid) 
        VALUES (:catid, :tech_id, :vendorid, :name, :height, :width, :price, :quantity, :description, :madeDate, :photoid)";
        $stmt = $db->prepare($sql);
        $stmt->execute(
          array(
            'catid'=>$catid,
            'tech_id'=>$tech_id,
            'vendorid'=>$vendorid,
            'name'=>$name,
            'height'=>$height,
            'width'=>$width,
            'price'=>$price,
            'quantity'=>$quantity,
            'description'=>$description,
            'madeDate'=>$madeDate,
            'photoid'=>$photoid
          )
        );
      // send Photoid To the File Of Uploading Paintings Images
    header('Location: ../add_product_image.php?painting='.$photoid.'&category='.$catid.'&technic='.$tech_id.'&vendor='.$vendorid);
  }else{
    $alert_class = "class='alert alert-info alert-dismissable alert-sm'";
    $result = "<small>The Painting Exist! Please Choose a Different Painting</small>";
    $msg = "<strong>Ooops!</strong>";
    header('Location: ../add_product.php');
  }

  
}
?>