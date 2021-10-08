<?php
  session_start();
  if(isset($_SESSION['un_id']) AND isset($_SESSION['user_role'])){
include('./database/db.php');





// Add to cart
if(isset($_POST['add_cart'])){
  $product_id = htmlspecialchars(strip_tags($_POST['product_id']));
  $user_id = htmlspecialchars(strip_tags($_POST['un_id']));
  $qty = htmlspecialchars(strip_tags($_POST['qty']));
  $ps_id = htmlspecialchars(strip_tags($_POST['ps_id']));

  $sql = "SELECT * FROM cart WHERE user_id = :user_id AND product_id = :product_id AND ps_id = :ps_id";
  $stmt = $db->prepare($sql);
  $stmt->execute(
    array(
      'user_id' => $user_id,
      'product_id' => $product_id,
      'ps_id' => $ps_id
    )
  );
  if($stmt->rowCount() > 0){
    $result = "<small>Item already on cart</small>";
    $alert = "alert-danger";
  }else{
    $sql = "INSERT INTO cart (product_id, user_id, qty, ps_id) VALUES (:product_id, :user_id, :qty, :ps_id)";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':qty', $qty);
    $stmt->bindParam(':ps_id', $ps_id);
    $stmt->execute();
    if($stmt->rowCount() > 0){
      $result = "<small>Item added on your cart</small>";
			$alert = "alert-success";
    }else{
      $result = "<small>Not added</small>";
			$alert = "alert-danger";
    }
  }


}

include('./layouts/header.php'); ?>

<?php include('./layouts/navbar.php'); ?>

