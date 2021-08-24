<?php
	include("../config/db.php");

	if(isset($_POST['addUser'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $role = $_POST['role'];
    $username = $_POST['username'];
    $passw = $_POST['password'];
    $password = password_hash($passw,PASSWORD_DEFAULT);
    $status = 'Activated';
  
    try{
      $stmt = $db->prepare("INSERT INTO student(firstname, lastname, phone, email, gender, role, username, password, status) values(:firstname, :lastname, :phone, :email, :gender, :role, :username, :password, :status)");
      $stmt->execute(['firstname'=>$firstname,'lastname'=>$lastname,'phone'=>$phone,'email'=>$email,'gender'=>$gender,'role'=>$role,'username'=>$username,'password'=>$password,'status'=>$status]);
        
      $_SESSION['success'] = $firstname.' '.$lastname.' User Added Successfully!';
  
    }
    catch(PDOException $e){
      $_SESSION['error'] = $e->getMessage();
    }
  
  }else if(isset($_POST['edit'])){
		$student_id = $_POST['student_id'];
		$username = $_POST['username'];
		$pass = $_POST['password'];
    $password = password_hash($pass,PASSWORD_DEFAULT);
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
    
    if (!empty($password)) {
      
      try{
        $stmt = $db->prepare("UPDATE student SET username=:username, password=:password, 
                        firstname=:firstname, lastname=:lastname, phone=:phone, email=:email WHERE student_id=:student_id");
        
        $stmt->execute(['username'=>$username, 'password'=>$password, 'firstname'=>$firstname,'lastname'=>$lastname, 
        'phone'=>$phone, 'email'=>$email, 'student_id'=>$student_id]);
        $_SESSION['role'] = $username;
        $_SESSION['success'] = 'User information Updated successfully';
  
      }
      catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
      }
    } else {
      try{
        $stmt = $db->prepare("UPDATE student SET username=:username,  
                        firstname=:firstname, lastname=:lastname, phone=:phone, email=:email WHERE student_id=:student_id");
        
        $stmt->execute(['username'=>$username, 'firstname'=>$firstname,'lastname'=>$lastname, 
        'phone'=>$phone, 'email'=>$email, 'student_id'=>$student_id]);
        $_SESSION['role'] = $username;
        $_SESSION['success'] = 'User information Updated successfully';
  
      }
      catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
      }
    }

    }else if(isset($_POST['deactivate'])){
      $student_id = $_POST['student_id'];
      $status = 'Deactivated';
      $names = $_POST['usernames'];
    
      try{
        $stmt = $db->prepare("UPDATE student SET status=:status  WHERE student_id=:student_id");
        $stmt->execute(['status'=>$status, 'student_id'=>$student_id]);
          
        $_SESSION['success'] = $names.' User Deactivated!';
    
      }
      catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
      }
    
    }else if(isset($_POST['activate'])){
      $student_id = $_POST['student_id'];
      $status = 'Activated';
      $names = $_POST['names'];
    
      try{
        $stmt = $db->prepare("UPDATE student SET status=:status  WHERE student_id=:student_id");
        $stmt->execute(['status'=>$status, 'student_id'=>$student_id]);
          
        $_SESSION['success'] = $names.' User Activated!';
    
      }
      catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
      }
    
    }else if(isset($_POST['uploadPhoto'])){
        // userImage
        $photo = $_FILES['photo']['name'];
        $student_id = $_POST['student_id'];
        $names = $_POST['names'];

        if(!empty($photo)){
          $ext = pathinfo($photo, PATHINFO_EXTENSION);
          $new_photo = $student_id.'_'.rand(1000000000, 10000000000).'.'.$ext;
          move_uploaded_file($_FILES['photo']['tmp_name'], '../Profiles/'.$new_photo);

          try{
            $stmt = $db->prepare("UPDATE student SET image=:image WHERE student_id=:student_id");
            $stmt->execute(['image'=>$new_photo, 'student_id'=>$student_id]);
            $_SESSION['success'] = $names.' Image updated successfully';
      
          }
          catch(PDOException $e){
            $_SESSION['error'] = $e->getMessage();
          }
        }
        else{
          $new_filename1 = '';
        }
    
    }
	header('location: ./users.php');

    ?>