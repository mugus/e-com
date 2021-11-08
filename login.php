<?php 
include('./database/db.php');
session_start();

if(isset($_POST['login'])){
	$email = htmlspecialchars(strip_tags($_POST['email']));
	$password = htmlspecialchars(strip_tags($_POST['password']));
	$sql = "SELECT * FROM users WHERE email = :email";
	$stmt = $db->prepare($sql);
	$stmt->execute(array(':email' => $email));
	if($stmt->rowCount() > 0){
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		// Check if password match
    $status_code = $row['status_code'];

		if($status_code == 1){
      if(password_verify($password, $row['password'])){
        $user_role = $row['user_role'];
        $un_id = $row['un_id'];
     
        if($user_role == 1){
          $_SESSION['un_id']=$un_id;
          $_SESSION['user_role'] = $user_role;
          header("location: ./dashboard");
        }else if($user_role == 2){
          $_SESSION['un_id']=$un_id;
          $_SESSION['user_role'] = $user_role;
          header("location: ./dashboard/accountant.index.php");
        }else if($user_role == 3){
          $_SESSION['un_id']=$un_id;
          $_SESSION['user_role'] = $user_role;
          header("location: ./dashboard/warehouse.index.php");
        }else if($user_role == 4){
          $_SESSION['un_id']=$un_id;
          $_SESSION['user_role'] = $user_role;
          header("location: ./dashboard/admin.index.php");
        }else{
          // header("location: ./shop");
          $result = "<small>Your account is not allowed to shop. <br>Contact Ingabo PlantHealth Administration</small>";
          $alert = "alert-danger";
        }
      }else{
        $result = "<small>Password not match</small>";
        $alert = "alert-danger";
      }

    }else{
      $result = "<small>Account Not Verified</small>";
      $alert = "alert-danger";
    }

		
	}else{
		$result = "<small>Email not found</small>";
		$alert = "alert-danger";
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
    <title>Shop :: Ingabo HealthPlant</title>
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


    <?php include('./contents/login.php'); ?>


<?php include('./layouts/footer.php'); ?>