<?php 
include('./database/db.php');
session_start();
if(isset($_SESSION['new_pass'])){

if(isset($_POST['new_pass'])){
    $email = $_SESSION['new_pass'];
    $pass = htmlspecialchars(strip_tags($_POST['password']));
    $password = password_hash($pass, PASSWORD_DEFAULT);
    $un_id=$email.'-'.uniqid().''.uniqid().'-'.uniqid().'-'.uniqid().''.uniqid().''.uniqid().'-'.uniqid();

    $sql = "UPDATE users SET password = :password, un_id = :un_id WHERE email = :email";
    $stmt = $db->prepare($sql);
    $stmt->execute(
            array(
                ':email' => $email,
                ':un_id' => $un_id,
                ':password' => $password
                )
            );
    if($stmt->rowCount() > 0){
        echo "<script language='javascript'>";
        echo "if(!alert('Account password updated')){
          window.location.replace('./logout');
        }";
        echo "</script>";
    }else{
        $alert = "alert-danger";
        $result = "<small>Error!!!!!!  Email Expired</small>";
    }
}



// include('./layouts/header.php'); 
// include('./layouts/navbar.php');
 ?>
 <!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Ingabo HealthPlant</title>
    <meta name="description" content="description">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="./assets/images/logo.png"/>
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/css/plugins.css">
    <!-- Bootstap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
  </head>
  <body class="template-index belle template-index-belle">
    <div id="pre-loader">
        <img src="assets/images/loader.gif" alt="Loading..." />
    </div>
    <div class="pageWrapper">
      <!--Search Form Drawer-->
      <div class="search">
        <div class="search__form">
            <form class="search-bar__form" action="#">
                <button class="go-btn search__button" type="submit"><i class="icon anm anm-search-l"></i></button>
                <input class="search__input" type="search" name="q" value="" placeholder="Search entire store..." aria-label="Search" autocomplete="off">
            </form>
            <button type="button" class="search-trigger close-btn"><i class="anm anm-times-l"></i></button>
        </div>
      </div>
      <!--End Search Form Drawer-->

      <!--Top Header-->
      <div class="top-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-10 col-sm-8 col-md-5 col-lg-4">
              <p class="phone-no"><i class="anm anm-phone-s"></i> <a href="tel:+250 788 313 028"> (+250) 788 313 028</a></p>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 d-none d-lg-none d-md-block d-lg-block">
              <div class="text-center">
                <p class="top-header_middle-text"> Countrywide Express Shipping</p>
              </div>
            </div>
            <div class="col-2 col-sm-4 col-md-3 col-lg-4 text-right">
              <span class="user-menu d-block d-lg-none"><i class="anm anm-user-al" aria-hidden="true"></i></span>
              <ul class="customer-links list-inline">
                  <li><a href="./login">Login</a></li>
                  <li><a href="./register">Create Account</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!--End Top Header-->


    <?php include('./contents/new_pass.php'); ?>

<?php 
    include('./layouts/footer.php');
    }else{
        header("location: ../login");
    }
?>