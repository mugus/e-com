<!-- Modal -->
<div class="modal fade" id="Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" method="post">
        <div class="modal-body">
          <h4>You are about to remove <span id="name"></span> on your cart?</h4>
          <h5>Summary</h5>
          <p>1. <span class="text-muted">Product name: </span><span class="text-primary" id="names"></span></p>
          <p>2. <span class="text-muted">Product price: </span><span class="text-primary">Rwf </span><span class="text-primary" id="price"></span><small>(each)</small></p>
        </div>
        <input type="hidden" name="cart_id" id="cart_id">
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="remove_cart" class="btn btn-primary">Confirm delete</button>
        </div>
      </form>
    </div>
  </div>
</div>








<!--Footer-->
<footer id="footer">
  <div class="newsletter-section">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-7 w-100 d-flex justify-content-start align-items-center">
          <div class="display-table">
            <div class="display-table-cell footer-newsletter">
              <div class="section-header text-center">
                <label class="h2"><span>sign up for </span>newsletter</label>
              </div>
              <form action="#" method="post">
                <div class="input-group">
                  <input type="email" class="input-group__field newsletter__input" name="EMAIL" value=""
                    placeholder="Email address" required="">
                  <span class="input-group__btn">
                    <button type="submit" class="btn newsletter__submit" name="commit" id="Subscribe"><span
                        class="newsletter__submit-text--large">Subscribe</span></button>
                  </span>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-5 d-flex justify-content-end align-items-center">
          <div class="footer-social">
            <ul class="list--inline site-footer__social-icons social-icons">
              <li><a class="social-icons__link" href="#" target="_blank"
                  title="Belle Multipurpose Bootstrap 4 Template on Facebook"><i class="icon icon-facebook"></i></a>
              </li>
              <li><a class="social-icons__link" href="#" target="_blank"
                  title="Belle Multipurpose Bootstrap 4 Template on Twitter"><i class="icon icon-twitter"></i> <span
                    class="icon__fallback-text">Twitter</span></a></li>
              <li><a class="social-icons__link" href="#" target="_blank"
                  title="Belle Multipurpose Bootstrap 4 Template on LinkedIn"><i class="icon icon-linkedin"></i> <span
                    class="icon__fallback-text">LinkedIn</span></a></li>
              <li><a class="social-icons__link" href="#" target="_blank"
                  title="Belle Multipurpose Bootstrap 4 Template on Instagram"><i class="icon icon-instagram"></i> <span
                    class="icon__fallback-text">Instagram</span></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="site-footer">
    <div class="container">
      <!--Footer Links-->
      <div class="footer-top">
        <div class="row">
          <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
            <h4 class="h4">Quick Shop</h4>
            <ul>
              <li><a href="#">MillMax 720WP</a></li>
              <li><a href="#">CopperMax 770WP</a></li>
              <li><a href="#">JackMax</a></li>
              <li><a href="#">GliderMax</a></li>
              <li><a href="#">Romaxtyn</a></li>
            </ul>
          </div>
          <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
            <h4 class="h4">Informations</h4>
            <ul>
              <li><a href="#">About us</a></li>
              <li><a href="#">Careers</a></li>
              <li><a href="#">Privacy policy</a></li>
              <li><a href="#">Terms &amp; condition</a></li>
              <li><a href="./login.php">My Account</a></li>
            </ul>
          </div>
          <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
            <h4 class="h4">Customer Services</h4>
            <ul>
              <li><a href="#">Request Personal Data</a></li>
              <li><a href="#">FAQ's</a></li>
              <li><a href="#">Contact Us</a></li>
              <li><a href="#">Orders and Returns</a></li>
              <li><a href="#">Support Center</a></li>
            </ul>
          </div>
          <div class="col-12 col-sm-12 col-md-3 col-lg-3 contact-box">
            <h4 class="h4">Contact Us</h4>
            <ul class="addressFooter">
              <li><i class="icon anm anm-map-marker-al"></i>
                <p>P.O. Box 65,<br> North western Province Musanze Postal Office, Rwanda</p>
              </li>
              <li class="phone"><i class="icon anm anm-phone-s"></i>
                <p>(+250) 788 313 028</p>
              </li>
              <li class="email"><i class="icon anm anm-envelope-l"></i>
                <p>info@ingabo.rw</p>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!--End Footer Links-->
      <hr>
      <div class="footer-bottom text-center">
        <div class="row">
          <!--Footer Copyright-->
          <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-1 order-md-0 order-lg-0 order-sm-1 copyright text-sm-center text-md-left text-lg-left">
            <span></span> <a href="ingabo.rw">All right &copy;<span id="year"></span> Ingabo HealthPlant</a>
          </div>
          <script>document.getElementById("year").innerHTML = new Date().getFullYear();</script>
            <!--End Footer Copyright-->
        </div>
      </div>
    </div>
  </div>
