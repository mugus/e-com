<?php
  session_start();
include('../database/db.php');

  if(isset($_SESSION['un_id']) AND $_SESSION['user_role'] == 1){





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
            <!-- <div class="hamburgs">
              <h1 class="open"><i class="fa fa-bars"></i></h1>
              <h1 class="close" style="display: none"><i class="fa fa-times"></i></h1>
            </div> -->
          <?php include("./layouts/sidebar.php") ?>

          </div>
          <div class="col-md-8 col-lg-9 col-sm-12">
          <?php if(isset($result)){
            echo "<div class='alert $alert alert-dismissable alert-sm' role='alert'>
                    <div class='alert-message'>
                    $result!
                    </div>
                  </div>";
                }
          ?>
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