<?php
  session_start();
include('../database/db.php');
    $sq = "SELECT * FROM products WHERE product_id = :product_id";
    $stet = $db->prepare($sq);
    $stet->execute(array('product_id'=>$_SESSION['last_product_id']));
    $product=$stet->fetch(PDO::FETCH_ASSOC);

  if(isset($_SESSION['last_product_id'])){

    if(isset($_POST['add_new_size'])){
      
      $product_size = $_POST['product_size1'];
      $product_id = $_SESSION['last_product_id'];
      $price = $_POST['price1'];
      $stock = $_POST['stock1'];
      $man_date = $_POST['man_date1'];
      $exp_date = $_POST['exp_date1'];
         foreach ($price as $index => $prices) {
          $ar_price = $prices;
          // $ar_product_id = $product_id[$index];
          $ar_product_size = $product_size[$index];
          $ar_stock = $stock[$index];
          $ar_man_date = $man_date[$index];
          $ar_exp_date = $exp_date[$index];

          try{
            $sql = "INSERT INTO products_size (product_size,product_id, price, stock, man_date, exp_date) VALUES (:product_size,:product_id ,:price, :stock, :man_date, :exp_date)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':product_size', $ar_product_size);
            $stmt->bindParam(':product_id', $product_id);
            $stmt->bindParam(':price', $ar_price);
            $stmt->bindParam(':stock', $ar_stock);
            $stmt->bindParam(':man_date', $ar_man_date);
            $stmt->bindParam(':exp_date', $ar_exp_date);
    
            $stmt->execute();
  
            if($stmt->rowCount() > 0){
                $result = "<small>You are successful created product sizes</small>";
                $alert = "alert-success";
            }else{
                $result = "<small>Something went wrong</small>";
                $alert = "alert-danger";
            }
          }catch(PDOException $ex){
            $result = "<p>Error occured: ".$ex->getMessage()."</p>";
            $alert = "alert-danger";
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
            
            <?php include("./contents/new_size.php") ?>
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