<!--Body Content-->
<div id="page-content">

    <div class="container" style="padding-top:100px">
        <div class="row">
            <!--Sidebar-->
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 sidebar filterbar">
                <div class="closeFilter d-block d-md-none d-lg-none"><i class="icon icon anm anm-times-l"></i></div>
                <div class="sidebar_tags">
                    <!--Categories-->
                    <div class="sidebar_widget categories filter-widget">
                        <div class="widget-title">
                            <h2>Categories</h2>
                        </div>
                        <div class="widget-content">
                            <ul class="sidebar_categories">
                                <?php while($row = $stmt_category->fetch(PDO::FETCH_ASSOC)): ?>
                                <li class="level1 sub-level"><a href="#;" class="site-nav">
                                        <?= $row['cat_name'] ?>
                                    </a>
                                    <ul class="sublinks">
                                        <?php
                      $id = $row['cat_id'];
                      $sq = "SELECT p.name,cat.cat_name
                            FROM products p
                            LEFT JOIN categories cat ON cat.cat_id = p.cat_id
                            WHERE cat.cat_id = :cat_id";
                      $stemt = $db->prepare($sq);
                      $stemt->execute(array('cat_id'=>$id));
                    ?>

                                        <?php foreach($stemt as $res): ?>
                                        <li class="level2"><a href="#;" class="site-nav">
                                                <?= $res['name'] ?>
                                            </a></li>
                                        <?php endforeach ?>
                                    </ul>
                                </li>
                                <?php endwhile ?>
                            </ul>
                        </div>
                    </div>
                    <!--Categories-->
                    <!--Banner-->
                    <div class="sidebar_widget static-banner">
                        <img src="assets/images/side-banner-2.jpg" alt="" />
                    </div>
                    <!--Banner-->
                </div>
            </div>
            <!--End Sidebar-->
            <!--Main Content-->
            <div class="col-12 col-sm-12 col-md-9 col-lg-9 main-col">
                <!-- <div class="category-description">
                    <h3>Category Description</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text.</p>
                </div> -->
                <hr>
                <div class="productList product-load-more">
                    <!--Toolbar-->
                    <button type="button" class="btn btn-filter d-block d-md-none d-lg-none"> Product Filters</button>
                    <div class="toolbar">
                        <div class="filters-toolbar-wrapper">
                            <div class="row">
                                <div
                                    class="col-4 col-md-4 col-lg-4 filters-toolbar__item collection-view-as d-flex justify-content-start align-items-center">
                                    <a href="shop-left-sidebar.html" title="Grid View"
                                        class="change-view change-view--active">
                                        <img src="assets/images/grid.jpg" alt="Grid" />
                                    </a>
                                    <a href="shop-listview.html" title="List View" class="change-view">
                                        <img src="assets/images/list.jpg" alt="List" />
                                    </a>
                                </div>
                                <div
                                    class="col-4 col-md-4 col-lg-4 text-center filters-toolbar__item filters-toolbar__item--count d-flex justify-content-center align-items-center">
                                    <span class="filters-toolbar__product-count">Showing:
                                        <?= $stmt_pro->rowCount() ?>
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--End Toolbar-->
                    <div class="grid-products grid--view-items">
                        <?php
                          if(isset($result)){
                            echo "<div class='alert $alert alert-dismissable alert-sm' role='alert'>
                                    <div class='alert-message'>
                                    $result!
                                    </div>
                                  </div>";
                                }
                          ?>
                        <div class="row">


                            <?php if($stmt_pro->rowCount() > 0): ?>
                            <?php 
                              while($row = $stmt_pro->fetch(PDO::FETCH_ASSOC)):
                                $si = "SELECT * FROM products_size c WHERE c.product_id = :product_id";
                                $sizes = $db->prepare($si);
                                $sizes->execute(
                                  array('product_id' => $row['product_id'])
                                );
                              ?>
                            <div class="col-md-4">
                              <form action="" method="post">
                                <input type="hidden" name="un_id" value="<?= $_SESSION['un_id'] ?>">
                                <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
                                <img src="./assets/images/products/<?= $row['photo'] ?>" alt="" width="100%"
                                    height="190">
                                <div class="product-details text-left">
                                    <hr>
                                    <label for="examplePassword" class=""><span class="text-danger">*</span>Fill
                                        Quantity => Select Product size</label>

                                    <div class="position-relative input-group form-group" style="width: 80%!important;">
                                        <div class="input-group-prepend">
                                            <div class="">
                                                <input class="form-control" type="number" name="qty" id="qty" value="1"
                                                    pattern="[0-9]*"
                                                    style="height:30px!important;width:70px;font-size:15px;" min="1"
                                                    title="Fill out number of Items">
                                            </div>
                                        </div>
                                        <select onchange="load_price()" name="ps_id" class="form-control" id="size"
                                            style="height:30px!important; padding-top:2px;font-size:15px;"
                                            title="Make size by your choice" required>
                                            <option value="" selected hidden>Select Size</option>
                                            <?php  while($response = $sizes->fetch(PDO::FETCH_ASSOC)): ?>
                                            <option value="<?= $response['id'] ?>">
                                                <?= $response['product_size'].' : '.$response['price'].' Rwf' ?>
                                            </option>
                                            <?php endwhile ?>
                                        </select>
                                    </div>

                                    <!-- product name -->
                                    <div class="product-name">
                                        <h3>
                                            <?= $row['name'] ?>
                                        </h3>
                                        <a href="#"></a>
                                    </div>
                                    <!-- End product name -->
                                    <!-- product price -->
                                    <div class="product-price">
                                        <b>Price :(<span class="price">Refer to size choosen</span>) </b>
                                    </div><br>
                                    <!-- End product price -->
                                    <button class="btn btn-addto-cart" name="add_cart" type="submit">Add To
                                        Cart</button>
                                    <hr>
                                </div>
                              </form>

                            </div>


                            <?php endwhile ?>
                            <?php else: ?>
                            <div class="text-center">
                                <h3 class="text-info">No Product found</h3>
                            </div>
                            <?php endif ?>


                        </div>
                    </div>
                </div>
                <div class="infinitpaginOuter">
                    <div class="infinitpagin">
                        <a href="#" class="btn loadMore">Load More</a>
                    </div>
                </div>
            </div>
            <!--End Main Content-->
        </div>
    </div>

</div>
<!--End Body Content-->

<?php 
include('./layouts/footer.php');
  }else{
    header("location: ./login");
  }
?>