<?php
include("./config/db.php");
?>
<?php 

  if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    //Query to check email in admin table
    $sqlAdmin = "SELECT * FROM admins WHERE email = :email";
    $adminstm = $db->prepare($sqlAdmin);
    $adminstm->execute(
      array(
        ':email' => $email
        )
      );
        $arow=$adminstm->fetch(PDO::FETCH_ASSOC);

    //Query to check email in dos table
    $sqlvendor = "SELECT * FROM vendor WHERE email = :email";
    $vstm = $db->prepare($sqlvendor);
    $vstm->execute(
      array(
        ':email' => $email
        )
      );
        $vrow=$vstm->fetch(PDO::FETCH_ASSOC);

      //Query to check email in deliverer table
      $sqldeliverer = "SELECT * FROM deliverer WHERE email = :email";
      $dstm = $db->prepare($sqldeliverer);
      $dstm->execute(
        array(
          ':email' => $email
          )
        );
        $drow=$dstm->fetch(PDO::FETCH_ASSOC);

      //Query to check email in users (customers) table
      $usersql = "SELECT * FROM users WHERE email = :email";
      $ustm = $db->prepare($usersql);
      $ustm->execute(
        array(
          ':email' => $email
          )
        );
        $urow=$ustm->fetch(PDO::FETCH_ASSOC);
        

        //Query to verify email in admin table
      if($adminstm->rowCount() > 0){
        if($password == $arow['password']){
          $_SESSION['admin']=$email;
          header("location: ./admin");
        }else{
          // echo "<script>alert('')</script>";
          $alert_class = "class='alert alert-danger alert-dismissible alert-sm text-center'";
          $result = "<small>Incorrect Password</small>";
        }
      }
      //Query to verify user account in vendor table for login purpose
      else if($vstm->rowCount() > 0){
        if($vrow['status'] == 'Activated'){
          if(password_verify($password, $vrow['password'])){
            $_SESSION['vendor']=$email;
            $_SESSION['vendorid']=$vrow['vendorid'];
            header('Location: ./dealer');
        }else{
          $alert_class = "class='alert alert-danger alert-dismissible alert-sm text-center'";
          $result = "<small>Incorrect Password</small>";
        }
      }else{
        $alert_class = "class='alert alert-danger alert-dismissible alert-sm text-center'";
        $result = "<small>Your account is temporary deactivated</small>";
      }
    }
      //Query to verify user account in deliverer table for login purpose
      else if($dstm->rowCount() > 0){
        if($drow['status'] == 'Activated'){
          if(password_verify($password, $drow['password'])){
            $_SESSION['deliverer']=$email;
            header('Location: ./deliverer');
        }else{
          $alert_class = "class='alert alert-danger alert-dismissible alert-sm text-center'";
          $result = "<small>Incorrect Password</small>";
        }
      }else{
        $alert_class = "class='alert alert-danger alert-dismissible alert-sm text-center'";
        $result = "<small>Your account is temporary deactivated</small>";
      }
    }
      //Query to verify user account in users table for login purpose
      else if($ustm->rowCount() > 0){
        if($urow['status'] == 'Activated'){
          if(password_verify($password, $urow['password'])){
            $_SESSION['customer']=$email;
            header('Location: ./cart.php');
        }else{
          $alert_class = "class='alert alert-danger alert-dismissible alert-sm text-center'";
          $result = "<small>Incorrect Password</small>";
        }
      }else{
        $alert_class = "class='alert alert-danger alert-dismissible alert-sm text-center'";
        $result = "<small>Your account is temporary deactivated</small>";
      }
    }else{
      // echo "<script>alert('Email not found')</script>";
      $alert_class = "class='alert alert-warning alert-dismissible alert-sm text-center'";
    $result = "<small>Invalid Email</small>";
    }
  }
      
  // echo "Login is working";

?>


<!DOCTYPE html>
<html lang="en">
    <?php 
        include('./includes/header.php'); 
    ?>
<body>

        <?php
          $home = 0; $about = 0;
          $shop = 0; $contact = 0;
          $account = 1;$blog = 0;
        ?>


  <!--================ Start Header Menu Area =================-->
	<header class="header_area">
    <div class="main_menu">
        <?php 
            include('./includes/navbar.php'); 
        ?>
      
    </div>
  </header>
	<!--================ End Header Menu Area =================-->
  
  <!-- ================ start banner area ================= -->	
	<section class="blog-banner-area" style="height:150px" id="category">
		<!-- <div class="container h-100"> -->
			<div class="blog-banner">
				<div class="text-center">
					<h1>Login / Register</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Login/Register</li>
            </ol>
          </nav>
				</div>
			</div>
    <!-- </div> -->
	</section>
	<!-- ================ end banner area ================= -->
  
  <!--================Login Box Area =================-->
	<section class="login_box_area section-margin">
		<div class="container">
        
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<div class="hover">
							<h4>New to our website?</h4>
							<p>There are advances being made in science and technology everyday, and a good example of this is the</p>
							<a class="button button-account" href="./register.php">Create an Account</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
        <div class="row ">           
          <div class="col-md-12">
            <?php 
              if(isset($result)){
                  echo "<div ".$alert_class.">$result <a href='login.php' class='btn-close btn-sm' data-dismiss='alert' aria-label='close'></a></div>"; 
                } else if(isset($_SESSION['alertResult'])){
                  echo "<div ".$_SESSION['alertClass'].">".$_SESSION['alertResult']." <a href='logout.php' class='btn-close btn-sm' data-dismiss='alert' aria-label='close'></a></div>"; 
                }
            ?>
          </div>
          <!-- </p> -->
          <hr>
      </div>
					<div class="login_form_inner">
						<h3>Log in to enter</h3>
						<form class="row login_form"  method="POST" action="login.php" id="contactForm" >
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="username" name="email" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
							</div>
							<div class="col-md-12 form-group">
								<div class="creat_account">
									<input type="checkbox" id="f-option2" name="selector">
									<label for="f-option2">Keep me logged in</label>
								</div>
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" name="login" class="button button-login w-100">Log In</button>
								<a href="#">Forgot Password?</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->



  <!--================ Start footer Area  =================-->	
  <?php 
      include('./includes/footer.php'); 
  ?>
</body>
</html>