<!DOCTYPE html>
<?php
include("../config/db.php");
?>
<?php 
      $photoid = $_GET['painting'];
      $catid = $_GET['category'];
      $tech_id = $_GET['technic'];
      $vendorid = $_GET['vendor'];
  ?>

<?php

if(isset($_POST['add_new_painting_image'])){
  
  $photo = $_FILES['photo_id']['name'];
  $owner = 'Painting';


  if(!empty($photo)){
    $randCode = rand(10, 360780);
    $ext = pathinfo($photo, PATHINFO_EXTENSION);
    $fileName = $catid.'_'.time().''.$tech_id.''.$vendorid.'_pic.'.$ext;
    $allowed = array('png', 'jpg', 'jpeg', 'gif', 'PNG', 'JPG', 'JPEG', 'GIF');
    // photo attached
    if (!in_array($ext, $allowed)) {
			$alert_class = "class='alert alert-info alert-dismissable alert-sm'";
			$result = "<small>Valid image formats are .png, .jpeg or .jpg! Try again</small>";
      $msg = "<strong>Ooops!</strong>";
    }else{
      if(move_uploaded_file($_FILES['photo_id']['tmp_name'], "./Photos/Paintings/".$fileName)){
        // verify if The Painting we GET exist
        $sql = "SELECT * FROM paintings WHERE photoid=:painting";
        $stmt = $db->prepare($sql);
        $stmt->execute(
          array(
            'painting'=>$photoid
          )
        );
        if($stmt->rowCount() > 0){
          $pho = "INSERT INTO photo ( photoid, fileName, owner) 
          VALUES (:photoid, :fileName, :owner)";
          $photoStmt = $db->prepare($pho);
          $photoStmt->execute(
            array(
              'photoid'=>$photoid,
              'fileName'=>$fileName,
              'owner'=>$owner
            )
          );
          if($photoStmt->rowCount() > 0){
            $alert_class = "class='alert alert-info alert-dismissable alert-sm'";
            $result = "<small>Painting is recorded successfully</small>";
            $msg = "<strong>Congratulations!</strong>";
            header('Location: ./add_product_image.php?painting='.$photoid.'&category='.$catid.'&technic='.$tech_id.'&vendor='.$vendorid);
          }else{
            $alert_class = "class='alert alert-info alert-dismissable alert-sm'";
            $result = "<small>Painting is recorded successfully, But There is an Image Error!!!</small>";
            $msg = "<strong>Congratulations!</strong>";
            header('Location: ./add_product_image.php?painting='.$photoid.'&category='.$catid.'&technic='.$tech_id.'&vendor='.$vendorid);
          }
          
        }else{
        $alert_class = "class='alert alert-danger alert-dismissable alert-sm'";
        $result = "<small>Our Errors! Contact us</small>";
        $msg = "<strong>Ooops!</strong>";
        header('Location: ./add_product.php');
        }
      }
    }
  }else{
    $alert_class = "class='alert alert-danger alert-dismissable alert-sm'";
    $result = "<small>Photo is required</small>";
    $msg = "<strong>Ooops!</strong>";
    header('Location: ./add_product_image.php?painting='.$photoid.'&category='.$catid.'&technic='.$tech_id.'&vendor='.$vendorid);
  }



}
else if(isset($_POST['finish_add_new_painting_image'])){
  
  $photo = $_FILES['photo_id']['name'];
  $owner = 'Painting';


  if(!empty($photo)){
    $randCode = rand(10, 360780);
    $ext = pathinfo($photo, PATHINFO_EXTENSION);
    $fileName = $catid.'_'.time().''.$tech_id.''.$vendorid.'_pic.'.$ext;
    $allowed = array('png', 'jpg', 'jpeg', 'gif', 'PNG', 'JPG', 'JPEG', 'GIF');
    // photo attached
    if (!in_array($ext, $allowed)) {
			$alert_class = "class='alert alert-info alert-dismissable alert-sm'";
			$result = "<small>Valid image formats are .png, .jpeg or .jpg! Try again</small>";
      $msg = "<strong>Ooops!</strong>";
    }else{
      if(move_uploaded_file($_FILES['photo_id']['tmp_name'], "./Photos/Paintings/".$fileName)){
        // verify if The Painting we GET exist
        $sql = "SELECT * FROM paintings WHERE photoid=:painting";
        $stmt = $db->prepare($sql);
        $stmt->execute(
          array(
            'painting'=>$photoid
          )
        );
        if($stmt->rowCount() > 0){
          $pho = "INSERT INTO photo ( photoid, fileName, owner) 
          VALUES (:photoid, :fileName, :owner)";
          $photoStmt = $db->prepare($pho);
          $photoStmt->execute(
            array(
              'photoid'=>$photoid,
              'fileName'=>$fileName,
              'owner'=>$owner
            )
          );
          if($photoStmt->rowCount() > 0){
            $alert_class = "class='alert alert-info alert-dismissable alert-sm'";
            $result = "<small>Painting is recorded successfully</small>";
            $msg = "<strong>Congratulations!</strong>";
            header('Location: ./add_product.php');
          }else{
            $alert_class = "class='alert alert-info alert-dismissable alert-sm'";
            $result = "<small>Painting is recorded successfully, But There is an Image Error!!!</small>";
            $msg = "<strong>Congratulations!</strong>";
            header('Location: ./add_product_image.php?painting='.$photoid.'&category='.$catid.'&technic='.$tech_id.'&vendor='.$vendorid);
          }
          
        }else{
        $alert_class = "class='alert alert-danger alert-dismissable alert-sm'";
        $result = "<small>Our Errors! Contact us</small>";
        $msg = "<strong>Ooops!</strong>";
        header('Location: ./add_product.php');
        }
      }
    }
  }else{
    $alert_class = "class='alert alert-danger alert-dismissable alert-sm'";
    $result = "<small>Photo is required</small>";
    $msg = "<strong>Ooops!</strong>";
    header('Location: ./add_product_image.php?painting='.$photoid.'&category='.$catid.'&technic='.$tech_id.'&vendor='.$vendorid);
  }



}
?>


<?php
if(isset($_SESSION['vendor'])): 
?>

<html lang="en">
  <?php 
    include('./includes/header.php');
  ?>
	<body>
		<div class="wrapper">
			<!-- sidebar start here -->
			<?php 
				include('./includes/sidebar.php');
			?>
      		<div class="main">
            <!-- naviagtion bar start here -->
            <?php 
              include('includes/navbar.php');
            ?>
            <main class="content">
					    <div class="container-fluid p-0">

                <div class="row mb-2 mb-xl-3">
                  <div class="col-auto d-none d-sm-block">
                    <h3 class="text-muted">Please Add Images of New Painting</h3>
                  </div>
                  <div class="col-auto ml-auto text-right mt-n1">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                        <li class="breadcrumb-item"><a href="#">PSOMS</a></li>
                        <li class="breadcrumb-item"><a href="index.php">Dashboards</a></li>
                      </ol>
                    </nav>
                  </div>
                </div>

                <?php 
                  include('contents/new_product_image.php');
                ?>

              </div>
            </main>

  <?php include('./includes/footer.php'); ?>
  </body>
</html>
<?php else: ?>
  <script LANGUAGE='JavaScript'>
    window.location.href='../login.php';
  </script>
<?php endif ?>