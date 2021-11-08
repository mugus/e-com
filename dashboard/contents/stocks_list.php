<?php
$sql = "SELECT p.product_id,st.id AS stock_id , p.name AS product_name, cat.cat_name, ps.product_size, ps.price, st.stock, co.coop_name FROM stock_mgt st
        LEFT JOIN cooperatives co ON st.coop_id = co.coop_id
        LEFT JOIN products_size ps ON st.ps_id = ps.id
        LEFT JOIN products p ON ps.product_id = p.product_id
        LEFT JOIN categories cat ON p.cat_id = cat.cat_id  ORDER BY st.id DESC";
$stmt = $db->prepare($sql);
$stmt->execute();




?>
<table id="stock_table" class="display" cellspacing="0" width="99%">
    <div class="text-center">
        <h2 class="text-success">View Distributed Stocks List</h2>
    </div>
	<thead>
		<tr>
			<th>#</th>
			<th>Product Name(Category)</th>
			<th>Product size</th>
			<th>Price</th>
			<th>Warehouse</th>
			<th>Stock</th>
			<th>Actions</th>
		</tr>
	</thead>

	<tbody>
    <?php if($stmt->rowCount() > 0): ?>
		<?php $i=1; foreach($stmt as $res): ?>
		<tr>
			<td><?= $i ?></td>
			<td><?= $res['product_name'].'('.$res['cat_name'].')' ?></td>
			<td><?= $res['product_size'] ?></td>
			<td><?= $res['price'] ?> Rwf</td>
			<td><?= $res['coop_name'] ?></td>
			<td><?= $res['stock'] ?> units</td>
			<td>
				<a href="" class="edit_stock" data-toggle="modal" data-target="#edit_st" data-id="<?= $res['stock_id'] ?>">
                    Update stock
				</a>
				
			</td>
		</tr>
		<?php $i++; endforeach ?>
		<?php else: ?>
      <tr>
        <td colspan="9">No product stock found <span class="text-info">Go to New Stock</span></td>
      </tr>
		<?php endif ?>
	</tbody>
</table>




<!-- Modal Edit PS stock-->
<div class="modal fade" id="edit_st" tabindex="-1" role="dialog" aria-labelledby="edit_st" aria-hidden="true">
	<div class="modal-dialog  modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title">Update <b class="product_size"></b> stock at <span id="coop_name"></span> Warehouse </h2>
			</div>
			<div class="container">
				<form method="POST" action="">
					<input type="hidden" class="form-control" name="id" id="st_id">
					<input type="hidden" class="form-control" name="ps_id" id="pro_size_id">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="inputAddress">Quantity in stock <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="stock" id="stock">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="submit" class="form-control btn" name="edit_stock" id="edit_stock" value="SAVE CHANGES">
								<input type="button" class="form-control btn" data-dismiss="modal" value="EXIT">
							</div>
						</div>
					</div>

				</form>

			</div>

		</div>
	</div>
</div>