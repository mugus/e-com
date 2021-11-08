<!-- Modal -->
<div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="order_details" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Order Details</h2>
      </div>
      <div class="container" style="overflow:scroll; height:500px;">
        <div class="row">
          <div id="order_data" style="font-size: 15px"></div>

        </div>

      </div>
      <!-- <input type="button" value="click" onclick="printDiv()"> -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>






<!--Footer-->
<footer id="footer">

  <div class="site-footer">
    <div class="container">
      <hr>
      <div class="footer-bottom text-center">
        <div class="row">
          <!--Footer Copyright-->
          <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-1 order-md-0 order-lg-0 order-sm-1 copyright text-sm-center text-md-left text-lg-left">
            <span></span> <a href="https://ingabo.rw">All right &copy;<span id="year"></span> Ingabo HealthPlant</a>
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
  

     
     <!-- Including Jquery -->
     <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
      <script>
        $(document).ready(function () {
          $('#farmer_table').DataTable();
        });
        $(document).ready(function () {
          $('#stock_table').DataTable();
        });

        // $(document).ready(function () {
        //   $('#product_table').DataTable();
        // });
      </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>

     <!-- <script src="../assets/js/vendor/jquery-3.3.1.min.js"></script> -->
     <script src="../assets/js/vendor/modernizr-3.6.0.min.js"></script>
     <script src="../assets/js/vendor/jquery.cookie.js"></script>
     <script src="../assets/js/vendor/wow.min.js"></script>
     <!-- Including Javascript -->
     <script src="../assets/js/bootstrap.min.js"></script>
     <script src="../assets/js/plugins.js"></script>
     <script src="../assets/js/popper.min.js"></script>
     <script src="../assets/js/lazysizes.js"></script>
     <script src="../assets/js/main.js"></script>

</div>
</body>

</html>