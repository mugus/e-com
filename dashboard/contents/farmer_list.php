
<div class="text-center text-info">
	<h2>Manage farmers</h2>
</div>

<table id="farmer_table" class="display" cellspacing="0" width="100%">
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
			<td><a href="" class="text-success">Edit</a> || <a href="" class="text-warning">Delete</a></td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>