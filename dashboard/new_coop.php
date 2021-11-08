<?php
  session_start();
  include('../database/db.php');

  if(isset($_SESSION['un_id'])){
  
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

   <!--Body Content-->
   <div id="page-content">
    	<!--Page Title-->
    	<div class="page section-header text-center">
        <div class="page-title">
          <div class="wrapper"><h1 class="page-width">Dashboard</h1></div>
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
          <?php include("./layouts/sidebar.php") ?>

          </div>
          <div class="col-md-8 col-lg-9 col-sm-12">
          
               <!-- tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"><b>Manage</b></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"><b>New Coop</b></a>
                </li>
              </ul><!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane active" id="tabs-1" role="tabpanel">
                  <?php include("./contents/coop_mgt.php") ?>
                </div>
                <div class="tab-pane" id="tabs-2" role="tabpanel">
                  <?php include("./contents/new_coop.php") ?>
                </div>
              </div>
              <!-- endtabs -->


          

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