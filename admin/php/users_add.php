<?php
	include("../../config/db.php");

	if(isset($_POST['add'])){
		$lastname = $_POST['lastname'];
		$firstname = $_POST['firstname'];
		$gender = $_POST['gender'];
		$phone = $_POST['phone'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$about = $_POST['about'];
		$username = $_POST['username'];
		$password = $_POST['password'];


		$stmt = $db->prepare("SELECT *, COUNT(*) AS numrows FROM dos WHERE email=:email");
		$stmt->execute(['email'=>$email]);
		$row = $stmt->fetch();

    // retrieve username in dos table to check if the entered username exist
		$stusrname = $db->prepare("SELECT *, COUNT(*) AS numrows FROM dos WHERE username=:username");
		$stusrname->execute(['username'=>$username]);
		$row2 = $stusrname->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Email already taken';
		}
    else if($row2['numrows'] > 0){
			$_SESSION['error'] = 'Username already taken';
		}
		else{
			$password = password_hash($password, PASSWORD_DEFAULT);
			$filename = $_FILES['photo']['name'];
			// $now = date('Y-m-d');
			if(!empty($filename)){
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $new_filename = 'DOS_'.rand(10000, 1000000).'.'.$ext;
        move_uploaded_file($_FILES['photo']['tmp_name'], '../../Profiles/'.$new_filename);
			}
			try{
				$stmt = $db->prepare("INSERT INTO dos (lastname, firstname, gender, phone, address, email, about, username, password, image) VALUES (:lastname, :firstname, :gender, :phone, :address, :email, :about, :username, :password, :image)");
				$stmt->execute(['lastname'=>$lastname,'firstname'=>$firstname,'gender'=>$gender,'phone'=>$phone,'address'=>$address,'email'=>$email,'about'=>$about,'username'=>$username,'password'=>$password,'image'=>$new_filename]);
				$_SESSION['success'] = 'DOS added successfully';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

	}
	else{
		$_SESSION['error'] = 'Fill up user form first';
	}

	header('location: ../users.php');

?>