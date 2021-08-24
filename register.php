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

include("./config/db.php");

  if(isset($_POST['RegisterUser'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$address = $_POST['address'];
		$gender = $_POST['gender'];
		$pass = $_POST['password'];
    $password = password_hash($pass, PASSWORD_DEFAULT);
    $code = rand(10, 2000);


		$sql = "INSERT INTO users (firstname, lastname, email, phone, address, gender, activate_code, password) 
						VALUES (:firstname, :lastname, :email, :phone, :address, :gender, :activate_code, :password)";
		$stmt = $db->prepare($sql);
		$stmt->execute(
			array(
				'firstname'=>$firstname,
				'lastname'=>$lastname,
				'email'=>$email,
				'phone'=>$phone,
				'address'=>$address,
				'gender'=>$gender,
				'activate_code'=>$code,
				'password'=>$password
			)
		);
		if($stmt->rowCount() > 0){
			$id = $db->lastInsertId();
        $to=$email;
        $time = time();
        $subject="Confirm your registration";
        $from = 'PSOMS';
        $headers = "MIME-Version: 1.0\r\n";
        $headers = "Content-Type: text/html; charset=UTF-8\r\n";
        $headers .= 'From: '.$from."\r\n".'Reply-To: '.$from."\r\n".'X-Mailer: PHP/' . phpversion();
        $message = '<html><body>';
        $message = "<center>";
        $message = "<h3>Hello $firstname,";
        $message = "Hope this email finds you well</h3>";
        $message .='<p>
                      It is great to have you!<br>
                      Your account will be activate for your future use,<br> 
                      Confirm with clicking this link
                    </p>';
        $message .= '<a class="btn btn-primary btn-sm" href="'.$_SERVER['HTTP_HOST'].'/verify.php?id='.$id.'&code='.$code.'">click here</a> ';
        $message .= '<p>
                      <br><br><br><br>
                      <small>
                        Subscribe to our News Letter  
                        <br>
                        <a class="btn btn-primary btn-sm" href="'.$_SERVER['HTTP_HOST'].'/ibimina/members/subscribe.php?id='.$id.'&code='.$code.'&email='.$email.'">subscribe</a> 
                      </small>
                    <p>';
        $message .= '<small>PSOMS Administrations</small>';
        $message = "</center>";
        $message .= '</body></html>';
        mail($to,$subject,$message,$headers);
			echo "<script>alert('Confirm Email');</script>";
		}else{
			echo "<script>alert('not added');</script>";
		}
	}
	
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
  <style>
		input[type="text"],input[type="file"],input[type="number"],input[type="password"], input[type="email"], #gender{
			height: 27px !important;
			font-size: 13px;
			color: #93757D;
		}
		::placeholder {
			font-size: 13px;
			color: #93757D;
		}
		label {
			font-size: 13px;
		}
		.site-btn {
			height: 30px !important;
			padding: 0px !important;
			width: 100px;
		}
		.footer__newslatter form button{
			top: 0px !important;
			right: 0px !important;
		}
		.input-group-text{
			height: 27px !important;
		}
	</style>
  <!-- ================ start banner area ================= -->	
	<section class="blog-banner-area" id="category">
		<div class="container h-100">
			<div class="blog-banner">
				<div class="text-center">
					<h1>Register</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Register</li>
            </ol>
          </nav>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->
  
  <!--================Login Box Area =================-->
	<section class="login_box_area section-margin">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<div class="hover">
							<h4>Already have an account?</h4>
							<p>There are advances being made in science and technology everyday, and a good example of this is the</p>
							<a class="button button-account" href="login.html">Login Now</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner register_form_inner">
						<h3>Create an account</h3>
						<form class="row login_form" method="POST" action="" onsubmit="return ValidateRegister();" >
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-6">
										<label class="form-label">*Name</label>
										<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Firstname" />
										<small class="text-danger" id="name_msg"></small>
									</div>
									<div class="col-md-6">
										<label class="form-label">*Surname</label>
										<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Lastname" />
									</div>
								</div>
							</div>

							<div class="col-md-12">
								<label class="form-label">*Email Address</label>
								<div class="position-relative input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<i class="fa fa-map"></i>
										</div>
									</div>
									<input type="email" class="form-control" id="email" name="email" placeholder="Email ....." required/>
								</div>
								<small class="text-danger" id="email_msg"></small>
              </div>
							<!-- <div class="col-md-12 form-group">
								<input type="file" id="photo" name="photo" />
							</div> -->
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4">
										<label class="form-label">*Phone Number</label>
										<div class="position-relative input-group">
											<div class="input-group-prepend">
												<div class="input-group-text">
													<i class="fa fa-phone"></i>
												</div>
											</div>
											<input type="number" class="form-control" id="phone" name="phone" placeholder="Phone Contact" />
										</div>
										<small class="text-danger" id="phone_msg"></small>
									</div>
									<div class="col-md-4">
										<label class="form-label">*Where You live</label>
										<div class="position-relative input-group">
											<div class="input-group-prepend">
												<div class="input-group-text">
													<i class="fa fa-map"></i>
												</div>
											</div>
											<input type="text" class="form-control" id="address" name="address" placeholder="Location" />
										</div>
										<small class="text-danger" id="location_msg"></small>
									</div>
									<div class="col-md-4">
									<label class="form-label">*Gender</label>
										<div class="position-relative input-group">
											<div class="input-group-prepend">
												<div class="input-group-text">
													<i class="fa fa-map"></i>
												</div>
											</div>
											<select name="gender" id="gender" class="form-control">
												<option value="" selected hidden>Choose Gender</option>
												<option value="Male">Male</option>
												<option value="Female">Female</option>
												<option value="Private">Rather not to say</option>
											</select>
										</div>
										<small class="text-danger" id="gender_msg"></small>
									</div>
								</div>
							</div>
              
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-6">
										<label class="form-label">*Password</label>
										<div class="position-relative input-group">
											<div class="input-group-prepend">
												<div class="input-group-text">
													<i class="fa fa-unlock-alt"></i>
												</div>
											</div>
											<input id="pwd" placeholder="Password here..." type="password"
												class="form-control" name="password">
										</div>
										<small id="pass_msg" class="text-danger"></small>
									</div>
									<div class="col-md-6">
										<label class="form-label">*Retype password</label>
										<div class="position-relative input-group form-group">
											<div class="input-group-prepend">
												<div class="input-group-text">
													<i class="fa fa-unlock-alt"></i>
												</div>
											</div>
											<input name="confirm_password" id="cpwd" placeholder="Repeat Password here..."
												type="password" class="form-control" >
										</div>
										<small id="cpwd_msg" class="text-danger"></small>
									</div>
									<small id="check"></small>
								</div>

							</div>

							<div class="col-md-12 form-group">
								<button type="submit" value="submit" name="RegisterUser" class="button button-register w-100">Register</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->



  <!--================ Start footer Area  & scripts =================-->	
  <?php 
      include('./includes/footer.php'); 
  ?>
	<!--================ End footer Area & scripts =================-->
<script>
	$(document).ready(function (){
		function ValidateRegister(e){
			e.preventDefault();
			if($("#firstname").val() === ''){
				$("#name_msg").html("Fill out firstname")
				$('#firstname').focus();
				return false;
			}else if($('#lastname').val() === ''){
				$("#name_msg").html("Fill out lastname");
				$('#lastname').focus();
				return false;
			}else if($('#email').val() === ''){
				$("#email_msg").html("Fill email field");
				$("#name_msg").html("")
				$('#email').focus();
				return false;
			}else if($('#phone').val() === ''){
				$("#phone_msg").html("Fill Phone Field");
				$("#email_msg").html("")
				$('#phone').focus();
				return false;
			}else if($('#phone').val().length != 10){
				$("#phone_msg").html("Phone Number must be 10 chars");
				$("#email_msg").html("")
				$('#phone').focus();
				return false;
			}else if($('#address').val() === ''){
				$("#location_msg").html("Fill Location");
				$("#phone_msg").html("")
				$('#address').focus();
				return false;
			}else if($('#gender').val() === ''){
				$("#gender_msg").html("Choose your gender");
				$("#location_msg").html("")
				$('#gender').focus();
				return false;
			}else if($('#pwd').val() === ''){
				$("#pass_msg").html("Fill This field");
				$("#location_msg").html("")
				$('#pwd').focus();
				return false;
			}else if($('#cpwd').val() === ''){
				$("#cpwd_msg").html("Fill This field");
				$("#pass_msg").html("")
				$('#cpwd').focus();
				return false;
			}else if($('#pwd').val() != $('#cpwd').val()){
				$("#pass_msg").html("Passwords not match");
				$("#cpwd_msg").html("")
				$('#pwd').focus();
				return false;
			}else{
				return true;
			}
			alert('Validation is ready');
		}
	});


</script>
</body>
</html>