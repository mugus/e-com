
<?php 
include("./config/db.php");
include("./includes/header.php");?>
<!-- Header With CSS And Fonts Links End -->
<?php
$user_ip = $_SERVER['REMOTE_ADDR'];
$s_sql = "SELECT *, SUM(pai.price * pc.qty) AS all_total, SUM(pc.qty) AS all_qty 
        FROM pending_cart pc 
        LEFT JOIN paintings pai ON pc.pid = pai.pid 
        WHERE pc.cart_code =  :cart_code";
 $s_stmt = $db->prepare($s_sql);
 $s_stmt->execute(array('cart_code'=>$user_ip));


//  Delete item on cart
if(isset($_GET['pen_id'])){
    $sql = "DELETE FROM pending_cart WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->execute(array('id'=>$_GET['pen_id']));
}

?>
<body>
    <!-- NavBar Section start -->
    <?php include("./includes/navbar.php");?>
    <!-- NavBar Section End -->

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.php"><i class="fa fa-home"></i> Home</a>
                        <span>Shopping cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Cart Section Begin -->
    <section class="shop-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="tablecontent">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <?php
                        $subtotal = 0;
                        $total = 0;
                    ?>
                        
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn">
                        <a href="./shop.php">Continue Shopping</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="discount__content">
                        <h6>Discount codes</h6>
                        <form action="#">
                            <input type="text" placeholder="Enter your coupon code">
                            <button type="submit" class="site-btn">Apply</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-2">
                    <div class="cart__total__procced">
                        <h6>Cart total</h6>
                        <div class="data">
                            <?php
                            $res = $s_stmt->fetch();
                            if($res['all_total'] > 50000){
                                $delivery = (int)$res['all_total']*(8/100);
                                $main_total = $res['all_total'] + $delivery;
                            ?>
                            <ul>
                                <li>Quantities <span><?= $res['all_qty'] ?> Items</span></li>
                                <li>Subtotal <span> <i class='sub'><?= number_format(sprintf("%.2f", $res['all_total'])) ?></i> Rwf</span></li>
                                <li>Delivery <span> <i class='delivery'></i><?= number_format(sprintf("%.2f", $delivery)) ?> Rwf</span></li>
                                <li>Total <span> <i class='mainTotal'><?= number_format($main_total) ?></i>  Rwf</span></li>
                            </ul>
                            <?php 
                            }else{
                                $delivery = 7500;
                                $main_total = $res['all_total'] + $delivery; 
                            ?>
                            <ul>
                                <li>Quantities <span><?= $res['all_qty'] ?> Items</span></li>
                                <li>Subtotal <span> <i class='sub'><?= number_format(sprintf("%.2f", $res['all_total'])) ?></i> Rwf</span></li>
                                <li>Delivery <span> <i class='delivery'></i><?= number_format(sprintf("%.2f", $delivery)) ?> Rwf</span></li>
                                <li>Total <span> <i class='mainTotal'><?= number_format($main_total) ?></i>  Rwf</span></li>
                            </ul>
                            <?php } ?>
                            
                        </div>
                        <a href="#" id="checkout" class="primary-btn">Proceed to checkout</a>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Cart Section End -->

    <!-- Instagram Begin -->
    <div class="instagram">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="img/instagram/insta-1.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="img/instagram/insta-2.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="img/instagram/insta-3.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="img/instagram/insta-4.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="img/instagram/insta-5.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="img/instagram/insta-6.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Instagram End -->

    <!-- Footer and Scripts Begin -->
      <?php include("./includes/footer.php");?>
    <!-- Footer and Scripts End here -->
</body>

</html>