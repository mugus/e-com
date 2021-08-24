<?php
		//Query to check loogein user data
		$usq = "SELECT * FROM admins WHERE email = :email";
		$ures = $db->prepare($usq);
		$ures->execute(
			array(
				':email' => $_SESSION['admin']
			)
		);
		$user=$ures->fetch(PDO::FETCH_ASSOC);
?>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Web UI Kit &amp; Dashboard Template based on Bootstrap">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, web ui kit, dashboard template, admin template">

	<link rel="shortcut icon" href="img/icons/logoWithBg.png" />

	<title>Admin &amp; Dashboard</title>

	<link href="css/app.css" rel="stylesheet">
	
    <!-- Custom CSS  for validation-->
    <link rel="stylesheet" href="../css/custom.css">

  	<!-- DataTables -->
	<link rel="stylesheet" href="./DataTables/datatables.css">
</head>