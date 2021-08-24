<?php
// Get all Tecnics in form
$te = "SELECT * FROM technics";
$technic = $db->prepare($te);
$technic->execute();

// Get All CAtegories
$cate = "SELECT * FROM category";
$categor = $db->prepare($cate);
$categor->execute();

if(isset($_POST['add_new_paint'])){
  $catid = htmlspecialchars(strip_tags($_POST['category']));
  $tech_id = htmlspecialchars(strip_tags($_POST['technics']));
  $vendorid = htmlspecialchars(strip_tags($_SESSION['vendorid']));
  $name = htmlspecialchars(strip_tags($_POST['name']));
  $height = htmlspecialchars(strip_tags($_POST['height']));
  $width = htmlspecialchars(strip_tags($_POST['width']));
  $price = htmlspecialchars(strip_tags($_POST['price']));
  $quantity = htmlspecialchars(strip_tags($_POST['quantity']));
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
    $sql = "INSERT INTO paintings (catid, tech_id, vendorid, name, height, width, price, quantity, madeDate, photoid) 
        VALUES (:catid, :tech_id, :vendorid, :name, :height, :width, :price, :quantity, :madeDate, :photoid)";
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
            'madeDate'=>$madeDate,
            'photoid'=>$photoid
          )
        );
      // send Photoid To the File Of Uploading Paintings Images
    header('Location: ./add_product_image.php?painting='.$photoid);
  }else{
    $alert_class = "class='alert alert-info alert-dismissable alert-sm'";
    $result = "<small>The Painting Exist! Please Choose a Different Painting</small>";
    $msg = "<strong>Ooops!</strong>";
    header('Location: ./add_product.php');
  }

  
}
?>
<div class="row">

  
  <div class="col-12 col-xl-8">
    <div class="card">
      <div class="card-header">
        <?php if(isset($result)){
          echo "<div $alert_class role='alert'>
                  <div class='alert-icon'>
                  <i class='far fa-fw fa-bell'></i>
                  </div>
                  <div class='alert-message'>
                  $msg $result!
                  </div>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>";
              }
        ?>
        <h5 class="card-title">New Painting</h5>
        <h6 class="card-subtitle text-muted">Please Fill each Field to Complete New Painting Registration!</h6>
      </div>
      <div class="card-body">
        <form onsubmit=" return ValidatePaint();" method="POST" action="contents/paintingManagement.php" enctype="multipart/form-data">
          <div class="form-group">
            <label class="form-label">Painting Name <span class="text-danger">*</span> </label>
            <input type="text" name="name" id="paint_name" class="form-control" placeholder="E.g: Rwanda tradition stand">
            <small class="text-danger" id="p_name_msg"></small>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputAddress">Category<span class="text-danger">*</span></label>
              <select id="category" name="category" class="form-control">
                <option value="" hidden selected>Choose...</option>
                <?php while($ca=$categor->fetch(PDO::FETCH_ASSOC)): ?>
                <option value="<?= $ca['catid'] ?>"><?= $ca['name'] ?></option>
                <?php endwhile ?>
              </select>
              <small class="text-danger" id="cat_msg"></small>
            </div>
            <div class="form-group col-md-6">
              <label for="inputAddress">Technics<span class="text-danger">*</span></label>
              <select id="technics" name="technics" class="form-control">
                <option value="" hidden selected>Choose...</option>
                <?php while($tech = $technic->fetch(PDO::FETCH_ASSOC)): ?>
                <option value="<?= $tech['tech_id'] ?>"><?= $tech['tech_name'] ?></option>
                <?php endwhile ?>
              </select>
              <small class="text-danger" id="tech_msg"></small>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-2">
              <label for="inputCity">Height<span class="text-danger">*</span>(cm)</label>
              <input type="number" min="0" name="height" class="form-control" id="height" placeholder="E.g: ">
            </div>
            <div class="form-group col-md-2">
              <label for="inputZip">Width<span class="text-danger">*</span>(cm)</label>
              <input type="number" min="0" name="width" class="form-control" id="width" placeholder="E.g: ">
            </div>
            <div class="form-group col-md-2">
              <label for="inputZip">Quantity<span class="text-danger">*</span></label>
              <input type="number" name="quantity" class="form-control" id="quantity" placeholder="E.g: 5">
            </div>
            <div class="form-group col-md-2">
              <label for="inputZip">Price<span class="text-danger">*</span>(Rwf)</label>
              <input type="number" name="price" class="form-control" id="price" placeholder="E.g: ">
            </div>
            <div class="form-group col-md-4">
              <label class="form-label w-100">Date of idea<span class="text-danger">*</span></label>
              <input type="date" name="madeDate" class="form-control" id="dates">
              <small class="text-danger" id="date_msg"></small>
            </div>
            <small class="text-danger" id="sizes_msg"></small>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label class="form-label w-100">Add Painting Description<span class="text-danger">*</span></label>
              <textarea name="description" id="desc" class="form-control" cols="30" rows="6" placeholder="Explanation About the Painting"></textarea>
              <small class="text-danger" id="desc_msg"></small>
            </div>
            <small class="form-text text-muted">To be more specific, <br> We recommend you to add more images to your paint right after submitting this form!</small>
          </div>

          <button type="submit" class="btn btn-primary" name="add_new_paint">Submit</button>
        </form>
      </div>
    </div>
  </div>
  
</div>
