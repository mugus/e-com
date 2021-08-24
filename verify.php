<?php
include("./config/db.php");

if(isset($_GET['id']) && isset($_GET['code'])){
	$id=$_GET['id'];
	$code=$_GET['code'];
  $status = "Activated";
  $sql = "UPDATE users SET status = $status WHERE activate_code=$code AND id=$id";
	$ver = $db->query($sql);
	$ver->execute();
  if($ver->rowCount()==1){
    echo "<script language='javascript'>";
    echo "if(!alert('Account activated')){
      window.location.replace('./');
    }";
    echo "</script>";
  }else{
  echo "<script>alert('Our Error, Not Yours');</script>";
  }
}


?>