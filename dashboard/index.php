<?php
  session_start();
  include('../database/db.php');

  if(isset($_SESSION['un_id'])){

?>


<?php include('./layouts/header.php'); ?>

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
          <div class="col-md-4 col-lg-3 col-sm-12" style="min-height: 410px!important; background-color: '1C1C1C'!important;">
            <?php include("./layouts/sidebar.php") ?>
          </div>
          <div class="col-md-8 col-lg-9 col-sm-12">
           <!-- tabs -->
           <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"><b>Manage Farmers</b></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"><b>Add New Farmer</b></a>
            </li>
          </ul><!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane active" id="tabs-1" role="tabpanel">
              <?php include("./contents/farmer_list.php") ?>
            </div>
            <div class="tab-pane" id="tabs-2" role="tabpanel">
              <?php include("./contents/new_farmer.php") ?>
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