<?php 
	include("../../config/db.php");

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		

		$stmt = $db->prepare("SELECT * FROM vendor WHERE vendorid=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();
		

		echo json_encode($row);
	}
?>