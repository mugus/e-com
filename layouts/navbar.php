<!--Header-->
<div class="header-wrap classicHeader animated d-flex">
  <div class="container-fluid">
    <div class="row align-items-center">
      <!--Desktop Logo-->
      <div class="logo col-md-2 col-lg-2 d-none d-lg-block">
        <a href="./dashboard">
          <!-- Ingabo PlantHealth -->
          <img src="assets/images/logo.jpg" alt="Ingabo PlantHealth" title="Ingabo PlantHealth" />
        </a>
      </div>
      <!--End Desktop Logo-->
      <div class="col-2 col-sm-3 col-md-3 col-lg-8">
        <div class="d-block d-lg-none">
          <button type="button" class="btn--link site-header__menu js-mobile-nav-toggle mobile-nav--open">
            <i class="icon anm anm-times-l"></i>
            <i class="anm anm-bars-r"></i>
          </button>
        </div>
        <!--Desktop Menu-->
        <nav class="grid__item" id="AccessibleNav">
          <!-- for mobile -->
          <ul id="siteNav" class="site-nav medium center hidearrow">
            <li class="lvl1 parent megamenu"><a href="./dashboard">Home <i class="anm anm-angle-down-l"></i></a></li>
            <li class="lvl1 parent megamenu"><a href="./shop">Shop <i class="anm anm-angle-down-l"></i></a></li>
            <li class="lvl1 parent dropdown"><a href="#">Cart <i class="anm anm-angle-down-l"></i></a>
              <ul class="dropdown">
                <li><a href="./cart" class="site-nav">Cart</a></li>
                <li><a href="./checkout" class="site-nav">Checkout</a></li>
              </ul>
            </li>
            <li class="lvl1"><a href="./faqs"><b>FAQs!</b> <i class="anm anm-angle-down-l"></i></a></li>
          </ul>
        </nav>
        <!--End Desktop Menu-->
      </div>
      <!--Mobile Logo-->
      <div class="col-6 col-sm-6 col-md-6 col-lg-2 d-block d-lg-none mobile-logo">
        <div class="logo">
          <a href="./">
            <img src="assets/images/logo.jpg" alt="Ingabo PlantHealth" title="Ingabo PlantHealth" />
          </a>
        </div>
      </div>
      <!--Mobile Logo-->
      <div class="col-4 col-sm-3 col-md-3 col-lg-2">
        <div class="site-cart">
          <a href="#;" class="site-header__cart" title="Cart">
            <i class="icon anm anm-bag-l"></i>
            <span id="CartCount" class="site-header__cart-count" data-cart-render="item_count">
              <?= $stmt_cart->rowCount() ?>
            </span>
          </a>
          <!--Minicart Popup-->
          <div id="header-cart" class="block block-cart">
            <?php if($stmt_navcart->rowCount() > 0): ?>
            <ul class="mini-products-list">
              <?php while($row = $stmt_navcart->fetch(PDO::FETCH_ASSOC)): ?>
              <li class="item">
                <a class="product-image" href="#">
                  <img src="./assets/images/products/<?= $row['photo'] ?>" alt="3/4 <?= $row['name'] ?>" title="" />
                </a>
                <div class="product-details">
                  <a data-id="<?= $row['cart_id'] ?>" data-toggle="modal" data-target="#Delete"
                    class="remove cart__remove"><i class="anm anm-times-l" aria-hidden="true"></i></a>
                  <a class="pName" href="./cart">
                    <?= $row['name'] ?><small class="text-info">(<?= $row['cat_name'] ?>)</small>
                  </a>
                  <div class="variant-cart">
                    <span class="text-muted">Size: </span> <?= $row['product_size'] ?>
                  </div>
                  <div class="wrapQtyBtn">
                    <div class="qtyField">
                      <span class="label">Qty:</span>
                      <input type="text" id="Quantity" name="quantity" value="<?= $row['qty'] ?>"
                        class="product-form__input qty" disabled>
                    </div>
                  </div>
                  <div class="priceRow">
                    <div class="product-price">
                      <span class="money">Rwf
                        <?= $row['price'] * $row['qty'] ?>
                      </span>
                    </div>
                  </div>
                </div>
              </li>
              <?php endwhile ?>

            </ul>
            <div class="total">
              <div class="total-in">
                <span class="label">Cart Subtotal:</span>
                <span class="product-price">
                  <span class="money">Rwf
                    <?= $c_sum['cart_sum'] ?>
                  </span>
                </span>
              </div>
              <div class="buttonSet text-center">
                <a href="./cart" class="btn btn-secondary btn--small">View Cart</a>
                <a href="./checkout" class="btn btn-secondary btn--small">Checkout</a>
              </div>
            </div>
            <?php else: ?>
              <div class="text-center">
                <h3 class="text-danger">Cart is empty</h3>
                <a href="./shop" class="btn">Shop Now</a>
              </div>
            <?php endif ?>
          </div>
          <!--EndMinicart Popup-->
        </div>
        <div class="site-header__search">
          <button type="button" class="search-trigger"><i class="icon anm anm-search-l"></i></button>
        </div>
      </div>
    </div>
  </div>
</div>
<!--End Header-->



<!--Mobile Menu-->
<div class="mobile-nav-wrapper" role="navigation">
  <div class="closemobileMenu text-info"><i class="icon anm anm-times-l pull-right"></i> Ingabo Shop</div>
  <ul id="MobileNav" class="mobile-nav">
    <li class="lvl1 parent megamenu"><a href="./shop">Shop </a></li>
    <li class="lvl1 parent dropdown"><a href="#">Cart <i class="anm anm-angle-down-l"></i></a>
      <ul class="dropdown">
        <li><a href="./cart" class="site-nav">Cart</a></li>
        <li><a href="./checkout" class="site-nav">Checkout</a></li>
      </ul>
    </li>
    <li class="lvl1"><a href="./faqs"><b>FAQs!</b></a></li>
  </ul>
</div>
<!--End Mobile Menu-->