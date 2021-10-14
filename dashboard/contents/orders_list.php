
<div class="text-center text-info">
	<h2>Manage Your Orders</h2>
</div>

<table id="farmer_table" class="display" cellspacing="0" width="99%">
	<thead>
		<tr>
			<th>#</th>
			<th>Farmer Names</th>
			<th>Phone N<sup>o</sup> </th>
			<th>Email(Agent)</th>
			<th>Amount</th>
			<th>Verify Payments</th>
		</tr>
	</thead>

	<tbody>
    <?php if($pay_stmt->rowCount() > 0): ?>
		<?php $i=1; foreach($pay_stmt as $res): ?>
		<tr>
			<td><?= $i ?></td>
			<td><?= $res['fullname'] ?></td>
			<td><?= $res['phone'] ?></td>
			<td><?= $res['email'] ?></td>
			<td>Rwf <?= $res['amount'] ?></td>
			<td>
				<a href="" class="order_details btn" data-toggle="modal" data-target="#order_details" data-id="<?= $res['tx_ref'] ?>">
				<span class="fa fa-eye"></span>
				</a>
				<?php if($res['verified'] == 0): ?>
					<a href="./orders.php?tx_ref=<?= $res['tx_ref'] ?>&&amount=<?= $res['amount'] ?>" class="btn">
						Verify 
					</a>
				<?php else: ?>
					<a href="#" class="btn">
						<span class="fa fa-check"></span>Shipping
					</a>
				<?php endif ?>
				
			</td>
		</tr>
		<?php $i++; endforeach ?>
		<?php else: ?>
      <tr>
        <td colspan="9">No Order found</td>
      </tr>
		<?php endif ?>
	</tbody>
</table>


<!-- <table id="farmer_table" class="display" cellspacing="0" width="99%">
	<thead>
		<tr>
			<th>Farmer Reg N<sup>o</sup></th>
			<th>Names</th>
			<th>Farmer Phone N<sup>o</sup> </th>
			<th>Farmer Address</th>
			<th>Coop Phone N<sup>o</sup> </th>
			<th>Coop Address</th>
			<th>Product name</th>
			<th>Product Size</th>
			<th>Product Price</th>
			<th>Items</th>
		</tr>
	</thead>

	<tbody>
    <?php if($orders->rowCount() > 0): ?>
		<?php foreach($orders as $res): ?>
		<tr>
			<td><?= $res['farmer_reg_no'] ?></td>
			<td><?= $res['farmer_lastname'].' '.$res['farmer_firstname'] ?></td>
			<td><?= $res['farmer_phone'] ?></td>
			<td><?= $res['farmer_address'] ?></td>
			<td><?= $res['coop_phone'] ?></td>
			<td><?= $res['coop_address'] ?></td>
			<td><?= $res['product_name'] ?></td>
			<td><?= $res['product_size'] ?></td>
			<td>Rwf <?= $res['price'] ?></td>
			<td><?= $res['qty'] ?></td>
		</tr>
		<?php endforeach ?>
		<?php else: ?>
      <tr>
        <td colspan="9">No Order found</td>
      </tr>
		<?php endif ?>
	</tbody>
</table> -->