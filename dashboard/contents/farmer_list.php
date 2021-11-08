<?php

if(isset($_POST['update_farmer'])){
      
	$farmer_id = $_POST['farmer_id'];
	$farmer_firstname = $_POST['farmer_firstname'];
	$farmer_lastname = $_POST['farmer_lastname'];
	$province = $_POST['province'];
	$district = $_POST['district'];
	$sector = $_POST['sector'];
	$cell = $_POST['cell'];
	$village = $_POST['village'];
	$farmer_landsize = $_POST['farmer_landsize'];
	// $f_phone = $_POST['f_phone'];

	try{
		$sql = "UPDATE farmers SET farmer_firstname = :farmer_firstname,farmer_lastname=:farmer_lastname, 
									province=:province, district=:district, sector=:sector, cell=:cell, village=:village,
									farmer_landsize=:farmer_landsize
					WHERE :farmer_id = :farmer_id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':farmer_id', $farmer_id);
		$stmt->bindParam(':farmer_firstname', $farmer_firstname);
		$stmt->bindParam(':farmer_lastname', $farmer_lastname);
		$stmt->bindParam(':province', $province);
		$stmt->bindParam(':district', $district);
		$stmt->bindParam(':sector', $sector);
		$stmt->bindParam(':cell', $cell);
		$stmt->bindParam(':village', $village);
		$stmt->bindParam(':farmer_landsize', $farmer_landsize);
		// $stmt->bindParam(':farmer_phone', $f_phone);

		$stmt->execute();

		if($stmt->rowCount() > 0){
			$result = "<small>You are successful updated farmer details</small>";
			$alert = "alert-success";
		}else{
			$result = "<small>Something went wrong</small>";
			$alert = "alert-danger";
		}
	  }catch(PDOException $ex){
		$result = "<p>Error occured: ".$ex->getMessage()."</p>";
		$alert = "alert-danger";
	  }
	}
?>



<table id="farmer_table" class="display" cellspacing="0" width="100%">
<?php if(isset($result)){
echo "<div class='alert $alert alert-dismissable alert-sm' role='alert'>
			<div class='alert-message'>
			$result!
			</div>
		</div>";
}
?>
	<thead>
		<tr>
			<th>Reg N<sup>o</sup></th>
			<th>Names</th>
			<th>Phone N<sup>o</sup> </th>
			<th>District</th>
			<th>Sector</th>
			<th>Cell</th>
			<th>Village</th>
			<th>Actions</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach($farmers as $res): ?>
		<tr>
			<td><?= $res['farmer_reg_no'] ?></td>
			<td><?= $res['farmer_lastname'].' '.$res['farmer_firstname'] ?></td>
			<td><?= $res['farmer_phone'] ?></td>
			<td><?= $res['district'] ?></td>
			<td><?= $res['sector'] ?></td>
			<td><?= $res['cell'] ?></td>
			<td><?= $res['village'] ?></td>
			<td><a href="" data-toggle="modal" data-target="#edit_farmer" data-id="<?= $res['farmer_id'] ?>" class="text-success edit_farmer">Edit</a> || <a href="" class="text-warning">Delete</a></td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>



<!-- Edit Farmer Modal -->
<div class="modal fade" id="edit_farmer" tabindex="-1" role="dialog" aria-labelledby="edit_farmer" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Update Farmer Details</h2>
      </div>
      <div class="container">
		  <!-- beginning -->
	  <div class="card">
		<div class="card-body">
		<form onsubmit="" method="POST" action="" enctype="multipart/form-data">
			<input type="hidden" name="farmer_id">
			<div class="form-row">
				<div class="col-md-6">
					<label class="form-label">FirstName <span class="text-danger">*</span> </label>
					<input type="text" style="height: 34px;" name="farmer_firstname" id="farmer_firstname" class="form-control" placeholder="E.g: John">
				</div>
				<div class="col-md-6">
					<label class="form-label">SurName <span class="text-danger">*</span> </label>
					<input type="text" style="height: 34px;" name="farmer_lastname" id="farmer_lastname" class="form-control" placeholder="E.g: Muhizi">
				</div>
			</div><br>
			<h4 class="text-primary"><b> <span class="fa fa-star"></span> Farmer Addresses</b></h4>
			<div class="form-row">
				<div class="col-md-3">
					<label for="inputAddress">Province<span class="text-danger">*</span></label>
					<input type="text" style="height: 34px;" name="province" id="province" class="form-control" placeholder="E.g: East">
				</div>
				<div class="col-md-3">
					<label for="inputAddress">District<span class="text-danger">*</span></label>
					<input type="text" style="height: 34px;" name="district" id="district" class="form-control" placeholder="E.g: Nyagatare">
				</div>
				<div class="col-md-3">
					<label for="inputAddress">Sector<span class="text-danger">*</span></label>
					<input type="text" style="height: 34px;" name="sector" id="sector" class="form-control" placeholder="E.g: Gatunda">
				</div>
				<div class="col-md-3">
					<label for="inputAddress">Cell<span class="text-danger">*</span></label>
					<input type="text" style="height: 34px;" name="cell" id="cell" class="form-control" placeholder="E.g: Cyagaju">
				</div><br>
			</div>

			<div class="form-row">
				<div class="col-md-6">
					<label for="inputAddress">Village<span class="text-danger">*</span></label>
					<input type="text" style="height: 34px;" name="village" id="village" class="form-control" placeholder="E.g: Kabeza">
				</div>
				<div class="col-md-6">
					<label for="inputAddress">Landsize <span class="text-muted">(in m<sup>2</sup> )</span> <small class="text-secondary">Optional</small></label>
					<input type="text" style="height: 34px;" name="farmer_landsize" id="farmer_landsize" class="form-control" placeholder="E.g: 340">
				</div>
			</div><br>
			<!-- <div class="form-row">
				<div class="col-md-5">
					Want to update phone number?&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" id="getdiv" onchange="Getphone()" value="">
				</div>
				<div class="col-md-7 phone_div" style="display: none">
					<div class="row">
						<div class="col-md-6">
							<label for="">Password<span class="text-danger">*</span></label>
							<input type="password" style="height: 34px;" name="password" id="password" class="form-control" placeholder="********">
						</div>
						<div class="col-md-6">
							<label for="">Confirm Password<span class="text-danger">*</span></label>
							<input type="password" style="height: 34px;" name="password2" id="password2" class="form-control" placeholder="********">
						</div>
					</div>
					<div class="row">
						<div class="col-md-12" id="phone">
							<label for="inputAddress">Phone N<sup>o</sup></label>
							<input type="text" name="f_phone" id="f_phone" style="height: 34px;" class="form-control" placeholder="E.g: 0787848876" required>
							<small class="text-danger phone_info"></small>
						</div>
					</div>
				</div>
			</div><hr> -->

			<button type="submit" class="btn btn-primary" id="update_farmer" name="update_farmer">Confirm Changes</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Dismiss</button>
		</form>
		</div>
	</div>
	<!-- end  -->

      </div>
      

    </div>
  </div>
</div>