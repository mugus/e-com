<?php
include("../config/db.php");
?>

<?php if($_SESSION['admin']){ ?>

<!DOCTYPE html>
<html lang="en">
	<?php 
		include('includes/header.php');
	?>

<body>
  <style>
    
    .box-header .with-border {
      border-bottom: 1px solid #f4f4f4;
    }
  </style>
	<div class="wrapper">
		<!-- sidebar start here -->
		<?php 
			include('includes/sidebar.php');
		?>

		<!-- sidebar end here -->

		<div class="main">
			
			<!-- naviagtion bar start here -->
			<?php 
				include('includes/navbar.php');
			?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Club Categories Page</h1>

					<div class="row">
						<div class="col-lg-12">
							<div class="card" >
                                <!-- header of div and messages part style='background:greenyellow;'-->
								<div class="card-header">
									<h5 class="card-title mb-0">General List of Categories</h5>
                  <div class="row">
                    <div class="col-md-12" style="height:40px;">
                      <?php
                          if(isset($_SESSION['error'])){
                          echo "
                              <div class='alert alert-danger alert-dismissible' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                                </button>
                                <div class='alert-icon'>
                                  <i class='fa fa-fw fa-warning'></i>
                                </div>
                                <div class='alert-message'>
                                  <strong>Error! </strong> ".$_SESSION['error']."
                                </div>
                              </div>
                          ";
                          unset($_SESSION['error']);
                          }
                          if(isset($_SESSION['success'])){
                          echo "
                              <div class='alert alert-success alert-dismissible' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                                </button>
                                <div class='alert-icon'>
                                  <i class='fa fa-fw fa-check'></i>
                                </div>
                                <div class='alert-message'>
                                  <strong>Well Done! </strong> ".$_SESSION['success']."
                                </div>
                              </div>
                          ";
                          unset($_SESSION['success']);
                          }
                      ?>
                    </div>
                  </div>
								</div>
                  <!-- content div body -->
                <div class="col-12">
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="box table-responsive">
                        <div class="box-header with-border" style='text-align:center;'>
                            <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>

                            <a href="#" type="submit" onclick="javascript:printDiv('resultToPrint')" class="btn btn-secondary btn-sm btn-flat">
                              Print 
                            </a>
                        </div>
                        <div class="row">
                          <div class="col-12">
                            <div class="table-responsive" id="resultToPrint">
                              <table id="example1" class="table table-bordered mb-0">
                                <thead>
                                  <th scope="col">N<sup><u>o</u></sup></th>
                                  <th scope="col">Category</th>
                                  <th scope="col">Description</th>
                                  <th scope="col">Tools</th>
                                </thead>
                                <tbody>
                                  <?php
                                      try{
                                      $stmt = $db->prepare("SELECT * FROM  category  ORDER BY name ASC");
                                      $stmt->execute();
                                      $is_sql = $stmt->rowCount();
                                      if(!empty($is_sql)){ 
                                          $i = 0;
                                          foreach($stmt as $row){
                                            echo "
                                            <tr>
                                                <td>".++$i."</td>
                                                <td>".$row['name']."</td>
                                                <td>".$row['description']."</td>
                                                <td>
                                                  <div class='btn-group' role='group' aria-label='Button group with nested dropdown'>
                                                    <button class='btn btn-outline-primary btn-sm viewCategory btn-flat' data-id='".$row['catid']."'><i class='fa fa-search'></i> View</button>
                                                    <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['catid']."'><i class='fa fa-edit'></i> Edit</button>
                                                    <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['catid']."'><i class='fa fa-trash'></i> Delete</button>
                                                  </div>
                                                </td>
                                            </tr>
                                            ";
                                          }
                                        }
                                      }
                                      catch(PDOException $e){
                                      echo $e->getMessage();
                                      }

                                  ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>
			
			<?php 
				include('includes/footer.php');
                include('includes/categoryModal.php'); 
			?>
            <?php include('includes/scripts.php'); ?>
		</div>
	</div>
<script>
    $(function(){

    $(document).on('click', '.edit', function(e){
        e.preventDefault();
        $('#edit').modal('show');
        var id = $(this).data('id');
        getRow(id);
    });

    $(document).on('click', '.viewCategory', function(e){
        e.preventDefault();
        $('#promoteModel').modal('show');
        var id = $(this).data('id');
        getRow(id);
    });

    $(document).on('click', '.delete', function(e){
        e.preventDefault();
        $('#delete').modal('show');
        var id = $(this).data('id');
        getRow(id);
    });

    $(document).on('click', '.photo', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        getRow(id);
    });

    $(document).on('click', '.status', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        getRow(id);
    });

    });

    function getRow(id){
    $.ajax({
        type: 'POST',
        url: 'php/categoryRow.php',
        data: {id:id},
        dataType: 'json',
        success: function(response){
        $('.catid').val(response.catid);
        $('#editCat').val(response.name);
        $('#editDesc').val(response.description);
        // $('.fullname').html(response.firstname+' '+response.lastname);
        // promote Student Modal Values
        $('#catId').val(response.catid);
        $('#catName').html(response.name);
        $('#catDesc').html(response.description);
        $('.delCatid').val(response.catid);
        $('.catgName').html(response.name);
        }
    });
    }
</script>

<!-- *********** PRINT ACTION **************************** -->

<script language="javascript" type="text/javascript">
  function printDiv(divID) {
      //Get the HTML of div
      var divElements = document.getElementById(divID).innerHTML;
      //Get the HTML of whole page
      var oldPage = document.body.innerHTML;

      //Reset the page's HTML with div's HTML only
      document.body.innerHTML = 
      "<html><head><title></title></head><body>" + 
      divElements + "</body>";

      //Print Page
      window.print();

      //Restore orignal HTML
      document.body.innerHTML = oldPage;
  }
  </script>
<!-- *********** PRINT ACTION END ************************** -->

</body>

</html>

<?php 
}else{
	header('Location: ../login.php');
	} 
	?>
  