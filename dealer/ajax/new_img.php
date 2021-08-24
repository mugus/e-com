<?php 
	include('../../config/db.php');


  if($_FILES["new_image"]["name"] != ''){
    $photoid = $_POST["photoid"];
    $test = explode('.', $_FILES["new_image"]["name"]);
    $ext = end($test);
    $name = rand(10, 909099).''.time().'.'.$ext;
    $location = '../Photos/Paintings/'.$name;
    $vendorid = htmlspecialchars(strip_tags($_SESSION['vendorid']));

      $sql = "SELECT * FROM photo WHERE photoid = :photoid";
      $stmt = $db->prepare($sql);
      $stmt->execute(
        array(
          'photoid'=>$photoid
        )
      );
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      // $imgname = $row['fileName'];
      if($stmt->rowCount() < 3){
        if(move_uploaded_file($_FILES['new_image']['tmp_name'], $location)){
          $sql = "INSERT INTO photo ( photoid, fileName, owner) VALUES (:photoid, :fileName, :owner)";
          $stmt = $db->prepare($sql);
          $stmt->execute(
            array(
              'photoid'=>$photoid,
              'fileName'=>$name,
              'owner'=>$vendorid
            )
          );
          if($stmt->rowCount() > 0){
            echo "<small class='text-success'>Image Added</small>";
          }else{
            echo "<small class='text-danger'>Error Image not added</small>";
          }
        }
      }else{
        echo "<small class='text-danger'>You reach to max image you allowed to add</small>";
      }
      // print_r();
      // echo "Uploaded and id".$photoid;

  }

?>