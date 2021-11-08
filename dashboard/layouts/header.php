<?php
  // $total_price = 0;

// Get loggedin user data
$u = "SELECT * FROM users c WHERE c.un_id = :un_id";
$users = $db->prepare($u);
$users->execute(
  array('un_id' => $_SESSION['un_id'])
);
$user = $users->fetch(PDO::FETCH_ASSOC);


// Get farmers data
$farm = "SELECT * FROM farmers";
$farmers = $db->prepare($farm);
$farmers->execute();
// $user = $users->fetch(PDO::FETCH_ASSOC);

// get product
$sql_pro = "SELECT p.product_id,p.name,p.cat_id,cat.cat_name,ps.stock,ps.price,
                ps.man_date,ps.exp_date,p.descriptions,p.photo,p.creation_date
            FROM products p 
            LEFT JOIN categories cat ON cat.cat_id = p.cat_id
            LEFT JOIN products_size ps ON ps.product_id = p.product_id";
$stmt_pro = $db->prepare($sql_pro);
$stmt_pro->execute();

// get orders
$ord = "SELECT f.farmer_firstname,f.farmer_lastname,o.qty,o.farmer_address,o.coop_address,o.coop_phone, pmt.verified,pmt.amount,
            o.farmer_reg_no, p.name AS product_name, o.farmer_phone, ps.product_size, ps.price FROM orders o 
LEFT JOIN products p ON o.product_id = p.product_id
LEFT JOIN payments pmt ON o.tx_ref = pmt.tx_ref
LEFT JOIN farmers f ON o.farmer_reg_no = f.farmer_reg_no
LEFT JOIN products_size ps ON o.ps_id = ps.id WHERE o.user_id = :user_id";
$orders = $db->prepare($ord);
$orders->execute(
  array('user_id' => $_SESSION['un_id'])
);

// Get payments before
// $pay_sql = "SELECT * ,(SELECT COUNT(*) FROM orders o WHERE o.tx_ref = '615f0339beef3d1453740wio615f0339bef06nj615f0339bef0beu263115kkiz615f0339bef0e') AS items
//             FROM payments pa WHERE pa.tx_ref = '615f0339beef3d1453740wio615f0339bef06nj615f0339bef0beu263115kkiz615f0339bef0e'";
$pay_sql = "SELECT * FROM `payments` ORDER BY `payments`.`verified` ASC";
$pay_stmt = $db->prepare($pay_sql);
$pay_stmt->execute();


// Get category
$sql_category = "SELECT * FROM categories";
$stmt_category = $db->prepare($sql_category);
$stmt_category->execute();

  if(isset($_GET['tx_ref']) && isset($_GET['amount'])){

    $tx_ref = $_GET['tx_ref'];
    $SECKEY = 'FLWSECK-2cde244f7c45bb66be982d47559e3003-X';
    $amount = $_GET['amount'];
    $currency = "RWF";

    $query = array(
    "SECKEY" => $SECKEY,
    "txref" => $tx_ref
    );
    $data_string = json_encode($query);
            
    $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                              
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec($ch);

    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($response, 0, $header_size);
    $body = substr($response, $header_size);

    curl_close($ch);

    $resp = json_decode($response, true);

    $paymentStatus = $resp['data']['status'];
    $chargeResponsecode = $resp['data']['chargecode'];
    $chargeAmount = $resp['data']['amount'];
    $chargeCurrency = $resp['data']['currency'];

    if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount)  && ($chargeCurrency == $currency)) {
      // Give Value and return to Success page
      $sql = "UPDATE payments SET verified = '1' WHERE tx_ref = :tx_ref AND amount = :amount";
      $stmt = $db->prepare($sql);
      $stmt->execute(
        array(
          'tx_ref' => $tx_ref,
          'amount' => $amount
        )
      );
      if($stmt->rowCount() > 0){
        echo "<script>alert('Success');</script>";
      }

    }else{
        // Dont Give Value and return to Failure page
        echo "<script>alert('Payment is not yet made');</script>";
    }
    // echo $amount;
  }




// Ship the order
    if (isset($_GET['id'])) {
      // echo "ID :".$_GET['id'];
      $sql = "UPDATE payments p SET p.sales_status = 1 WHERE p.id = :id";
      $stmt = $db->prepare($sql);
      $stmt->execute(
        array(
          'id'=>$_GET['id']
        )
      );
      if($stmt->rowCount() > 0){
        echo "<script>alert('Order is added on Shipped orders');</script>";
      }
    }

?>
<!DOCTYPE html>
<html class="no-js" lang="en">

  <!-- belle/index.html   11 Nov 2019 12:16:10 GMT -->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Shop :: Ingabo HealthPlant</title>
    <meta name="description" content="description">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="../assets/images/logo.png"/>
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="../assets/css/plugins.css">
    <!-- Bootstap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

  </head>
  <body class="template-index belle template-index-belle">
    <div id="pre-loader">
      <span class="success">Loading...</span>
        <!-- <img src="../assets/images/loader.gif" alt="Loading..." /> -->
    </div>
    <style>
      input[type = 'date'], input[type = 'text'], input[type = 'file'], input[type = 'password'], input[type = 'number']{
        font-size: 12px!important; 
        height: 30px;
      }
    </style>
    <div class="pageWrapper">
      <!--Search Form Drawer-->
      <div class="search">
        <div class="search__form">
            <form class="search-bar__form" action="#">
                <button class="go-btn search__button" type="submit"><i class="icon anm anm-search-l"></i></button>
                <input class="search__input" type="search" name="q" value="" placeholder="Search entire store..." aria-label="Search" autocomplete="off">
            </form>
            <button type="button" class="search-trigger close-btn"><i class="anm anm-times-l"></i></button>
        </div>
      </div>
      <!--End Search Form Drawer-->

      <!--Top Header-->
      <div class="top-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-10 col-sm-8 col-md-5 col-lg-4">
              <p class="phone-no"><i class="anm anm-phone-s"></i> <a href="tel:+250 788 313 028"> (+250) 788 313 028</a></p>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 d-none d-lg-none d-md-block d-lg-block">
              <div class="text-center">
                <p class="top-header_middle-text"> Countrywide Express Shipping</p>
              </div>
            </div>
            <div class="col-2 col-sm-4 col-md-3 col-lg-4 text-right">
              <span class="user-menu d-block d-lg-none"><i class="anm anm-user-al" aria-hidden="true"></i></span>
              <ul class="customer-links list-inline">
                <?php if(isset($_SESSION['un_id'])): ?>
                  <li><a href="../logout">Logout</a></li>
                <?php else: ?>
                  <li><a href="../login">Login</a></li>
                  <li><a href="../register">Create Account</a></li>
                <?php endif ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!--End Top Header-->
