<?php
	include("../../config/db.php");

	if(isset($_POST['add'])){
    $company = $_POST['company'];
    $email = $_POST['email'];
    $passw = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $password = password_hash($passw,PASSWORD_DEFAULT);
    $status = 'Activated';

    // generate RESET CODE through Random Generated code
    $length = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJQLMNOPQRSTUVWXYZ';
    $charLength = strlen($characters);
    $randomString = '';
    for($i=0; $i < $length; $i++){
      $randomString .= $characters[rand(0, $charLength-1)];
    }
    $resetCode = $randomString;

    // check PROFILE PICTURE INPUT FILE
    $tempPhoto = $_FILES['photo']['name'];

        if(!empty($tempPhoto)){
          $ext = pathinfo($tempPhoto, PATHINFO_EXTENSION);
          $photo = $firstname.'_'.rand(1000000000, 10000000000).'.'.$ext;
          move_uploaded_file($_FILES['photo']['tmp_name'], '../../img/profiles/'.$photo);
        }
        else{
          $photo = '';
        }

    // Check whether EMAIL or PHONE EXIST
      $sql = "SELECT * FROM deliverer WHERE email=:email";
      $stmt1 = $db->prepare($sql);
      $stmt1->execute(array(
        ':email'=> $email
      ));
      $sql2 = "SELECT * FROM deliverer WHERE phone=:phone";
      $stmt2 = $db->prepare($sql2);
      $stmt2->execute(array(
        ':phone'=> $phone
      ));
        if($stmt1->rowCount()>0){
          $_SESSION['error'] = "Try a different Email!";
        //   header("Location: ./register.php");
        }
        else if($stmt2->rowCount()>0){
          $_SESSION['error'] = "Try a different Phone Number!";
        //   header("Location: ./register.php");
        }else if($stmt2->rowCount()<1 && $stmt1->rowCount()<1){
          
          try{
            $stmt = $db->prepare("INSERT INTO deliverer( company, email, password, firstname, lastname, photo, address, phone, status, resetCode) values( :company, :email, :password, :firstname, :lastname, :photo, :address, :phone, :status, :resetCode)");
            $stmt->execute(['company'=>$company,'email'=>$email,'password'=>$password,'firstname'=>$firstname,'lastname'=>$lastname,'photo'=>$photo,'address'=>$address,'phone'=>$phone,'status'=>$status, 'resetCode'=>$resetCode]);
              
            $_SESSION['success'] = $firstname.' '.$lastname.' Deliverer Added Successfully!';
      
            // SEND EMAIL TO THE DELIVERER CONFIRMING THAT THE ACCOUNT CREATED SUCCESSFULLY
            include('sendMail.php');
        
          }
          catch(PDOException $e){
            $_SESSION['error'] = $e->getMessage();
          }
        }else{
          $_SESSION['error']= "Sorry! Try again";
      }
    
      $EmailLength = strlen($email);
      $maxChar = 14;
      $resi = substr_replace($email, ' .... ', $maxChar/7, $EmailLength-$maxChar);
  
  
  }else if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$email = $_POST['email'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$company = $_POST['company'];
		$currpass = $_POST['currentpassword'];
		$newpass = $_POST['newpassword'];
		$repass = $_POST['repassword'];
    $password = password_hash($newpass,PASSWORD_DEFAULT);
    if (!empty($currpass)){
      try{
        $chkp = $db->prepare("SELECT * FROM deliverer WHERE id=:id");
        
        $chkp->execute(['id'=>$id]);
        $prow = $chkp->fetch();
        if ($chkp->rowcount()>0) {
          if(password_verify($currpass, $prow['password'])){
            if (!empty($password)) {
              
              try{
                $stmt = $db->prepare("UPDATE deliverer SET company=:company, email=:email , password=:password, 
                                 firstname=:firstname, lastname=:lastname, address=:address, phone=:phone 
                                 WHERE id=:id");
                
                $stmt->execute([ 'company'=>$company, 'email'=>$email, 'password'=>$password,'firstname'=>$firstname,'lastname'=>$lastname, 'address'=>$address, 
                'phone'=>$phone, 'id'=>$id]);
                $_SESSION['success'] = 'Deliverer information Updated successfully';
          
              }
              catch(PDOException $e){
                $_SESSION['error'] = $e->getMessage();
              }
            }
          }else {
            $_SESSION['error'] = 'The Current Password You typed is Incorrect Please Re-type it Correctly!';
          }
        }
        
  
      }
      catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
      }
    }
    
     else {
      try{
        $stmt = $db->prepare("UPDATE deliverer SET company=:company, email=:email , firstname=:firstname, 
                            lastname=:lastname, address=:address, phone=:phone 
                         WHERE id=:id");
        
        $stmt->execute([ 'company'=>$company,'email'=>$email,'firstname'=>$firstname, 'lastname'=>$lastname,'address'=>$address, 
        'phone'=>$phone, 'id'=>$id]);
        $_SESSION['success'] = 'Deliverer information Updated successfully';
  
      }
      catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
      }
    }

    }else if(isset($_POST['deactivate'])){
      $id = $_POST['id'];
      $status = 'Deactivated';
      $fullname = $_POST['fullname'];
    
      try{
        $stmt = $db->prepare("UPDATE deliverer SET status=:status  WHERE id=:id");
        $stmt->execute(['status'=>$status, 'id'=>$id]);
          
        $_SESSION['success'] = $fullname.' Deliverer Deactivated!';
    
      }
      catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
      }
    
    }else if(isset($_POST['activate'])){
      $id = $_POST['id'];
      $status = 'Activated';
      $fullname = $_POST['fullname'];
    
      try{
        $stmt = $db->prepare("UPDATE deliverer SET status=:status  WHERE id=:id");
        $stmt->execute(['status'=>$status, 'id'=>$id]);
          
        $_SESSION['success'] = $fullname.' Deliverer Activated!';
    
      }
      catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
      }
    
    }else if(isset($_POST['uploadPhoto'])){
        // userImage
        $tempPhoto = $_FILES['photo']['name'];
        $id = $_POST['id'];
        $fullname = $_POST['fullname'];

        if(!empty($tempPhoto)){
          $ext = pathinfo($tempPhoto, PATHINFO_EXTENSION);
          $photo = $id.'_'.rand(1000000000, 10000000000).'.'.$ext;
          move_uploaded_file($_FILES['photo']['tmp_name'], '../../img/profiles/'.$photo);

          try{
            $stmt = $db->prepare("UPDATE deliverer SET photo=:photo WHERE id=:id");
            $stmt->execute(['photo'=>$photo, 'id'=>$id]);
            $_SESSION['success'] = $fullname.'  Changed photo successfully';
      
          }
          catch(PDOException $e){
            $_SESSION['error'] = $e->getMessage();
          }
        }
        else{
          $new_filename1 = '';
        }
    
    }
	header('location: ../deliverers.php');

    ?>