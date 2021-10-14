<?php
  session_start();
include('../database/db.php');

  if(isset($_SESSION['un_id']) AND $_SESSION['user_role'] == 1){

  // if(isset($_SESSION['un_id'])){
    $sql_cat = "SELECT * FROM categories";
    $stmt_cat = $db->prepare($sql_cat);
    $stmt_cat->execute();
    
    if(isset($_POST['add_new_product'])){
      $name = htmlspecialchars(strip_tags($_POST['name']));
      $cat_id = htmlspecialchars(strip_tags($_POST['cat_id']));
      // $price = htmlspecialchars(strip_tags($_POST['price']));
      // $stock = htmlspecialchars(strip_tags($_POST['stock']));
      // $man_date = htmlspecialchars(strip_tags($_POST['man_date']));
      // $exp_date = htmlspecialchars(strip_tags($_POST['exp_date']));
      $descriptions = htmlspecialchars(strip_tags($_POST['descriptions']));
      $photo = $_FILES['photo']['name'];

       // image file directory
      $ext = pathinfo($photo, PATHINFO_EXTENSION);
      $new_target = $name.'_'.$cat_id.'_'.time().'.'.$ext;
      $allowed = array('png', 'jpg', 'jpeg');
      if (!in_array($ext, $allowed)) {
        echo "<script language='javascript'>";
        echo "if(!alert('Valid image formats are .png, .jpeg or .jpg! Try again')){
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
            // $stmt->bindParam(':price', $price);
            // $stmt->bindParam(':man_date', $man_date);
            // $stmt->bindParam(':stock', $stock);
            // $stmt->bindParam(':exp_date', $exp_date);
            $stmt->bindParam(':descriptions', $descriptions);
            $stmt->bindParam(':photo', $new_target);
        
            $stmt->execute();
    
            if($stmt->rowCount() > 0){
              $last_product_id = $db->lastInsertId();
              $_SESSION['last_product_id'] = $last_product_id;
              header('location: ./product_size.php');
              // $result = "<small>Product added</small>";
              // $alert = "alert-success";
            }else{
              $result = "<small>Something went wrong</small>";
              $alert = "alert-danger";
            }
          }catch(PDOException $ex){
            $result = "<p>Error occured: ".$ex->getMessage()."</p>";
            $alert = "alert-danger";
          }
        }else{

        }
      }

    }


    include('./layouts/header.php');
 ?>


   <!--Body Content-->
   <div id="page-content">
    	<!--Page Title-->
    	<div class="page section-header text-center">
        <div class="page-title">
          <div class="wrapper"><h1 class="page-width">Agent Dashboard</h1></div>
        </div>
      </div>
      <style>
        @media screen and (max-width: 480px) {
          #admin_nav{
            display: none;
          }
        }
        @media screen and (min-width: 480px) {
          #phone_nav{
            display: none;
          }
          .hamburgs{
            display: none;
          }
        }
      </style>
        <!--End Page Title-->
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-lg-3 col-sm-12">
            <!-- <div class="hamburgs">
              <h1 class="open"><i class="fa fa-bars"></i></h1>
              <h1 class="close" style="display: none"><i class="fa fa-times"></i></h1>
            </div> -->
          <?php include("./layouts/sidebar.php") ?>

          </div>
          <div class="col-md-8 col-lg-9 col-sm-12">
            <?php include("./contents/new_product.php") ?>
          </div>
        </div>
      </div>

  </div

<?php 
include('./layouts/footer.php');
  }else{
    header("location: ../login");
  }
?>