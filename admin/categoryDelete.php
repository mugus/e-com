<?php
	include("../config/db.php");

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		

		try{
			$stmt = $db->prepare("DELETE FROM category WHERE catid=:id");
			$stmt->execute(['id'=>$id]);

			$_SESSION['success'] = 'Category deleted successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

	}
	else{
		$_SESSION['error'] = 'Select category to delete first';
	}

	header('location: clubCategory.php');
	
?>