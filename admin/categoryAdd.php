
<?php
	include("../config/db.php");

	if(isset($_POST['add'])){
		$name = $_POST['name'];
		$description = $_POST['description'];


		$stmt = $db->prepare("SELECT *, COUNT(*) AS numrows FROM category WHERE name=:name");
		$stmt->execute(['name'=>$name]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Category already exist';
		}
		else{
			try{
				$stmt = $db->prepare("INSERT INTO category (name,description) VALUES (:name,:description)");
				$stmt->execute(['name'=>$name,'description'=>$description]);
				$_SESSION['success'] = 'Category added successfully';
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

	}
	else{
		$_SESSION['error'] = 'Fill up category form first';
	}

	header('location: clubCategory.php');

?>