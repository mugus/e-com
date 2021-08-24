<?php 
	include("../../config/db.php");

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		

		$stmt = $db->prepare("SELECT * FROM deliverer d JOIN company c ON d.company=c.companyid WHERE d.id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();
		

		echo json_encode($row);
	}
?>