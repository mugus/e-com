<?php 
include('./database/db.php');
session_start();

if(isset($_POST['requset_new_pass'])){
    $email = htmlspecialchars(strip_tags($_POST['email']));
    
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $db->prepare($sql);
    $stmt->execute(array('email' => $email));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $ver_code = $row['un_id'];
    $firstname = $row['firstname'];
    $EmailLength = strlen($email);
    $maxChar = 14;
    $resi = substr_replace($email, ' ........ ', $maxChar/7, $EmailLength-$maxChar);
	if($stmt->rowCount() > 0){
        // Send Verification email
        // $verify ='ver'.$ver_code.'fy'.$email;
        $to=$email;
        $time = time();
        $subject="Recover your account";
        $from = 'mail@ingabo.store';
        $headers = "MIME-Version: 1.0\r\n";
        $headers = "Content-Type: text/html; charset=UTF-8\r\n";
        $headers .= 'From: '.$from."\r\n".'Reply-To: '.$from."\r\n".'X-Mailer: PHP/' . phpversion();
        $message = '<html><body>';
        $message .= "<h3>Hi $firstname! </h3><br>";
        $message .= "Trust this email finds you well!!!";
        $message .='<div>
                    Thank you for registering to <b>ingabo webshop</b>!<br>
                    To update your password please verify your account by click on this link.<br>
                    </div>';
        $message .= '<a class="btn btn-primary btn-sm" href="https://'.$_SERVER['HTTP_HOST'].'/verify.php?un_code='.$ver_code.'">Click here to Confirm</a>';

        $message .= '<br><br><br><br><br><br><br><small>Ingabo PlantHealth Administrations <br>Call us on: +250 788 313 028</small>';
        $message .= '</body></html>';
        // mail($to,$subject,$message,$headers);
        
        $success = mail($to,$subject,$message,$headers);
        if (!$success) {
            // $errorMessage = error_get_last()['message'];
            $alert = "alert-danger";
            $result = "<small>Email Not Sent</small>";
        }else{
            $alert = "alert-success";
            $result = "<small>Email sent successfully! Confirm your email at <b>$resi</b></small>";
        }
        
        
    }else{
        echo "Not Ready";
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


    <?php include('./contents/forget_pass.php'); ?>


<?php include('./layouts/footer.php'); ?>