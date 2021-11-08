<!--Body Content-->
<div id="page-content">
  <!--Page Title-->
  <div class="page section-header text-center">
    <div class="page-title">
      <div class="wrapper">
        <h1 class="page-width">Create New Account</h1>
      </div>
    </div>
  </div>
  <!--End Page Title-->

  <div class="container">
    <div class="row">

      <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
      <?php
        if(isset($result)){
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
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="firstname">Firstname</label>
                      <input type="text" name="firstname" placeholder="Eg: John" id="firstname" class=""
                        autocorrect="off" autocapitalize="off" autofocus="" required>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="lastname">Surname</label>
                      <input type="text" name="lastname" placeholder="Eg: Muhizi" id="lastname" class=""
                        autocorrect="off" autocapitalize="off" autofocus="" required>
                    </div> 
                  </div>
                </div>
                
              </div>

              <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" placeholder="Eg: johndoe@gmail.com" id="email" class="" autocorrect="off" autocapitalize="off" autofocus="" required>
                </div>
              </div>

              <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="address">Address</label>
                      <input type="text" name="address" placeholder="Eg: Kicukiro-Kigali" id="address" class=""
                        autocorrect="off" autocapitalize="off" autofocus="" required>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="phone_number">Phone Number</label>
                      <input type="text" name="phone_number" placeholder="Eg: 0787848876" id="phone_number" class=""
                        autocorrect="off" autocapitalize="off" autofocus="" required>
                    </div> 
                  </div>
                </div>
                
              </div>

              <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" value="" name="password" placeholder="*********" id="password" class="" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <input type="checkbox" name="terms" id="terms" required>
                  <label for="checkbox"> I agree to these <a target="_blank" href="./Termsandconditions.html">Terms and Conditions</a>.</label>
                   <!-- I Agree Terms & Coditions -->
                </div>

              </div>
            </div>
            <div class="row">
              <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
                <input type="submit" class="btn btn-block mb-3" name="add_user" value="Sign Up">
                <p class="mb-4">
                Already have Account? <a href="./login" id="RecoverPassword">Sign In</a>
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