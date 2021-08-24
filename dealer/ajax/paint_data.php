<?php 
	include('../../config/db.php');

	if(isset($_POST['paint_id'])){
		$paint_id = $_POST['paint_id'];    
    //   $pro = "SELECT cat.name AS category_name,cat.description AS category_desc ,p.pid, p.catid, p.name AS paint_name, 
    //         p.price, p.status, p.vendorid, p.height, p.width, p.quantity, p.photoid, p.likes, p.madeDate, p.dateAdded,
    //         pho.fileName AS photo_name, pho.owner, ve.phone AS vendor_phone, ve.address AS vendor_address, 
    //         ve.logo AS vendor_logo, ve.businessName, ve.email AS vendor_email 
    //       FROM paintings p
  //         LEFT JOIN category cat ON p.catid = cat.catid
  //         LEFT JOIN vendor ve ON p.vendorid = ve.vendorid
  //         LEFT JOIN photo pho ON p.photoid = pho.photoid
  //         WHERE p.catid = :catid";
    $sql = "SELECT cat.name AS category_name,cat.description AS category_desc ,p.pid, p.catid, p.name AS paint_name, 
    p.price, p.status, p.vendorid, p.height, p.width, p.quantity, p.photoid, p.likes, p.madeDate, p.dateAdded,
    pho.fileName AS photo_name, pho.owner, ve.phone AS vendor_phone, ve.address AS vendor_address, 
    ve.logo AS vendor_logo, ve.businessName, ve.email AS vendor_email 
  FROM paintings p
            LEFT JOIN category cat ON p.catid = cat.catid
            LEFT JOIN vendor ve ON p.vendorid = ve.vendorid
            LEFT JOIN photo pho ON p.photoid = pho.photoid
            WHERE p.pid = :pid";
    $stmt = $db->prepare($sql);
    $stmt->execute(
        array(
            ':pid'=>$paint_id
            )
        );

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($row);
    // $photo_name = $row['photo_name'];
    // echo json_encode($photo_name);

	}
?>