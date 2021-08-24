<?php
include("../config/db.php");
?>
<?php if($_SESSION['admin']){ ?>

  <!DOCTYPE html>
  <html lang="en">
    <?php 
      include('includes/header.php');
    ?>

    <body>
      <div class="wrapper">
        <!-- sidebar start here -->
        <?php 
          include('includes/sidebar.php');
        ?>

        <!-- sidebar end here -->

        <div class="main">
          <!-- naviagtion bar start here -->
          <?php 
            include('includes/navbar.php');
          ?>

          <main class="content">
            <div class="container-fluid p-0">

              <h1 class="h3 mb-3">Settings</h1>

              <div class="row">
                <div class="col-md-3 col-xl-2">

                  <div class="card">
                    <div class="card-header">
                      <h5 class="card-title mb-0">Profile Settings</h5>
                    </div>

                    <div class="list-group list-group-flush" role="tablist">
                      <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account" role="tab">
              Account
            </a>
                      <a class="list-group-item list-group-item-action" data-toggle="list" href="#password" role="tab">
              Password
            </a>
                      <a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
              Privacy and safety
            </a>
                      <a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
              Email notifications
            </a>
                      <a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
              Web notifications
            </a>
                      <a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
              Widgets
            </a>
                      <a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
              Your data
            </a>
                      <a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
              Delete account
            </a>
                    </div>
                  </div>
                </div>

                <div class="col-md-9 col-xl-10">
                  <div class="tab-content">
                    <div class="tab-pane fade show active" id="account" role="tabpanel">

                      <div class="card">
                        <div class="card-header">

                          <h5 class="card-title mb-0">Public info</h5>
                        </div>
                        <div class="card-body">
                          <form>
                            <div class="row">
                              <div class="col-md-8">
                                <div class="form-group">
                                  <label for="inputUsername">Username</label>
                                  <input type="text" class="form-control" id="inputUsername" value="<?=$user['username'] ?>" placeholder="Username">
                                </div>
                                <div class="form-group">
                                  <!-- <label for="inputUsername">Biography</label>
                                  <textarea rows="2" class="form-control" id="inputBio" placeholder="Tell something about yourself">
                                    
                                  </textarea> -->
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="text-center">
                                  <?php $image = (!empty($user['image'])) ? '../Profiles/'.$user['image'] : '../Profiles/profile.png'; ?>
                                  <img src="<?= $image?>" alt="<?=$user['firstname'].' '.$user['lastname']?>" class="rounded-circle img-responsive mt-2" width="128" height="128" />
                                  <div class="mt-2">
                                    <span class="btn btn-primary"><i class="fas fa-upload"></i> Upload</span>
                                  </div>
                                  <small>For best results, use an image at least 128px by 128px in .jpg, .png or any format</small>
                                </div>
                              </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Save changes</button>
                          </form>

                        </div>
                      </div>

                      <div class="card">
                        <div class="card-header">

                          <h5 class="card-title mb-0">Private info</h5>
                        </div>
                        <div class="card-body">
                          <form>
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="inputFirstName">First name</label>
                                <input type="text" class="form-control" id="inputFirstName" placeholder="First name">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="inputLastName">Last name</label>
                                <input type="text" class="form-control" id="inputLastName" placeholder="Last name">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail4">Email</label>
                              <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                            </div>
                            <div class="form-group">
                              <label for="inputAddress">Address</label>
                              <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                            </div>
                            <div class="form-group">
                              <label for="inputAddress2">Address 2</label>
                              <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="inputCity">City</label>
                                <input type="text" class="form-control" id="inputCity">
                              </div>
                              <div class="form-group col-md-4">
                                <label for="inputState">State</label>
                                <select id="inputState" class="form-control">
                        <option selected>Choose...</option>
                        <option>...</option>
                      </select>
                              </div>
                              <div class="form-group col-md-2">
                                <label for="inputZip">Zip</label>
                                <input type="text" class="form-control" id="inputZip">
                              </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                          </form>

                        </div>
                      </div>

                    </div>
                    <div class="tab-pane fade" id="password" role="tabpanel">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">Password</h5>

                          <form>
                            <div class="form-group">
                              <label for="inputPasswordCurrent">Current password</label>
                              <input type="password" class="form-control" id="inputPasswordCurrent">
                              <small><a href="#">Forgot your password?</a></small>
                            </div>
                            <div class="form-group">
                              <label for="inputPasswordNew">New password</label>
                              <input type="password" class="form-control" id="inputPasswordNew">
                            </div>
                            <div class="form-group">
                              <label for="inputPasswordNew2">Verify password</label>
                              <input type="password" class="form-control" id="inputPasswordNew2">
                            </div>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                          </form>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </main>

          <footer class="footer">
            <div class="container-fluid">
              <div class="row text-muted">
                <div class="col-6 text-left">
                  <p class="mb-0">
                    <a href="index.php" class="text-muted"><strong>AdminKit Demo</strong></a> &copy;
                  </p>
                </div>
                <div class="col-6 text-right">
                  <ul class="list-inline">
                    <li class="list-inline-item">
                      <a class="text-muted" href="#">Support</a>
                    </li>
                    <li class="list-inline-item">
                      <a class="text-muted" href="#">Help Center</a>
                    </li>
                    <li class="list-inline-item">
                      <a class="text-muted" href="#">Privacy</a>
                    </li>
                    <li class="list-inline-item">
                      <a class="text-muted" href="#">Terms</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </footer>
        </div>
      </div>

      <script src="js/vendor.js"></script>
      <script src="js/app.js"></script>

    </body>

  </html>

<?php 
}else{
	header('Location: ../login.php');
	} 
	?>