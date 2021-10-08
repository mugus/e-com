<?php 
include("./database/db.php");

if(isset($_GET['id']) && isset($_GET['code'])){
	$code=$_GET['code'];
	$t = "SELECT * FROM users WHERE un_id=:un_id";
	$ver = $db->prepare($t);
	$ver->execute(
    array(
      'un_id'=> $code
    )
  );

  if($ver->rowCount()==1){
    $sql="UPDATE users SET status_code = 1 WHERE un_id=:un_id";
    $update = $db->prepare($sql);
    $update->execute(array(
      'un_id'=> $code
    ));
    echo "<script language='javascript'>";
    echo "if(!alert('Account activated')){
      window.location.replace('./login');
    }";
    echo "</script>";
  }else{
  echo "<script>alert('Error!');</script>";
  }

}

?>
