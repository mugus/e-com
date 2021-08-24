<?php
			
			//Query to check loogein user data
		$usq = "SELECT * FROM vendor WHERE vendorid = :vendorid";
		$ures = $db->prepare($usq);
		$ures->execute(
			array(
				':vendorid' => $_SESSION['vendorid']
			)
		);
		$user=$ures->fetch(PDO::FETCH_ASSOC);


	//Query to check all categories
	$cat = "SELECT * FROM category";
	$category = $db->prepare($cat);
	$category->execute();
	// $categories=$category->fetch(PDO::FETCH_ASSOC);




	// Get Category By ID
	if(isset($_GET['category_id'])){
		// $catid = $_GET['category_id'];
		$_SESSION['category_id'] = $_GET['category_id'];
		header('Location: ./products.php');
	}
	?>


<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Web UI Kit &amp; Dashboard Template based on Bootstrap">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, web ui kit, dashboard template, admin template">

	<link rel="shortcut icon" href="img/icons/logoWithBg.png" />

	<title>Dealer &amp; Dashboard</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="css/cardstyle.css" rel="stylesheet">
	<link href="css/owl.carousel.min.css" rel="stylesheet">
	

  	<!-- DataTables -->
	<link rel="stylesheet" href="./DataTables/datatables.css">
</head>