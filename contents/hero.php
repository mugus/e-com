



<!--Collection Tab slider-->
<div class="tab-slider-product section">
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-12 col-lg-12">
        <div class="section-header text-center">
          <h2 class="h2">New Arrivals</h2>
          <p>Browse the huge variety of our products</p>
        </div>
        <div class="tabs-listing">
          <div class="tab_container">
            <div id="" class="tab_content grid-products">

              <div class="productSlider">
                <?php while($row = $stmt_pro->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="col-12 item">
                  <!-- start product image -->
                  <div class="product-image">
                    <!-- start product image -->
                    <a href="short-description.html">
                      <!-- image -->
                      <img class="primary blur-up lazyload" data-src="./assets/images/products/<?= $row['photo'] ?>"
                        src="./assets/images/products/<?= $row['photo'] ?>" alt="image" title="product">
                      <!-- End image -->
                      <!-- Hover image -->
                      <img class="hover blur-up lazyload" data-src="./assets/images/products/<?= $row['photo'] ?>"
                        src="./assets/images/products/<?= $row['photo'] ?>" alt="image" title="product">
                      <!-- End hover image -->
                    </a>
                    <!-- end product image -->

                    <!-- Start product button -->
                    <form class="variants add" action="#" onclick="window.location.href='./shop'" method="post">
                      <button class="btn btn-addto-cart" type="button" tabindex="0">Shop</button>
                    </form>
                    <div class="button-set">
                      <a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view"
                        data-toggle="modal" data-target="#content_quickview">
                        <i class="icon anm anm-search-plus-r"></i>
                      </a>
                    </div>
                    <!-- end product button -->
                  </div>
                  <!-- end product image -->

                  <!--start product details -->
                  <div class="product-details text-center">
                    <!-- product name -->
                    <div class="product-name">
                      <a href="short-description.html"><?= $row['name'] ?></a>
                    </div>
                    <!-- End product name -->
                    <!-- product price -->
                    <div class="product-price">
                      <span class="price">Rwf <?= $row['price'] ?></span>
                    </div>
                    <!-- End product price -->
                    <div class="product-review">
                      <i class="font-13 fa fa-star"></i>
                      <i class="font-13 fa fa-star"></i>
                      <i class="font-13 fa fa-star"></i>
                      <i class="font-13 fa fa-star"></i>
                      <i class="font-13 fa fa-star"></i>
                    </div>
                  </div>
                  <!-- End product details -->
                </div>
                <?php endwhile ?>
              </div>
            </div>




          </div>
        </div>
      </div>
    </div>
  </div>
</div>