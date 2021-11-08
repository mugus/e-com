<?php
  session_start();
  include('../database/db.php');

  if(isset($_SESSION['un_id']) AND $_SESSION['user_role'] == 4){
?>


<?php include('./layouts/header.php'); ?>

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
            <!-- <div class="hamburgs">
              <h1 class="open"><i class="fa fa-bars"></i></h1>
              <h1 class="close" style="display: none"><i class="fa fa-times"></i></h1>
            </div> -->
          <?php include("./layouts/sidebar.php") ?>

          </div>
          <div class="col-md-8 col-lg-9 col-sm-12">
              <?php include("./contents/promote_user.php") ?>
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