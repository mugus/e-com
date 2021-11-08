<?php
// if(!isset($_SESSION['un_id'])){
//   $_SESSION['un_id'] = 0000;
// }
// Get loggedin user data
$u = "SELECT * FROM users c WHERE c.un_id = :un_id";
$users = $db->prepare($u);
$users->execute(
  array('un_id' => $_SESSION['un_id'])
);
$user = $users->fetch(PDO::FETCH_ASSOC);


// Get coop data
$coo = "SELECT * FROM cooperatives";
$coops = $db->prepare($coo);
$coops->execute(
  array('un_id' => $_SESSION['un_id'])
);
// $coop = $coops->fetch(PDO::FETCH_ASSOC);




// Get farmer data
$farm = "SELECT * FROM farmers";
$farmers = $db->prepare($farm);
$farmers->execute(
  array('un_id' => $_SESSION['un_id'])
);
// $farmer = $farmers->fetch(PDO::FETCH_ASSOC);





// get product
$sql_pro = "SELECT p.product_id,p.name,p.cat_id,cat.cat_name,p.descriptions,p.photo,p.creation_date
FROM products p 
LEFT JOIN categories cat ON cat.cat_id = p.cat_id";
$stmt_pro = $db->prepare($sql_pro);
$stmt_pro->execute();

// Get category
$sql_category = "SELECT * FROM categories";
$stmt_category = $db->prepare($sql_category);
$stmt_category->execute();


// get product for main cart
$sql_cart = "SELECT c.qty,c.cart_id,c.user_id,p.product_id,p.name,p.cat_id,cat.cat_name,ps.stock, ps.product_id, 
ps.id,ps.product_size,ps.price,ps.man_date,ps.exp_date,p.descriptions,p.photo,p.creation_date
FROM cart c 
LEFT JOIN products p ON c.product_id = p.product_id
LEFT JOIN products_size ps ON c.ps_id = ps.id
LEFT JOIN categories cat ON cat.cat_id = p.cat_id
WHERE c.user_id = :user_id AND c.coop_id = :coop_id";

$stmt_cart = $db->prepare($sql_cart);
$stmt_cart->execute(
  array(
    'user_id' => $_SESSION['un_id'],
    'coop_id' => $_SESSION['cooperative']
  )
);



// get product for nav cart
$sql_navcart = "SELECT c.qty,c.cart_id,c.user_id,p.product_id,p.name,p.cat_id,cat.cat_name,ps.stock, 
ps.product_id, ps.id,ps.product_size,ps.price, ps.man_date,ps.exp_date,p.descriptions,p.photo,p.creation_date
FROM cart c 
LEFT JOIN products p ON c.product_id = p.product_id
LEFT JOIN products_size ps ON c.ps_id = ps.id
LEFT JOIN categories cat ON cat.cat_id = p.cat_id
WHERE c.user_id = :user_id AND c.coop_id = :coop_id";

$stmt_navcart = $db->prepare($sql_navcart);
$stmt_navcart->execute(
  array(
    'user_id' => $_SESSION['un_id'],
    'coop_id' => $_SESSION['cooperative']
    )
);

$que = "SELECT SUM(c.qty*ps.price) AS cart_sum FROM cart c
          LEFT JOIN products_size ps ON c.ps_id = ps.id
          WHERE c.user_id = :user_id AND c.coop_id = :coop_id";
$stmt_sum = $db->prepare($que);
$stmt_sum->execute(
  array(
    'user_id' => $_SESSION['un_id'],
    'coop_id' => $_SESSION['cooperative']
    )
);
$c_sum = $stmt_sum->fetch(PDO::FETCH_ASSOC);

// remove cart item
if(isset($_POST['remove_cart'])){
  $cart = $_POST['cart_id'];
  $sql = "DELETE FROM cart WHERE cart_id = :cart_id";
  $stmt = $db->prepare($sql);
  $stmt->execute(
    array('cart_id' => $cart)
  );
  if($stmt->rowCount()==1){
    echo "<script language='javascript'>";
			echo "if(!alert('Cart updated')){
				window.location.replace('./cart');
			}";
			echo "</script>";
  }else{
      echo "<script language='javascript'>";
			echo "if(!alert('Error: Item Not Removed')){
				window.location.replace('./cart');
			}";
			echo "</script>";
  }

}


