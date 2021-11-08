<?php

  // if(isset($_SESSION['un_id'])){
    $sql_cat = "SELECT * FROM categories";
    $stmt_cat = $db->prepare($sql_cat);
    $stmt_cat->execute();
    
    if(isset($_POST['add_new_product'])){
      $name = htmlspecialchars(strip_tags($_POST['name']));
      $cat_id = htmlspecialchars(strip_tags($_POST['cat_id']));
      $descriptions = htmlspecialchars(strip_tags($_POST['descriptions']));
      $photo = $_FILES['photo']['name'];

       // image file directory
      $ext = pathinfo($photo, PATHINFO_EXTENSION);
      $new_target = $name.'_'.$cat_id.'_'.time().'.'.$ext;
      $allowed = array('png', 'jpg', 'jpeg');
      $maxsize    = 2057152;
      if (!in_array($ext, $allowed)) {
        echo "<script language='javascript'>";
        echo "if(!alert('Valid image formats are .png, .jpeg or .jpg! Try again')){
          window.location.replace('./new_product.php');
        }";
        echo "</script>";
      }else{
        if(($_FILES['photo']['size'] >= $maxsize) || ($_FILES["photo"]["size"] == 0)){
          echo "<script language='javascript'>";
          echo "if(!alert('File too large. File must be less than 2Mbs! Try again')){
            window.location.replace('./new_product.php');
          }";
          echo "</script>";
        }else{
          if (move_uploaded_file($_FILES['photo']['tmp_name'], "../assets/images/products/".$new_target)) {
            try{
              $sql = "INSERT INTO products (name,cat_id , descriptions, photo) 
              VALUES (:name,:cat_id, :descriptions, :photo)";
              $stmt = $db->prepare($sql);
              $stmt->bindParam(':name', $name);
              $stmt->bindParam(':cat_id', $cat_id);
              $stmt->bindParam(':descriptions', $descriptions);
              $stmt->bindParam(':photo', $new_target);
          
              $stmt->execute();
      
              if($stmt->rowCount() == 1){
                $last_product_id = $db->lastInsertId();
                $_SESSION['last_product_id'] = $last_product_id;
                header('location: ./product_size.php');
              }else{
                $result = "<small>Something went wrong</small>";
                $alert = "alert-danger";
              }
            }catch(PDOException $ex){
              $result = "<p>Error occured: ".$ex->getMessage()."</p>";
              $alert = "alert-danger";
            }
          }else{
            echo "<script language='javascript'>";
            echo "if(!alert('No added! Directory not found! Under construction This feature will be available very soon')){
                  window.location.replace('./new_product.php');
                }";
            echo "</script>";
          }
        }


      }

    }





?>

  <div class="card">
    <div class="card-header">
      <h5 class="card-title">New Product</h5>
      <h6 class="card-subtitle text-muted">Please Fill each Field to Complete New Product Registration!</h6>
    </div>
    <div class="card-body">
      <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group">
          <label class="form-label">Product Name <span class="text-danger">*</span> </label>
          <input type="text" name="name" id="name" class="form-control product_name" placeholder="E.g: Millmax" required>
          <small class="text-danger" id="p_name_msg"></small>
        </div>
        <div class="form-row">
          <div class="form-group col-md-12">
            <label for="inputAddress">Category<span class="text-danger">*</span></label>
            <select id="cat_id" name="cat_id" class="form-control"  required>
              <option value="" hidden selected>Choose...</option>
              <?php while($category = $stmt_cat->fetch(PDO::FETCH_ASSOC)): ?>
              <option value="<?= $category['cat_id'] ?>">
                <?= $category['cat_name'] ?>
              </option>
              <?php endwhile ?>
            </select>
            <small class="text-danger" id="cat_msg"></small>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-12">
            <label class="form-label w-100">Add Product Descriptions <span class="text-muted">Optional</span></label>
            <textarea name="descriptions" id="desc" class="form-control" cols="30" rows="6"
              placeholder="About the Product"></textarea>
            <small class="text-danger" id="desc_msg"></small>
          </div>
          <!-- <small class="form-text text-muted">To be more specific, <br> We recommend you to add two images to your
            product right after submitting this form!</small> -->
        </div>
        <div class="row">
          <div class="col-md-12">
            <label class="form-label w-100">Add Photo<span class="text-danger">*</span></label>
            <input type="file" name="photo" id=""  required>
          </div>
          <!-- <small class="form-text text-muted">To be more specific, <br> We recommend you to add two images to your
            product right after submitting this form!</small> -->
        </div>
          <br>
        <button type="submit" class="btn btn-primary addpro" name="add_new_product">Submit</button>
      </form>
    </div>
  </div>