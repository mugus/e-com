<?php 
	include('../../config/db.php');

  $id = $_POST['id'];
  $query = "SELECT * FROM paintings WHERE pid = :pid";
  $dele = $db->prepare($query);
  $dele->execute(array(':pid' => $id));
  $row = $dele->fetch(PDO::FETCH_ASSOC);
  if($dele->rowCount() > 0){
    echo json_encode($row);
  }else{
    echo "Not Found";
  }

?>