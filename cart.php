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
        <h1 class="page-width">Your cart</h1>
      </div>
    </div>
  </div>
  <!--End Page Title-->

  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-8 col-lg-8 main-col">
        <form action="#" method="post" class="cart style2">
          <table>
            <thead class="cart__row cart__header">
              <tr>
                <th colspan="2" class="text-center">Product</th>
                <th class="text-center">Price</th>
                <th class="text-center">Quantity</th>
                <th class="text-right">Total</th>
                <th class="action">&nbsp;</th>
              </tr>
            </thead>
            <tbody>
             <div id="cart_content">
             <?php if($stmt_cart->rowCount() > 0): ?>
             <?php while($row = $stmt_cart->fetch(PDO::FETCH_ASSOC)): ?>
              <tr class="cart__row border-bottom line1 cart-flex border-top">
                <td class="cart__image-wrapper cart-flex-item">
                  <a href="#"><img class="cart__image" src="assets/images/products/<?= $row['photo'] ?>"
                      alt="<?= $row['name'] ?>"></a>
                </td>
                <td class="cart__meta small--text-left cart-flex-item">
                  <div class="list-view-item__title">
                    <a href="#"><?= $row['name'] ?> </a>
                  </div>

                  <div class="cart__meta-text">
                    Size: <?= $row['product_size'] ?><br>
                    Category: <?= $row['cat_name'] ?>
                  </div>
                </td>
                <td class="cart__price-wrapper cart-flex-item">
                  <span class="money">Rwf <?= $row['price'] ?></span>
                </td>
                <td class="cart__update-wrapper cart-flex-item text-right">
                  <div class="cart__qty text-center">
                    <div class="qtyField">
                      <a class="qtyBtn minus" data-id="<?= $row['cart_id'] ?>" href="javascript:void(0);"><i class="icon icon-minus"></i></a>
                      <input style="width: 60px!important;" class="cart__qty-input qty" type="text" name="qty" id="qty" value="<?= $row['qty'] ?>" pattern="[0-9]*" min="1">
                      <a class="qtyBtn plus" data-id="<?= $row['cart_id'] ?>" href="javascript:void(0);"><i class="icon icon-plus"></i></a>
                    </div>
                  </div>
                </td>
                <td class="text-right small--hide cart-price">
                  <div><span class="money">Rwf <?= $row['price'] * $row['qty'] ?></span></div>
                </td>
                <td class="text-center small--hide">
                  <a data-id="<?= $row['cart_id'] ?>" data-toggle="modal" data-target="#Delete" class="btn btn--secondary cart__remove"
                    title="Remove tem"><i class="icon icon anm anm-times-l"></i></a>
                </td>
              </tr>
              <?php endwhile ?>
              <?php else: ?>
                <tr class="cart__row border-bottom line1 cart-flex border-top">
                  <td class="cart__image-wrapper cart-flex-item text-center" colspan="4">
                    <h3 class="text-info">Cart is empty</h3>
                  </td>
                </tr>
              <?php endif ?>
             </div>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="6" class="text-left"><a href="./shop" class="btn--link cart-continue"><i
                      class="icon icon-arrow-circle-left"></i> Continue shopping</a></td>
              </tr>
            </tfoot>
          </table>

          <div class="currencymsg">We processes all orders in Rwf.</div>
          <hr>

        </form>
      </div>
      <div class="col-12 col-sm-12 col-md-4 col-lg-4 cart__footer">
        <div class="solid-border">
          <div class="row">
            <span class="col-12 col-sm-6 cart__subtotal-title"><strong>Subtotal</strong></span>
            <span class="col-12 col-sm-6 cart__subtotal-title cart__subtotal text-right"><span
                class="money">Rwf <?= $c_sum['cart_sum'] ?></span></span>
          </div>
          <div class="cart__shipping">Shipping &amp; taxes calculated at checkout</div>
          <p class="cart_tearm">
            <label>
              <input type="checkbox" name="tearm" id="cartTearm" class="checkbox" value="tearm" required="">
              I agree with the terms and conditions</label>
          </p>
          <a href="./checkout" id="cartCheckout" class="btn btn--small-wide checkout">Checkout</a>
        </div>

      </div>
    </div>
  </div>

</div>
<!--End Body Content-->












<?php 
include('./layouts/footer.php');
  }else{
    header("location: ../login");
  }
?>