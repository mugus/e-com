<!DOCTYPE html>
<?php
include("../config/db.php");
if(isset($_SESSION['vendor'])): 
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
                    <h3 class="text-muted">Record Your New Paint</h3>
                  </div>
                  <div class="col-auto ml-auto text-right mt-n1">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                        <li class="breadcrumb-item"><a href="#">PSOMS</a></li>
                        <li class="breadcrumb-item"><a href="index.php">Dashboards</a></li>
                      </ol>
                    </nav>
                  </div>
                </div>

                <?php 
                  include('contents/new_product.php');
                ?>

              </div>
            </main>

  <?php include('./includes/footer.php'); ?>

  <!-- Data Table Initialize -->
  <script>
    $(function () {
      $('#paintingsTable').DataTable({
        responsive: true,
        'paging'  : true
      })
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      })
    })
  </script>

  </body>
</html>
<?php else: ?>
  <script LANGUAGE='JavaScript'>
    window.location.href='../login.php';
  </script>
<?php endif ?>