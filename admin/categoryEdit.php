<?php
	include("../config/db.php");

	if(isset($_POST['edit'])){
		$catid = $_POST['catid'];
		$name = $_POST['name'];
		$description = $_POST['description'];

		try{
			$stmt = $db->prepare("UPDATE category SET name=:name, description=:description WHERE catid=:catid");
			$stmt->execute(['name'=>$name, 'description'=>$description, 'catid'=>$catid]);
			$_SESSION['success'] = 'Category updated successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		
	}
	else{
		$_SESSION['error'] = 'Fill up edit category form first';
	}

	header('location: clubCategory.php');

?>