// Checkout
if(isset($_POST['place_order'])){
  // $qty = $_POST['qty'];

  $phone = $_POST['pay_phone'];
  $email = $_POST['email'];
  $currency = "RWF";
  $amount = $_POST['main_total'];
  $tx_ref =  uniqid().'d'.rand(100,316768).'0wio'.uniqid().'nj'.uniqid().'eu2'.rand(100,316768).'kkiz'.uniqid();
  $network = "MTN";
  $fullname = $_POST['fullname'];
  $coop_id = $_POST['coop_id'];

  // $fullname = $_POST['lastname'].' '.$_POST['firstname'];
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
  $sql = "INSERT INTO payments (tx_ref, fullname, phone, email, amount)
          VALUES(:tx_ref, :fullname, :phone, :email, :amount)";
    $stmt = $db->prepare($sql);
    $stmt->execute(
      array(
        'tx_ref'=>$tx_ref,
        'fullname'=>$fullname,
        'phone'=>$phone,
        'email'=>$email,
        'amount'=>$amount
      )
    );
    if($stmt->rowCount() == 1){
      // fill orders table
      $s = "SELECT user_id, product_id, qty, ps_id FROM cart WHERE user_id = :user_id";
      $car = $db->prepare($s);
      $car->execute(
        array(
          'user_id'=>$_SESSION['un_id']
        )
      );
      
      while($row = $car->fetch(PDO::FETCH_ASSOC)){
        $farmer_address = $_POST['farmer_address'];
        $farmer_phone = $_POST['farmer_phone'];
        $coop_address = $_POST['coop_address'];
        $coop_phone = $_POST['coop_phone'];
        $farmer_reg_no = $_POST['farmer_reg_no'];
        $sql = "INSERT INTO orders (user_id, product_id, qty, ps_id, coop_id, tx_ref, farmer_reg_no) 
                VALUES (:user_id, :product_id, :qty, :ps_id, :coop_id, :tx_ref, :farmer_reg_no)";
        $statement = $db->prepare($sql);
        $statement->bindValue(':user_id', $row['user_id']);
        $statement->bindValue(':qty', $row['qty']);
        $statement->bindValue(':product_id', $row['product_id']);
        $statement->bindValue(':ps_id', $row['ps_id']);
        $statement->bindValue(':coop_id', $coop_id);
        $statement->bindValue(':tx_ref', $tx_ref);
        $statement->bindValue(':farmer_reg_no', $farmer_reg_no);
        $statement->execute();

        if($statement->rowCount() > 0){
          // Update Stock in stock mgt
          $cur_sto = "SELECT id, stock, ps_id, coop_id FROM stock_mgt WHERE ps_id = :ps_id AND coop_id = :coop_id";
          $cur_stock = $db->prepare($cur_sto);
          $cur_stock->execute(
            array(
              'ps_id'=>$row['ps_id'],
              'coop_id'=>$_SESSION['cooperative']
            )
          );
          if($cur_stock->rowCount() > 0){
            $curr = $cur_stock->fetch(PDO::FETCH_ASSOC);
            $curre_st = (int)$curr['stock'];
            $new_st = $curre_st - (int)$row['qty'];
            $stoc = "UPDATE stock_mgt SET stock = :stock WHERE ps_id = :ps_id AND coop_id = :coop_id";
            $stock = $db->prepare($stoc);
            $stock->bindValue(':stock', $new_st);
            $stock->bindValue(':ps_id', $row['ps_id']);
            $stock->bindValue(':coop_id', $_SESSION['cooperative']);
            $stock->execute();


            // Update Stock in Product size stock

            $ps_sto = "SELECT id, stock FROM products_size WHERE id = :id";
            $ps_stock = $db->prepare($ps_sto);
            $ps_stock->execute(
              array(
                'id'=>$row['ps_id']
              )
            );
            $pro_size = $ps_stock->fetch(PDO::FETCH_ASSOC);
            $product_size_stock = (int)$pro_size['stock'] - (int)$row['qty'];


            $ps_st = "UPDATE products_size SET stock = :stock WHERE id = :id";
            $new_ps_stock = $db->prepare($ps_st);
            $new_ps_stock->bindValue(':stock', $product_size_stock);
            $new_ps_stock->bindValue(':id', $row['ps_id']);
            $new_ps_stock->execute();
            // remove cart items
            $sql = "DELETE FROM cart WHERE user_id = :user_id";
            $stmt = $db->prepare($sql);
            $stmt->execute(
              array(
                'user_id'=>$_SESSION['un_id']
              )
            );
            // if($stmt->rowCount() == 1){
          }else{
            echo "<script language='javascript'>";
            echo "if(!alert('No Stock for that product at the moment')){
              window.location.replace('./checkout');
            }";
            echo "</script>";
          }
            // $decoded = json_decode($resp, true);
            // $redirect = $decoded['meta']['authorization']['redirect'];
            // header('Location: '.$redirect);


        }else{
          echo "<script language='javascript'>";
          echo "if(!alert('Error')){
            window.location.replace('./checkout');
          }";
          echo "</script>";
        }
        // remove cart items
        $sql = "DELETE FROM cart WHERE user_id = :user_id";
        $stmt = $db->prepare($sql);
        $stmt->execute(
          array(
            'user_id'=>$_SESSION['un_id']
          )
        );
        // if($stmt->rowCount() == 1){
          $decoded = json_decode($resp, true);
          $redirect = $decoded['meta']['authorization']['redirect'];
          header('Location: '.$redirect);
          // header("location: ./shop.php");
          // $result = "<small>Your order placed.</small>";
          // $alert = "alert-success";
          // echo "if(!alert('order Placed')){
          //   window.location.replace('./checkout');
          // }";
          // echo "</script>";
          // echo "<script language='javascript'>";
        // }
      }
        // if($statement->rowCount() == 1){
    
        // }else{
        //   echo "<script language='javascript'>";
        //   echo "if(!alert('Error')){
        //     window.location.replace('./checkout');
        //   }";
        //   echo "</script>";
        // }
      }
  }






  // $user_id = $_POST['user_id'];
  // $product_id = $_POST['product_id'];
  // $qty = $_POST['qty'];
  // $tranaction_id = uniqid().''.rand(100,316768).''.uniqid();
  // $sql = "INSERT INTO sales (user_id, product_id, qty, tranaction_id)VALUES(:user_id, :product_id, :qty, :tranaction_id)";
  // $stmt = $db->prepare($sql);
  // $stmt->execute(
  //   array(
  //     'user_id'=>$user_id,
  //     'product_id'=>$product_id,
  //     'qty'=>$qty,
  //     'tranaction_id'=>$tranaction_id
  //   )
  // );
  // if($stmt->rowCount() == 1){
  //   echo "<script language='javascript'>";
  //       echo "if(!alert('order Placed')){
  //         window.location.replace('./checkout');
  //       }";
  //       echo "</script>";
  // }else{
  //   echo "<script language='javascript'>";
  //   echo "if(!alert('Error')){
  //     window.location.replace('./checkout');
  //   }";
  //   echo "</script>";
  // }
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Shop :: Ingabo HealthPlant</title>
    <meta name="description" content="description">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="./assets/images/logo.png"/>
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/css/plugins.css">
    <!-- Bootstap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- <link rel="stylesheet" href="assets/css/tabledata/jquery.dataTables.min.css"> -->
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" /> -->
 

  </head>
  <body class="template-index belle template-index-belle">
    <div id="pre-loader">
        <img src="assets/images/loader.gif" alt="Loading..." />
    </div>
    <style>
      .form-control{
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
                  <li><a href="./logout">Logout</a></li>
                <?php else: ?>
                  <li><a href="./login">Login</a></li>
                  <li><a href="./register">Create Account</a></li>
                <?php endif ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!--End Top Header-->