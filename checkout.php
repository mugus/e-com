
<!-- Header With css and Fonts Links Start -->
<?php
    include("./config/db.php");
    include("./includes/header.php");
?>
<!-- Header With CSS And Fonts Links End -->
<?php
// Get Products on cart
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


//  insert into cart by click on place order
if(isset($_POST['place_order'])){
    $qty = $_POST['qty'];

    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $currency = "RWF";
    $amount = $_POST['main_total'];
    $tx_ref = round(83,386932).'67rtfMDtgiukj'.round(2,56295).'uDM'.round(2,56295).'uyrRG'.round(2,562595);
    $network = "MTN";
    $fullname = $_POST['lastname'].' '.$_POST['firstname'];
    // $pid = $_POST['pid'];
    // $cart_id = $_POST['cart_id'];
    foreach($qty as $key => $value){
        $qty = $value;
        $pid = $_POST['pid'][$key];
        $cart_id = $_POST['cart_id'][$key];
        $delivery = $_POST['delivery'];
        
        $sql = "INSERT INTO cart (qty, pid, cart_id, delivery, phone) VALUES (:qty, :pid, :cart_id, :delivery, :phone)";
        $stmt = $db->prepare($sql);
        $stmt->execute(
            array(
                'qty' => $qty,
                'pid' => $pid,
                'cart_id' => $cart_id,
                'delivery' => $delivery,
                'phone' => $phone
            )
        );
        if($stmt->rowCount() > 0){
            $sql = "DELETE FROM pending_cart WHERE cart_code =  :cart_code";
            $stmt = $db->prepare($sql);
            $stmt->execute(array('cart_code'=>$user_ip));
        }else{
            echo "Not Inserted";
        }

    }
    $url = "https://api.flutterwave.com/v3/charges?type=mobile_money_rwanda";
    $data_array = array(
        'tx_ref' => $tx_ref,
        'currency' => $currency,
        'network' => $network,
        'fullname' => $fullname,
        'phone_number' => $phone,
        'email' => $email,
        'amount' => $amount
    );
    $data = http_build_query($data_array);
    $header = array(
        'Authorization: FLWSECK-2cde244f7c45bb66be982d47559e3003-X'
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

    $resp = curl_exec($ch);
    if($e = curl_error($ch)){
        echo $e;
    }else{
        $ins_sql = "INSERT INTO clients (fullname, phone_number, email, amount) VALUES (:fullname, :phone_number, :email, :amount)";
        $ins_stmt = $db->prepare($ins_sql);
        $ins_stmt->execute(
            array(
                'fullname' => $fullname,
                'phone_number' => $phone,
                'email' => $email,
                'amount' => $amount
                )
        );
        if($ins_stmt->rowCount() > 0){
            $decoded = json_decode($resp, true);
            $redirect = $decoded['meta']['authorization']['redirect'];
            header('Location: '.$redirect);
        }else{
            echo "Order Failed";
        }
        
    }
    curl_close($ch);



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

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <form action="" method="POST" class="checkout__form">
                <div class="row">
                    <div class="col-lg-8">
                        <h5>Billing detail</h5>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>First Name <span>*</span></p>
                                    <input type="text" name="firstname">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Last Name <span>*</span></p>
                                    <input type="text" name="lastname">
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
                                    <input type="number" class="form-control" name="phone" required />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Email <span>*</span></p>
                                    <input type="text" name="email" required />
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
                                            <input type="hidden" value="<?= $row['pid'] ?>" name="pid[]" name="pid">
                                            <input type="hidden" value="<?= $row['qty'] ?>" name="qty[]" name="qty">
                                            <input type="hidden" value="<?= $row['id'] ?>" name="cart_id[]" name="cart_id">
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
                                        <input type="hidden" value="<?= $delivery ?>" name="delivery" name="delivery">
                                        <input type="hidden" value="<?= $main_total ?>" name="main_total" name="main_total">

                                        <?php 
                                        }else{
                                            $delivery = 7500;
                                            $main_total = $res['all_total'] + $delivery;
                                        ?>
                                            <li>Sub Total <span>Rwf <?= $res['all_total'] ?></span></li>
                                            <li>Delivery <span>Rwf <?= $delivery ?></span></li>
                                            <li>Total <span>Rwf <?= $main_total ?></span></li>
                                            <input type="hidden" value="<?= $delivery ?>" name="delivery" name="delivery">
                                            <input type="hidden" value="<?= $main_total ?>" name="main_total" name="main_total">
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
                                <button type="submit" class="site-btn" name="place_order">Place oder</button>
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