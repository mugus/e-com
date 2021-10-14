<?php
session_start();

include('./database/db.php');
if(isset($_SESSION['un_id']) AND $_SESSION['user_role'] == 1){




include('./layouts/header.php'); 
include('./layouts/navbar.php');
?>



<!--Body Content-->
<div id="page-content" style="padding-top:40px">
  <!--Page Title-->
  <div class="page section-header text-center">
    <div class="page-title">
      <div class="wrapper">
        <h1 class="page-width">Checkout</h1>
      </div>
    </div>
  </div>
  <!--End Page Title-->

  <div class="container">

    <form method="POST" action="">
    <div class="row billing-fields">

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 sm-margin-30px-bottom">
          <div class="create-ac-content bg-light-gray padding-20px-all">

            <fieldset>
              <h2 class="login-title mb-3">Shipping details</h2>

              <div class="row">
                <div class="form-group col-md-12 col-lg-12 col-xl-12 required">
                  <label for="input-firstname">Select Coop to Checkout <span class="required-f">*</span></label>
                  <select name="coop_id" id="coop_opt" onchange="load_coop_info()" required>
                    <option value="">Choose Coop</option>
                    <?php while($row = $coops->fetch(PDO::FETCH_ASSOC)): ?>
                      <option value="<?= $row['coop_id'] ?>"><?= $row['coop_name'].' ('.$row['district'].'->'.$row['sector'].'->'.$row['cell'].')' ?></option>
                    <?php endwhile ?>
                  </select>
                  <!-- coop output -->
                  <div class="row coop_data">
                    
                  </div>
                  <!--end coop output -->
                </div>
              </div>

              <!-- Farmer to collect load -->
              <div class="row">
                <div class="form-group col-md-12 col-lg-12 col-xl-12 required">
                  <label for="input-firstname">Select Farmer to Checkout <span class="required-f">*</span></label>
                  <select name="farmer_opt" id="farmer_opt" onchange="load_farmer_info()" required>
                    <option value="">Choose Farmer</option>
                    <?php while($row = $farmers->fetch(PDO::FETCH_ASSOC)): ?>
                      <option value="<?= $row['farmer_id'] ?>"><?= $row['farmer_reg_no'].". ".$row['farmer_lastname']." ".$row['farmer_firstname']." (".$row['district']."->".$row['sector'].")" ?></option>
                    <?php endwhile ?>
                  </select>
                  <!-- coop output -->
                  <div class="row farmer_data">
                    
                  </div>
                  <!--end coop output -->
                </div>
              </div>


              <h2>Order proccessed by:</h2>
              <div class="row">
                <div class="form-group col-md-12 col-lg-12 col-xl-12">
                  <p><span class="text-muted">Sales agent : </span> <span class="text-primary"><?= $user['lastname'].' '.$user['firstname'] ?></span></p>
                  <p><span class="text-muted">Phone N<sup>o</sup> :</span> <span class="text-primary"><?= $user['phone_number'] ?></span></p>
                  <p><span class="text-muted">Email : </span> <span class="text-primary"><?= $user['email'] ?></span></p>
                </div>
              </div>


                  <input name="firstname" value="" type="hidden">
                  <input name="lastname" value="<?= $user['lastname'] ?>" id="lastname" type="hidden">
                  <input name="telephone" value="<?= $user['phone_number'] ?>" id="telephone" type="hidden">
                  <input name="email" value="<?= $user['email'] ?>" id="email" type="hidden">
            </fieldset>
<hr>
            <fieldset>
              <div class="row">
                <div class="form-group col-md-12 col-lg-12 col-xl-12 required">
                  <label for="pay_phone">Confirm Phone N<sup>o</sup> for Payment <span class="text-danger">*</span></label>
                  <input name="pay_phone" placeholder="Eg: 0787848876" id="pay_phone" type="number" required>
                </div>
              </div>
            </fieldset>

            <div class="order-button-payment">
              <button class="btn" value="Place order" name="place_order" type="submit">Place order</button>
            </div>
          </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
          <div class="your-order-payment">
            <div class="your-order">
              <h2 class="order-title mb-4">Your Order Summary</h2>

              <div class="table-responsive-sm order-table">
                <table class="bg-white table table-bordered table-hover text-center">
                  <thead>
                    <tr>
                      <th class="text-left">Product Name</th>
                      <th>Price</th>
                      <th>Qty</th>
                      <th>Subtotal</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while($row = $stmt_cart->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                      <td class="text-left">
                        <?= $row['name'] ?>
                      </td>
                      <td>Rwf
                        <?= $row['price'] ?>
                      </td>
                      <td>
                        <?= $row['qty'] ?>
                      </td>
                      <td>Rwf
                        <?= $row['price'] * $row['qty'] ?>
                      </td>
                    </tr>
                    <input type="hidden" name="user_id" value="<?= $_SESSION['un_id'] ?>">
                    <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
                    <input type="hidden" name="qty" value="<?= $row['qty'] ?>">
                    <?php endwhile ?>
                  </tbody>
                  <tfoot class="font-weight-600">
                    <tr>
                      <td colspan="3" class="text-right">Shipping</td>
                      <td class="text-success">Free</td>
                    </tr>
                    <tr>
                      <td colspan="3" class="text-right">Total</td>
                      <td>Rwf
                        <?= $c_sum['cart_sum'] ?>
                        <input type="hidden" name="main_total" value="<?= $c_sum['cart_sum'] ?>">
                      </td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>

            <hr />

            <div class="your-payment">
              <h2 class="payment-title mb-3">payment method</h2>
              <div class="payment-method">
                <div class="payment-accordion">
                  <div id="accordion" class="payment-section">

                    <div class="card mb-2">
                      <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">Momo Payment</a>
                      </div>
                      <div id="collapseTwo" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                          <p class="no-margin font-15">Please generate collectly your phone number, make sure you start
                            number with <strong>078*********</strong> .</p>
                        </div>
                      </div>

                    </div>

                  </div>
                </div>


              </div>
            </div>
          </div>
        </div>
        
      </div>
    </form>

  </div>

</div>
<!--End Body Content-->

<?php 
include('./layouts/footer.php');
}else{
  header("location: ../login");
}
?>