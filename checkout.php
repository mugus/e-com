
<!-- Header With css and Fonts Links Start -->
<?php
    include("./config/db.php");
    include("./includes/header.php");
?>
<!-- Header With CSS And Fonts Links End -->
<?php
$user_ip = $_SERVER['REMOTE_ADDR'];
$c_sql = "SELECT * FROM pending_cart pc 
        LEFT JOIN paintings pai ON pc.pid = pai.pid 
        WHERE pc.cart_code =  :cart_code";
 $c_stmt = $db->prepare($c_sql);
 $c_stmt->execute(array('cart_code'=>$user_ip));


// get total
 $s_sql = "SELECT *, SUM(pai.price * pc.qty) AS all_total, SUM(pc.qty) AS all_qty 
        FROM pending_cart pc 
        LEFT JOIN paintings pai ON pc.pid = pai.pid 
        WHERE pc.cart_code =  :cart_code";
 $s_stmt = $db->prepare($s_sql);
 $s_stmt->execute(array('cart_code'=>$user_ip));

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

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <form action="#" class="checkout__form">
                <div class="row">
                    <div class="col-lg-8">
                        <h5>Billing detail</h5>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>First Name <span>*</span></p>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Last Name <span>*</span></p>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="checkout__form__input">
                                    <p>Country <span>*</span></p>
                                    <input type="text">
                                </div>
                                <div class="checkout__form__input">
                                    <p>Town/City <span>*</span></p>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Phone <span>*</span></p>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Email <span>*</span></p>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="checkout__form__checkbox">
                                    <label for="acc">
                                        Create an acount?
                                        <input type="checkbox" id="acc" class="acc" name="acc" onchange="ShowPassField()" />
                                        <span class="checkmark"></span>
                                    </label>
                                    <p>Create am acount by entering the information below. If you are a returing
                                        customer login at the <br />top of the page</p>
                                    </div>
                                    <div class="checkout__form__input pass" style="display:none">
                                        <p>Account Password <span>*</span></p>
                                        <input type="text" id="password" class="pwd" name="pwd">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="checkout__order">
                                <h5>Your order</h5>
                                <div class="checkout__order__product">
                                    <ul>
                                        <li>
                                            <span class="top__text">Product</span>
                                            <span class="top__text__right">Total</span>
                                        </li>
                                        <?php 
                                            $i = 1;
                                            while($row = $c_stmt->fetch(PDO::FETCH_ASSOC)): 
                                                $sub_total = (int)$row['qty'] * (int)$row['price']
                                        ?>
                                            <li><?= $i ?>. <?= $row['name'] ?> (<i class="text-info"><?= $row['qty'] ?></i>) <span>Rwf <?= $sub_total ?></span></li>
                                        <?php $i++; endwhile ?>
                                    </ul>
                                </div>
                                <div class="checkout__order__total">
                                    <ul>
                                    <?php
                                        $res = $s_stmt->fetch();
                                        if($res['all_total'] > 50000){
                                            $delivery = (int)$res['all_total']*(8/100);
                                            $main_total = $res['all_total'] + $delivery;
                                        ?>
                                        <li>Sub Total <span>Rwf <?= $res['all_total'] ?></span></li>
                                        <li>Delivery <span>Rwf <?= $delivery ?></span></li>
                                        <li>Total <span>Rwf <?= $main_total ?></span></li>
                                        <?php 
                                        }else{
                                            $delivery = 7500;
                                            $main_total = $res['all_total'] + $delivery; 
                                        ?>
                                            <li>Sub Total <span>Rwf <?= $res['all_total'] ?></span></li>
                                            <li>Delivery <span>Rwf <?= $delivery ?></span></li>
                                            <li>Total <span>Rwf <?= $main_total ?></span></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="checkout__order__widget">
                                    <label for="check-payment">
                                        MoMo Payment
                                        <input type="checkbox" id="check-payment">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="paypal">
                                        PayPal (<small class="text-danger">Currently not available</small>)
                                        <input type="checkbox" id="paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="site-btn">Place oder</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- Checkout Section End -->

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