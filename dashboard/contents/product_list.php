
<?php
$sql = "SELECT p.product_id, p.name,c.cat_name, p.descriptions, p.photo FROM products p LEFT JOIN categories c ON p.cat_id = c.cat_id;";
$stmt = $db->prepare($sql);
$stmt->execute();


// Add new size
if(isset($_POST['add_new_ps'])){
	$product_id = $_POST['product_id'];
	$product_size = $_POST['product_size'];
	$price = $_POST['price'];
	$man_date = $_POST['man_date'];
	$exp_date = $_POST['exp_date'];
	$sql = "SELECT * FROM products_size WHERE product_id=:product_id AND product_size=:product_size";
	$stmt = $db->prepare($sql);
	$stmt->execute(
	  array(
		'product_id'=>$product_id,
		'product_size'=>$product_size
	  )
	);
	if($stmt->rowCount() < 0){
		$sql = "INSERT INTO products_size (product_id,product_size,price,man_date,exp_date) VALUES (:product_id,:product_size,:price,:man_date,:exp_date)";
		$stmt = $db->prepare($sql);
		$stmt->execute(
		  array(
			'product_id'=>$product_id,
			'product_size'=>$product_size,
			'price'=>$price,
			'man_date'=>$man_date,
			'exp_date'=>$exp_date
		  )
		);
		if($stmt->rowCount() > 0){
		  echo "<script language='javascript'>";
		  echo "if(!alert('PRODUCT SIZE CREATED!')){
			window.location.replace('./new_product.php');
		  }";
		  echo "</script>";
		}else{
			echo "<script language='javascript'>";
			echo "if(!alert('Something went wrong!')){
			  window.location.replace('./new_product.php');
			}";
			echo "</script>";
		}
	}else{
		echo "<script language='javascript'>";
		echo "if(!alert('Do not Duplicate Product Size! Try Update Instead')){
		  window.location.replace('./new_product.php');
		}";
		echo "</script>";
	}



}

// Edit Size
if(isset($_POST['edit_ps'])){
	$product_size = htmlspecialchars(strip_tags($_POST['product_size']));
	$price = htmlspecialchars(strip_tags($_POST['price']));
	$man_date = htmlspecialchars(strip_tags($_POST['man_date']));
	$exp_date = htmlspecialchars(strip_tags($_POST['exp_date']));
	$id = htmlspecialchars(strip_tags($_POST['id']));

	$sql = "UPDATE products_size SET product_size= :product_size, price=:price, man_date=:man_date, exp_date=:exp_date WHERE id=:id";
	$stmt = $db->prepare($sql);
	$stmt->execute(
	  array(
		'id'=>$id,
		'product_size'=>$product_size,
		'price'=>$price,
		'man_date'=>$man_date,
		'exp_date'=>$exp_date
	  )
	);
	if($stmt->rowCount() > 0){
		echo "<script language='javascript'>";
		echo "if(!alert('Product updated!!')){
		  window.location.replace('./new_product.php');
		}";
		echo "</script>";
	}
	// echo "PS ID: ".$_POST['ps_id'];

}


if(isset($_POST['edit_stock'])){
	$stock = $_POST['stock'];
	$id = $_POST['id'];
	$ps_id = $_POST['ps_id'];

	$sqlstmg = "SELECT * FROM stock_mgt WHERE id=:id";
	$stmtmgt = $db->prepare($sqlstmg);
	$stmtmgt->execute(array('id'=>$id));
	$rowmgt = $stmtmgt->fetch(PDO::FETCH_ASSOC);
	$mgt_stock = (int)$rowmgt['stock'];

	$sqlps = "SELECT * FROM products_size WHERE id=:id";
	$stmtps = $db->prepare($sqlps);
	$stmtps->execute(array('id'=>$ps_id));
	$rowps = $stmtps->fetch(PDO::FETCH_ASSOC);
	$ps_stock = (int)$rowps['stock'];

	$upd_stock = $ps_stock - $mgt_stock;
	$new_stock = $upd_stock + (int)$stock;

	$sql = "UPDATE stock_mgt SET stock=:stock WHERE id=:id";
	$stmt = $db->prepare($sql);
	$stmt->execute(
	  array(
		'id'=>$id,
		'stock'=>$stock
	  )
	);
	if($stmt->rowCount() == 1){
		$sql = "UPDATE products_size SET stock=:stock WHERE id=:id";
		$stmt = $db->prepare($sql);
		$stmt->execute(
		  array(
			'id'=>$ps_id,
			'stock'=>$new_stock
		  )
		);
		if($stmt->rowCount() == 1){
			echo "<script language='javascript'>";
			echo "if(!alert('Stock Updated!')){
				window.location.replace('./new_product.php');
			}";
			echo "</script>";
		}else{
			echo "<script language='javascript'>";
			echo "if(!alert('Something went wrong!')){
				window.location.replace('./new_product.php');
			}";
			echo "</script>";
		}
	}


}

