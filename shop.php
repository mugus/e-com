
<?php 
include("./config/db.php");
include("./includes/header.php");?>
<!-- Header With CSS And Fonts Links End -->

<body>
    <!-- NavBar Section start -->
    <?php include("./includes/navbar.php");?>
    <!-- NavBar Section End -->
<?php

// Get all Tecnics in form
$te = "SELECT * FROM technics";
$technic = $db->prepare($te);
$technic->execute();

// Get All CAtegories
$sql = "SELECT * FROM category";
$cate = $db->prepare($sql);
$cate->execute();

// Print all paints
$pai = "SELECT p.pid AS pid, p.catid, p.name AS paint_name, p.price, p.status, p.vendorid, p.height, p.width, p.quantity, 
                p.photoid AS paintingPhoto, p.likes, p.madeDate, p.dateAdded,
                ve.phone AS vendor_phone, ve.address AS vendor_address, 
                ve.logo AS vendor_logo, ve.businessName, ve.email AS vendor_email 
        FROM paintings p
        LEFT JOIN vendor ve ON p.vendorid = ve.vendorid
        ORDER BY p.dateAdded DESC";
$paintings = $db->prepare($pai);
$paintings->execute();
// $res = $paintings->fetch(PDO::FETCH_ASSOC);
// print_r($res);


// Add to cart
if(isset($_POST['add'])){
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $code = rand(100, 313861);

    $stmt = $db->prepare("SELECT * FROM pending_cart WHERE cart_code = :cart_code AND pid= :pid");
    $stmt->execute(
        array(
            'pid'=> $_POST['pid'],
            'cart_code'=> $user_ip
        )
    );
    // $count = count($_SESSION['cart']);
    if($stmt->rowCount() > 0){
        $alert_class = "class='alert alert-Info alert-dismissible alert-sm text-center'";
        $result = "<small>Item is already on cart</small>";
    }else{
        $stmt = $db->prepare("INSERT INTO pending_cart (pid, cart_code) VALUES (:pid, :cart_code)");
        $stmt->execute(
            array(
                'pid'=> $_POST['pid'],
                'cart_code'=> $user_ip
            )
        );
    }



    // if(isset($_SESSION['cart'])){
    //     $item_array_id = array_column($_SESSION['cart'], "pid");
    //     if(in_array($_POST['pid'], $item_array_id)){
    //         echo "Item already in cart";
    //     }else{
            
           

    //         $item_array = array(
    //             'pid'=> $_POST['pid']
    //         );
    //         $_SESSION['cart'][$count] = $item_array;
    //     }
    // }else{
    //     $item_array = array(
    //         'pid'=> $_POST['pid']
    //     );
    //     // create new session
    //     $_SESSION['cart'][0] = $item_array;
    //     // print_r($_SESSION['cart']);
    // }
    // $pid = $_POST['pid'];
    // echo $pid;
}
// print_r($_SESSION['cart']);

?>

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.php"><i class="fa fa-home"></i> Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="shop__sidebar">
                        <div class="sidebar__categories">
                            <div class="section-title">
                                <h4>Categories</h4>
                            </div>
                            <div class="categories__accordion">
                                <div class="accordion" id="accordionExample">
                                    <?php 
                                        $i = 1;
                                        while($row = $cate->fetch(PDO::FETCH_ASSOC)): 
                                        extract($row);
                                    ?>
                                    <div class="card">
                                        <div class="card-heading">
                                            <a data-toggle="collapse" data-target="#collapseOne<?= $i ?>"><?= $name ?></a>
                                        </div>
                                        <div id="collapseOne<?= $i ?>" class="collapse" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <?php
                                                $category = $catid;
                                                $sql = "SELECT p.pid AS pid, p.catid, p.name AS paint_name, p.price, p.status, p.vendorid, p.height, p.width, p.quantity, p.photoid AS paintingPhoto, p.likes, p.madeDate, p.dateAdded,
                                                GROUP_CONCAT(DISTINCT pho.fileName ORDER BY pho.photoid SEPARATOR',') AS photo_name, pho.owner,
                                                ve.phone AS vendor_phone, ve.address AS vendor_address, 
                                                ve.logo AS vendor_logo, ve.businessName, ve.email AS vendor_email 
                                              FROM paintings p
                                              LEFT JOIN vendor ve ON p.vendorid = ve.vendorid
                                              LEFT JOIN photo pho ON p.photoid = pho.photoid
                                
                                              WHERE p.catid = :catid GROUP BY p.pid ORDER BY p.dateAdded DESC";
                                              $stmt = $db->prepare($sql);
                                              $stmt->execute(
                                                  array(
                                                    ':catid' => $category
                                                  )
                                              );
                                            ?>
                                                <ul>
                                                    <?php while($response = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                                    <li><a href="#"><?= $response['paint_name'] ?></a></li>
                                                    <?php endwhile ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $i++; endwhile ?>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__filter">
                            <div class="section-title">
                                <h4>Shop by price</h4>
                            </div>
                            <div class="filter-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                data-min="33" data-max="99"></div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <p>Price:</p>
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                            <a href="#">Filter</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    <small class="text-info msg"></small>
                    <?php 
                        if(isset($result)){
                            echo "<div ".$alert_class.">$result <a href='' class='btn-close btn-sm' data-dismiss='alert' aria-label='close'></a></div>"; 
                            }
                        ?>
                    <div class="row">
                        <?php while($res = $paintings->fetch(PDO::FETCH_ASSOC)): 
                            extract($res);
                        ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="img/shop/shop-1.jpg">
                                    <div class="label new">New</div>
                                    <ul class="product__hover">
                                        <li><a href="img/shop/shop-1.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>
                                        <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                        <li>
                                            <form action="" method="post">
                                                <input type="hidden" name="pid" value=<?= $pid ?>>
                                                <button type="submit" name="add" ><span class="icon_bag_alt"></span></button>
                                            </form>
                                            <!-- <button type="button" onclick="addCart('<?= $pid ?>')" ><span class="icon_bag_alt"></span></button> -->
                                        </li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#"><?= $paint_name ?></a></h6>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    
                                    <div class="product__price"><?= $price ?> Rwf</div>
                                </div>
                            </div>
                        </div>
                        <?php endwhile ?>
                        <div class="col-lg-12 text-center">
                            <div class="pagination__option">
                                <a href="#">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#"><i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->

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