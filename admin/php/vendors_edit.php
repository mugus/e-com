<?php
	include("../../config/db.php");

	if(isset($_POST['addVendor'])){
    $email = $_POST['email'];
    $passw = $_POST['vendorPassword'];
    $businessName = $_POST['businessName'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $password = password_hash($passw,PASSWORD_DEFAULT);
    $status = 'Activated';

    // check LOGO INPUT FILE
    $photo = $_FILES['logo']['name'];

        if(!empty($photo)){
          $ext = pathinfo($photo, PATHINFO_EXTENSION);
          $logo = $businessName.'_'.rand(1000000000, 10000000000).'.'.$ext;
          move_uploaded_file($_FILES['logo']['tmp_name'], '../../img/vendorLogo/'.$logo);
        }
        else{
          $logo = '';
        }

    // Check whether EMAIL or  BUSINESS NAME EXIST
      $sql = "SELECT * FROM vendor WHERE email=:email";
      $stmt1 = $db->prepare($sql);
      $stmt1->execute(array(
        ':email'=> $email
      ));
      $sql2 = "SELECT * FROM vendor WHERE businessName=:businessName";
      $stmt2 = $db->prepare($sql2);
      $stmt2->execute(array(
        ':businessName'=> $businessName
      ));
        if($stmt1->rowCount()>0){
          $_SESSION['error'] = "Try a different Email!";
        //   header("Location: ./register.php");
        }
        else if($stmt2->rowCount()>0){
          $_SESSION['error'] = "Try a different Business Name!";
        //   header("Location: ./register.php");
        }else if($stmt2->rowCount()<1 && $stmt1->rowCount()<1){
          
          try{
            $stmt = $db->prepare("INSERT INTO vendor( email, password, businessName, logo, address, phone, status) values( :email, :password, :businessName, :logo, :address, :phone, :status)");
            $stmt->execute(['email'=>$email,'password'=>$password,'businessName'=>$businessName,'logo'=>$logo,'address'=>$address,'phone'=>$phone,'status'=>$status]);
              
            $_SESSION['success'] = $lastname.' Vendor Added Successfully!';
      
            // SEND EMAIL TO THE STUDENT CONFIRMING THE ACCOUNT CREATED SUCCESSFULLY
            include('sendMail.php');
        
          }
          catch(PDOException $e){
            $_SESSION['error'] = $e->getMessage();
          }
        }else{
          $_SESSION['error']= "Sorry! Try again";
      //   echo "<script>window.alert('Sorry! Try again');</script>";
      }
    
      $EmailLength = strlen($email);
      $maxChar = 14;
      $resi = substr_replace($email, ' .... ', $maxChar/7, $EmailLength-$maxChar);
  
  
  }else if(isset($_POST['edit'])){
		$vendorid = $_POST['editVendorid'];
		$email = $_POST['email'];
		$businessName = $_POST['businessName'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$currpass = $_POST['currentpassword'];
		$newpass = $_POST['newpassword'];
		$repass = $_POST['repassword'];
    $password = password_hash($newpass,PASSWORD_DEFAULT);
    if (!empty($currpass)){
      try{
        $chkp = $db->prepare("SELECT * FROM vendor WHERE vendorid=:vendorid");
        
        $chkp->execute(['vendorid'=>$vendorid]);
        $prow = $chkp->fetch();
        if ($chkp->rowcount()>0) {
          if(password_verify($currpass, $prow['password'])){
            if (!empty($password)) {
              
              try{
                $stmt = $db->prepare("UPDATE vendor SET email=:email , password=:password, 
                                 businessName=:businessName, address=:address, phone=:phone 
                                 WHERE vendorid=:vendorid");
                
                $stmt->execute([ 'email'=>$email, 'password'=>$password,'businessName'=>$businessName, 'address'=>$address, 
                'phone'=>$phone, 'vendorid'=>$vendorid]);
                $_SESSION['success'] = 'Vendor information Updated successfully';
          
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
        $stmt = $db->prepare("UPDATE vendor SET email=:email , businessName=:businessName, address=:address, phone=:phone 
                         WHERE vendorid=:vendorid");
        
        $stmt->execute([ 'email'=>$email,'businessName'=>$businessName, 'address'=>$address, 
        'phone'=>$phone, 'vendorid'=>$vendorid]);
        $_SESSION['success'] = 'Vendor information Updated successfully';
  
      }
      catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
      }
    }

    }else if(isset($_POST['deactivate'])){
      $vendorid = $_POST['vendorid'];
      $status = 'Deactivated';
      $businessName = $_POST['businessName'];
    
      try{
        $stmt = $db->prepare("UPDATE vendor SET status=:status  WHERE vendorid=:vendorid");
        $stmt->execute(['status'=>$status, 'vendorid'=>$vendorid]);
          
        $_SESSION['success'] = $businessName.' Vendor Deactivated!';
    
      }
      catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
      }
    
    }else if(isset($_POST['activate'])){
      $vendorid = $_POST['vendorid'];
      $status = 'Activated';
      $businessName = $_POST['businessName'];
    
      try{
        $stmt = $db->prepare("UPDATE vendor SET status=:status  WHERE vendorid=:vendorid");
        $stmt->execute(['status'=>$status, 'vendorid'=>$vendorid]);
          
        $_SESSION['success'] = $businessName.' Vendor Activated!';
    
      }
      catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
      }
    
    }else if(isset($_POST['uploadPhoto'])){
        // userImage
        $photo = $_FILES['logo']['name'];
        $vendorid = $_POST['vendorid'];
        $businessName = $_POST['businessName'];

        if(!empty($photo)){
          $ext = pathinfo($photo, PATHINFO_EXTENSION);
          $logo = $businessName.'_'.rand(1000000000, 10000000000).'.'.$ext;
          move_uploaded_file($_FILES['logo']['tmp_name'], '../../img/vendorLogo/'.$logo);

          try{
            $stmt = $db->prepare("UPDATE vendor SET logo=:logo WHERE vendorid=:vendorid");
            $stmt->execute(['logo'=>$logo, 'vendorid'=>$vendorid]);
            $_SESSION['success'] = $businessName.' Logo Changed successfully';
      
          }
          catch(PDOException $e){
            $_SESSION['error'] = $e->getMessage();
          }
        }
        else{
          $new_filename1 = '';
        }
    
    }
	header('location: ../vendors.php');

    ?>