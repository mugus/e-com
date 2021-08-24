<!DOCTYPE html>
<?php
include("../config/db.php");
if(isset($_SESSION['vendorid'])): 
?>

<html lang="en">
  <?php 
    include('./includes/header.php');
  ?>
	<body>
		<div class="wrapper">
			<!-- sidebar start here -->
			<?php 
				include('./includes/sidebar.php');
			?>
      		<div class="main">
            <!-- naviagtion bar start here -->
            <?php 
              include('includes/navbar.php');
            ?>
            <main class="content">
					    <div class="container-fluid p-0">

                <div class="row mb-2 mb-xl-3">
                  <div class="col-auto d-none d-sm-block">
                    <h3 class="text-muted">Manage Your Paintings</h3>
                  </div>
                  <div class="col-auto ml-auto text-right mt-n1">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                        <li class="breadcrumb-item text-muted">PSOMS</li>
                        <li class="breadcrumb-item">
                          <a href="./add_product.php">Add New Painting</a>
                        </li>
                      </ol>
                    </nav>
                  </div>
                </div>

                <?php 
                  include('contents/product_details.php');
                ?>

              </div>
            </main>
            <!-- <script type="text/javascript">
              $(document).ready(function () {
                var carousel = $("#carousel").waterwheelCarousel({
                  flankingItems: 3,
                  movingToCenter: function ($item) {
                    $('#callback-output').prepend('movingToCenter: ' + $item.attr('id') + '<br/>');
                  },
                  movedToCenter: function ($item) {
                    $('#callback-output').prepend('movedToCenter: ' + $item.attr('id') + '<br/>');
                  },
                  movingFromCenter: function ($item) {
                    $('#callback-output').prepend('movingFromCenter: ' + $item.attr('id') + '<br/>');
                  },
                  movedFromCenter: function ($item) {
                    $('#callback-output').prepend('movedFromCenter: ' + $item.attr('id') + '<br/>');
                  },
                  clickedCenter: function ($item) {
                    $('#callback-output').prepend('clickedCenter: ' + $item.attr('id') + '<br/>');
                  }
                });

                $('#prev').bind('click', function () {
                  carousel.prev();
                  return false
                });

                $('#next').bind('click', function () {
                  carousel.next();
                  return false;
                });

                $('#reload').bind('click', function () {
                  newOptions = eval("(" + $('#newoptions').val() + ")");
                  carousel.reload(newOptions);
                  return false;
                });

              });
            </script> -->
  <?php include('./includes/footer.php'); ?>
  <script type="text/javascript">
		$(document).ready(function () {
      var totalDiv = $("#carouselNumber").val();
      for(var j = 1; j<= totalDiv; j++){
        var carouselid = '#carousel_'+j;
        // var previousid = '#prev_'+j;
        // var nextid = '#next_'+j;
        var carousel = $(carouselid).waterwheelCarousel();
        
        
      }

			$('#reload').bind('click', function () {
				newOptions = eval("(" + $('#newoptions').val() + ")");
				carousel.reload(newOptions);
				return false;
			});

		});
    function previousimg(id) {
      var removeString = id.replace(/[^0-9]/g, '');
      var crslIdNumbr = parseInt(removeString );
      var carsl = '#carousel_'+crslIdNumbr ;
      var prevcarousel = $(carsl).waterwheelCarousel();
      $(id).bind('click', function () {
        prevcarousel.prev();
          return false;
        });
      $(".nextControl").val(crslIdNumbr);
    }
    function nextimg(id) {
      var removeString = id.replace(/[^0-9]/g, '');
      var crslIdNumbr = parseInt(removeString );
      var carsl = '#carousel_'+crslIdNumbr ;
      const nextcarousel = $(carsl).waterwheelCarousel();
      $(id).bind('click', function () {
        nextcarousel.next();
          return false;
        });
      $(".nextControl").val(crslIdNumbr);
    }
	</script>
  </body>
</html>
<?php else: ?>
  <script LANGUAGE='JavaScript'>
    window.location.href='../login.php';
  </script>
<?php endif ?>