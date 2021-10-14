<?php
  session_start();
  include('../database/db.php');

  if(isset($_SESSION['un_id']) AND $_SESSION['user_role'] == 1){
  
  if(isset($_POST['add_new_coop'])){
      
    $coop_name = htmlspecialchars(strip_tags($_POST['coop_name']));
    $phone_to_contact = htmlspecialchars(strip_tags($_POST['phone_to_contact']));
    $province = htmlspecialchars(strip_tags($_POST['province']));
    $district = htmlspecialchars(strip_tags($_POST['district']));
    $sector = htmlspecialchars(strip_tags($_POST['sector']));
    $cell = htmlspecialchars(strip_tags($_POST['cell']));
    $village = htmlspecialchars(strip_tags($_POST['village']));
    $descriptions = htmlspecialchars(strip_tags($_POST['descriptions']));

    $sql = "INSERT INTO cooperatives (phone_to_contact,coop_name, province, district, sector,cell, village, descriptions) 
            VALUES
            (:phone_to_contact,:coop_name,:province, :district, :sector, :cell,:village, :descriptions)";
    $stmt = $db->prepare($sql);

    $stmt->execute(
      array(
        'phone_to_contact'=> $phone_to_contact,
        'coop_name'=> $coop_name,
        'district'=> $district,
        'province'=> $province,
        'sector'=> $sector,
        'village'=> $village,
        'descriptions'=> $descriptions,
        'cell'=> $cell
      )
    );
    if($stmt->rowCount() > 0){
      $result = "<small>cooperatives added</small>";
      $alert = "alert-success";
    }else{
      $result = "<small>Something went wrong</small>";
      $alert = "alert-danger";
    }
  }


include('./layouts/header.php');
?>

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
          
          <?php include("./contents/new_coop.php") ?>

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