if(isset($_GET['delete_ps_id'])){
$sql = "DELETE FROM products_size WHERE id=:id";
$stmt = $db->prepare($sql);
$stmt->execute(
  array(
	'id'=>$_GET['delete_ps_id']
  )
);
if($stmt->rowCount() > 0){
	echo "<script language='javascript'>";
	echo "if(!alert('Product size Removed!')){
	  window.location.replace('./new_product.php');
	}";
	echo "</script>";
}else{
	echo "<script language='javascript'>";
	echo "if(!alert('Ooop! Something went wrong!')){
	  window.location.replace('./new_product.php');
	}";
	echo "</script>";
}
// echo "Ready to remove ".$_GET['delete_ps_id'];
}
?>




<table id="farmer_table" class="display" cellspacing="0" width="99%">
	<thead>
		<tr>
			<th>#</th>
			<th>Product Names</th>
			<th>Category </th>
			<th>Descriptions</th>
			<th>Action</th>
		</tr>
	</thead>

	<tbody>
    <?php if($stmt->rowCount() > 0): ?>
		<?php $i=1; foreach($stmt as $res): ?>
		<tr>
			<td><?= $i ?></td>
			<td><?= $res['name'] ?></td>
			<td><?= $res['cat_name'] ?></td>
			<td><?= $res['descriptions'] ?></td>
			<td>
				<a href="" class="product_size_details" data-toggle="modal" data-target="#product_size_details" data-id="<?= $res['product_id'] ?>">
                    Review
				</a> | 
                <a href="" class="product_details" data-toggle="modal" data-target="#product_details" data-id="<?= $res['product_id'] ?>">
                    Delete
				</a>
				
			</td>
		</tr>
		<?php $i++; endforeach ?>
		<?php else: ?>
      <tr>
        <td colspan="9">No product found</td>
      </tr>
		<?php endif ?>
	</tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="product_size_details" tabindex="-1" role="dialog" aria-labelledby="product_size_details" aria-hidden="true">
  <div class="modal-dialog  modal-md" role="document">
    <div class="modal-content" style="overflow: scroll; height: 400px;">
      <div class="modal-header">
        <h2 class="modal-title">Product sizes Details</h2>
      </div>
      <div class="container">
        <div class="row">
			<div class="col-md-12 col-sm-12 col-lg-12">
				<div id="sizes_data" style="font-size: 15px"></div>
			</div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- New PS  -->
<div class="modal fade" id="new_ps" tabindex="-1" role="dialog" aria-labelledby="new_ps" aria-hidden="true">
  <div class="modal-dialog  modal-md" role="document">
    <div class="modal-content" style="overflow: scroll; height: 400px;">
      <div class="modal-header">
        <h2 class="modal-title">New <span id="product_name"></span> sizes Details</h2>
      </div>
      <div class="container">
			<form method="POST" action="">
			<input type="hidden" name="product_id" id="product_id">

				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="exampleInputEmail1">Product Size name</label>
							<input type="text" class="form-control" name="product_size" placeholder="E.g: 1Kg or 1L" required>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label for="">Price(<span class="text-muted">Rwf</span>) <span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="price" placeholder="4000" required>
						</div>
					</div>
					<div class="col-md-9">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Exp-Date</label>
									<input type="date" class="form-control" name="exp_date" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Man-Date</label>
									<input type="date" class="form-control" name="man_date" required>
								</div>
							</div>
						</div>
						
					</div>
					
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<input type="submit" class="form-control btn" name="add_new_ps" id="add_new_ps" value="SUBMIT">
							<input type="button" class="form-control btn" data-dismiss="modal" value="EXIT">
						</div>
					</div>
				</div>

			</form>

      </div>

    </div>
  </div>
</div>
<!-- End new PS -->

<!-- Modal Edit PS-->
<div class="modal fade" id="ps_id" tabindex="-1" role="dialog" aria-labelledby="ps_id" aria-hidden="true">
  <div class="modal-dialog  modal-md" role="document">
    <div class="modal-content" style="overflow: scroll; height: 400px;">
      <div class="modal-header">
        <h2 class="modal-title">Edit Product sizes Details</h2>
      </div>
      <div class="container">
		<form method="POST" action="">
			<div class="row">
				<input type="hidden" class="form-control" name="id" id="id">
				<div class="col-md-12">
					<div class="form-group">
						<label for="exampleInputEmail1">Product Size name</label>
						<input type="text" class="form-control" name="product_size" id="product_size">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Product Price(<span class="text-muted">Rwf</span>) <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="price" id="price">
					</div>
				</div>
				<!-- <div class="col-md-6">
					<div class="form-group">
						<label for="inputAddress">Quantity in stock(<span class="text-muted">Boxes</span>) <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="stock" id="stock">
					</div>
				</div> -->
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="exampleInputEmail1">Man-Date</label>
						<input type="date" class="form-control" name="man_date" id="man_date">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="exampleInputEmail1">Exp-Date</label>
						<input type="date" class="form-control" name="exp_date" id="exp_date">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<input type="submit" class="form-control btn" name="edit_ps" id="edit_ps" value="SAVE CHANGES">
						<input type="button" class="form-control btn" data-dismiss="modal" value="EXIT">
					</div>
				</div>
			</div>

		</form>

      </div>

    </div>
  </div>
</div>



