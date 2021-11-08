<?php 
session_start();
include("./database/db.php");

if(isset($_GET['code'])){
	$code=$_GET['code'];
	$id=$_GET['code'].'-'.uniqid();
	$t = "SELECT * FROM users WHERE un_id=:un_id";
	$ver = $db->prepare($t);
	$ver->execute(
    array(
      'un_id'=> $code
    )
  );

  if($ver->rowCount()==1){
    $sql="UPDATE users SET status_code = 1, un_id = :id WHERE un_id=:un_id";
    $update = $db->prepare($sql);
    $update->execute(array(
      'un_id'=> $code,
      ':id'=> $id
    ));
    echo "<script language='javascript'>";
    echo "if(!alert('Account activated')){
      window.location.replace('./login');
    }";
    echo "</script>";
  }else{
  echo "<script>alert('Error! Code is Expired');</script>";
  }

}



if(isset($_GET['un_code'])){
	$un_code=$_GET['un_code'];
	$t = "SELECT * FROM users WHERE un_id=:un_id";
	$ver = $db->prepare($t);
	$ver->execute(
    array(
      'un_id'=> $un_code
    )
  );
	$row=$ver->fetch(PDO::FETCH_ASSOC);
  $email = $row['email'];
  if($ver->rowCount()==1){
    $_SESSION['new_pass'] = $email;
    header('Location: ./set_new_pass.php');
  }else{
    echo "<script>alert('Error! Code is Expired');</script>";
  }

}

?>
