<?php
	include("../../config/db.php");

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		

		$stmt = $db->prepare("SELECT *, t.description AS catDesc, c.description AS description, c.name AS name, t.name AS catName FROM club AS c INNER JOIN student AS s ON s.student_id = c.created_by INNER JOIN category AS t ON t.catid = c.catid WHERE c.cid=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();
		

		echo json_encode($row);
	}
?>