</footer>
<!--End Footer-->

    <!--Scoll Top-->
    <span id="site-scroll"><i class="icon anm anm-angle-up-r"></i></span>
    <!--End Scoll Top-->
  




<!--Quick View popup-->
<div class="modal fade quick-view-popup" id="content_quickview">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div id="ProductSection-product-template" class="product-template__container prstyle1">
          <div class="product-single">
            <!-- Start model close -->
            <a href="javascript:void()" data-dismiss="modal" class="model-close-btn pull-right" title="close"><span
                class="icon icon anm anm-times-l"></span></a>
            <!-- End model close -->
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="product-details-img">
                  <div class="pl-20">
                    <img id="photo"></img>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="product-single__meta">
                  <h2 class="product-single__title"><span class="" id="pro_name"></span> Quick View</h2>
                  
                  <div class="prInfoRow">
                    <div class="product-sku">Category: <span class="variant-sku" id="category"></span></div>
                  </div>
                  <p class="product-single__price product-single__price-product-template">
                    <span class="visually-hidden">Regular price</span>
                    <s id="ComparePrice-product-template"><span class="money">Rwf 4500</span></s>
                    <span
                      class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                      <span id="ProductPrice-product-template">Rwf <span class="money" id="pro_price"></span></span>
                    </span>
                  </p>
                  <b><h5 class="text-secondary">Product Descriptions</h5></b>
                  <div class="product-single__description rte">
                  </div>

                  <form method="post" action="" id="product_form_10508262282" accept-charset="UTF-8" class="product-form product-form-product-template hidedropdown"
                    enctype="multipart/form-data">
                    <div class="swatch clearfix swatch-1 option2" data-option-index="1">
                      <div class="product-form__item">
                        <label class="header">Manufactured Date: <span class="man_date text-small"></span></label>
                        <label class="header">Expired Date: <span class="exp_date text-small"></span></label>
                      </div>
                    </div>
                    <!-- Product Action -->
                    <div class="product-action clearfix">
                      <div class="product-form__item--submit">
                        <a href="./shop" class="btn product-form__cart-submit">
                          <span>Add to cart</span>
                        </a>
                      </div>
                    </div>
                    <!-- End Product Action -->
                  </form>
                </div>
              </div>
            </div>
            <!--End-product-single-->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--End Quick View popup-->




    

     
     <!-- Including Jquery -->
     <!-- <script src="assets/js/tabledata/jquery.dataTables.min.js"></script> -->
     <script src="assets/js/vendor/jquery-3.3.1.min.js"></script>
     <!-- <script src="assets/js/jquery.min.js"></script> -->

     <script src="assets/js/main.js"></script>
     <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
     <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script> -->

     <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
     <script src="assets/js/vendor/jquery.cookie.js"></script>
     <script src="assets/js/vendor/wow.min.js"></script> -->
     <!-- Including Javascript -->
      <script src="assets/js/bootstrap.min.js"></script>
     <script src="assets/js/plugins.js"></script>
     <script src="assets/js/popper.min.js"></script>
     <script src="assets/js/lazysizes.js"></script>

</div>
</body>

</html>