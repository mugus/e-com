    <!--Body Content-->
    <div id="page-content" style="padding-top: 0px">
    	<!--Page Title-->
    	<div class="page section-header text-center">
        <div class="page-title">
          <div class="wrapper"><h1 class="page-width">Password Recovery</h1></div>
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
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="CustomerEmail">New Password</label>
                                    <input type="password" name="password" placeholder="**********" class="" autocorrect="off" autocapitalize="off" autofocus="">
                                </div>
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="CustomerEmail">Confirm Password</label>
                                    <input type="password" name="" placeholder="**********" class="" autocorrect="off" autocapitalize="off" autofocus="">
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
                                <input type="submit" class="btn mb-3 btn-small-wide" name="new_pass" value="Confirm" style="width:100%">
                                <p class="mb-4 text-left">
                                  <a href="./register" id="customer_register_link">Create New account</a>
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