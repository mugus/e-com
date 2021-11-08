<?php
$wpsql = "SELECT * FROM payments p WHERE p.verified = 1 AND p.sales_status = 1 ORDER BY p.paid_on DESC";
$pay_st = $db->prepare($wpsql);
$pay_st->execute();
?>

<div class="float-left">
	<h2>Paid and Shipped Orders</h2>
</div>
<div class="float-right">
	<a href="./exports/exportData.php" ><i class="fa fa-download"></i> Export as CSV</a>
</div>

<table id="farmer_table" class="display" cellspacing="0" width="99%">
	<thead>
		<tr>
			<th>#</th>
			<th>Farmer Names</th>
			<th>Phone N<sup>o</sup></th>
			<th>Email(Agent)</th>
			<th>Amount</th>
			<th>Paid On</th>
			<th>View</th>
		</tr>
	</thead>

	<tbody>
    <?php if($pay_st->rowCount() > 0): ?>
		<?php $i=1; foreach($pay_st as $res): ?>
		<tr>
			<td><?= $i ?></td>
			<td><?= $res['fullname'] ?></td>
			<td><?= $res['phone'] ?></td>
			<td><?= $res['email'] ?></td>
			<td>Rwf <?= $res['amount'] ?></td>
			<td><?= $res['paid_on'] ?></td>
			<td>
				<a href="" class="order_details btn" data-toggle="modal" data-target="#order_details" data-id="<?= $res['tx_ref'] ?>">
                    <span class="fa fa-eye"></span>
				</a>
				
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


