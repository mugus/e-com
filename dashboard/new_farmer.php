<?php
  session_start();
include('../database/db.php');

  if(isset($_SESSION['un_id']) AND isset($_SESSION['user_role'])){



    if(isset($_POST['add_new_farmer'])){
      
      $farmer_firstname = htmlspecialchars(strip_tags($_POST['farmer_firstname']));
      $farmer_lastname = htmlspecialchars(strip_tags($_POST['farmer_lastname']));
      $farmer_reg_no = htmlspecialchars(strip_tags($_POST['farmer_reg_no']));
      $province = htmlspecialchars(strip_tags($_POST['province']));
      $district = htmlspecialchars(strip_tags($_POST['district']));
      $sector = htmlspecialchars(strip_tags($_POST['sector']));
      $cell = htmlspecialchars(strip_tags($_POST['cell']));
      $village = htmlspecialchars(strip_tags($_POST['village']));
      $farmer_phone = htmlspecialchars(strip_tags($_POST['farmer_phone']));
      $farmer_landsize = htmlspecialchars(strip_tags($_POST['farmer_landsize']));
      $farmer_product_season_A = htmlspecialchars(strip_tags($_POST['farmer_product_season_A']));
      $farmer_product_season_B = htmlspecialchars(strip_tags($_POST['farmer_product_season_B']));
      $farmer_product_season_C = htmlspecialchars(strip_tags($_POST['farmer_product_season_C']));

      $sql = "INSERT INTO farmers (farmer_firstname,farmer_lastname,farmer_reg_no, province, district, sector, village, farmer_phone,farmer_landsize,farmer_product_season_A,farmer_product_season_B, farmer_product_season_C) 
              VALUES
              (:farmer_firstname,:farmer_lastname,:farmer_reg_no,:province, :district, :sector, :village, :farmer_phone,:farmer_landsize,:farmer_product_season_A,:farmer_product_season_B, :farmer_product_season_C)";
      $stmt = $db->prepare($sql);

      $stmt->execute(
        array(
          'farmer_firstname'=> $farmer_firstname,
          'farmer_lastname'=> $farmer_lastname,
          'farmer_reg_no'=> $farmer_reg_no,
          'district'=> $district,
          'province'=> $province,
          'sector'=> $sector,
          'village'=> $village,
          'farmer_phone'=> $farmer_phone,
          'farmer_landsize'=> $farmer_landsize,
          'farmer_product_season_A'=> $farmer_product_season_A,
          'farmer_product_season_B'=> $farmer_product_season_B,
          'farmer_product_season_C'=> $farmer_product_season_C
        )
      );
      if($stmt->rowCount() > 0){
        $result = "<small>Farmer added</small>";
        $alert = "alert-success";
      }else{
        $result = "<small>Something went wrong</small>";
        $alert = "alert-danger";
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
          
          <?php include("./contents/new_farmer.php") ?>

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