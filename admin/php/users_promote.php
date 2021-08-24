<?php
	include("../../config/db.php");

	if(isset($_POST['promote'])){
		$id = $_POST['student_id'];
		$role = $_POST['role'];
		$names = $_POST['names'];

		try{
			$stmt = $db->prepare("UPDATE student SET role=:role WHERE student_id=:id");
			$stmt->execute(['role'=>$role, 'id'=>$id]);
			$_SESSION['success'] = $names.' Promoted to be Guild President successfully';

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		

	}
	else{
		$_SESSION['error'] = 'Promoting error';
	}

	header('location: ../users.php');

?>