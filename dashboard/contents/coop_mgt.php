<?php
$sql = "SELECT * FROM cooperatives";
$stmt = $db->prepare($sql);
$stmt->execute();

?>

<table id="farmer_table" class="display" cellspacing="0" width="100%">
	<thead>
		<tr>
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
		<?php foreach($stmt as $res): ?>
		<tr>
			<td><?= $res['coop_name'] ?></td>
			<td><?= $res['phone_to_contact'] ?></td>
			<td><?= $res['district'] ?></td>
			<td><?= $res['sector'] ?></td>
			<td><?= $res['cell'] ?></td>
			<td><?= $res['village'] ?></td>
			<td><a href="" data-toggle="modal" data-target="#edit_coop" data-id="<?= $res['coop_id'] ?>" class="text-success edit_coop">Edit</a> || <a href="" class="text-warning">Delete</a></td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>