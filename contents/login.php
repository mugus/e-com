    <!--Body Content-->
    <div id="page-content" style="padding-top: 0px">
    	<!--Page Title-->
    	<div class="page section-header text-center">
        <div class="page-title">
          <div class="wrapper"><h1 class="page-width">Sign in To shop</h1></div>
        </div>
      </div>
        <!--End Page Title-->
        
        <div class="container">
        	<div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
                <?php if(isset($result)){
                  echo "<div class='alert $alert alert-dismissable alert-sm' role='alert'>
                          <div class='alert-message'>
                          $result!
                          </div>
                        </div>";
                      }
                ?>
                	<div class="mb-4">
                       <form method="post" action="" id="CustomerLoginForm" accept-charset="UTF-8" class="contact-form">	
                          <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="CustomerEmail">Email</label>
                                    <input type="email" name="email" placeholder="" id="CustomerEmail" class="" autocorrect="off" autocapitalize="off" autofocus="">
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="CustomerPassword">Password</label>
                                    <input type="password" value="" name="password" placeholder="" id="CustomerPassword" class="">                        	
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
                                <input type="submit" style="width: 100%!important;" class="btn mb-3 btn-small" name="login" value="Sign In">
                                <p class="mb-4">
                                  <a href="./forget_password.php" id="RecoverPassword">Forgot your password?</a> &nbsp; | &nbsp;
                                  <a href="./register" id="customer_register_link">Create account</a>
                                </p>
                            </div>
                         </div>
                     </form>
                    </div>
               	</div>
            </div>
        </div>
        
    </div>
    <!--End Body Content-->