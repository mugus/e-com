<?php
  session_start();
  include('../database/db.php');

  if(isset($_SESSION['un_id'])){

$coo = "SELECT * FROM cooperatives";
$coops = $db->prepare($coo);
$coops->execute();


if(isset($_POST['select_stock'])){
	$coop_id = htmlspecialchars(strip_tags($_POST['coop_id']));
    
	$sql = "SELECT * FROM cooperatives WHERE coop_id = :coop_id";
	$stmt = $db->prepare($sql);
	$stmt->execute(array(':coop_id' => $coop_id));
	if($stmt->rowCount() > 0){
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		$id = $row['coop_id'];
		// $coop_name = $row['coop_name'];
        // $cooperative = $id.'-'.$coop_name;
        $_SESSION['cooperative'] = $id;
        header("location: ../shop");
	}else{
		$result = "<small>Warehouse not found</small>";
		$alert = "alert-danger";
	}
}
?>


<?php include('./layouts/header.php'); ?>

   <!--Body Content-->
   <div id="page-content">
    	<!--Page Title-->
    	<div class="page section-header text-center">
        <div class="page-title">
          <div class="wrapper"><h1 class="page-width">Dashboard</h1></div>
        </div>
      </div>
      <style>
* {
  box-sizing: border-box;
}

.flex-container {
  display: flex;
  flex-direction: row;
  font-size: 13px;
  /* text-align: center; */
}

.flex-item-left {
  background-color: #f1f1f1;
  padding: 10px;
  flex: 50%;
}
/* ul li a:hover{
  text-decoration: none!important;
} */
.flex-item-right {
  padding: 10px;
  flex: 50%;
}

/* Responsive layout - makes a one column-layout instead of two-column layout */
@media (max-width: 800px) {
  .flex-container {
    flex-direction: column;
  }
}
</style>
        <!--End Page Title-->
      <div class="container">
        <div class="row flex-container">
          <div class="col-md-4 col-lg-3 col-sm-12 flex-item-left">
            <?php include("./layouts/sidebar.php") ?>

          </div>
          <div class="col-md-8 col-lg-9 col-sm-12 flex-item-right">
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Select Shop</h5>
                            <h6 class="card-subtitle text-muted">Please Select Warehouse You Want to Shop From</h6>
                        </div>
                        <div class="card-body">
                            <form onsubmit="" method="POST" action="" enctype="multipart/form-data">
                                <div class="container">
                                    <div class="form-row">
                                        <div class="form-group col-sm-12 col-12 col-md-12">
                                            <label for="inputAddress">Choose Warehouse <span class="text-danger">*</span></label>
                                            <select name="coop_id" id="" required>
                                                <option value="" hidden>Select or Search Warehouse</option>
                                                <?php while($row = $coops->fetch(PDO::FETCH_ASSOC)): ?>
                                                    <option value="<?= $row['coop_id'] ?>"><?= $row['coop_name'].': '.$row['district'] ?></option>
                                                <?php endwhile ?>
                                            </select>
                                        </div>
                                        
                                    </div>
                                    <div class="form-row">
                                        <button type="submit" class="btn btn-primary" name="select_stock">Confirm Stock</button>
                                    </div>
                                    
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>

  </div

<?php 
include('./layouts/footer.php');
  }else{
    header("location: ../login");
  }
?>