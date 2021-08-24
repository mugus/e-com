
<?php
include("../config/db.php");
?>
<?php if($_SESSION['admin']){ ?>
	<!DOCTYPE html>
	<html lang="en">
		<?php 
			include('includes/header.php');
		?>
    <?php

			// codes toretrieve all accepted clubs
			// $cstm = $db->query("SELECT * FROM club WHERE status='Accepted'");
			// $cstm->execute();
			// $crow = $cstm->fetch();
      // $acceptedClubs = $cstm->rowCount();
      // print_r($acceptedClubs);

			// codes toretrieve all rejected Requests clubs
			// $cstm2 = $db->query("SELECT * FROM club WHERE status='Rejected'");
			// $cstm2->execute();
			// $crow2 = $cstm2->fetch();
      // $rejectedClubs = $cstm2->rowCount();
      // print_r($rejectedClubs);

			// codes toretrieve all Pending Requests of new clubs Creation
			// $cstm3 = $db->query("SELECT * FROM club WHERE status='TODOS'");
			// $cstm3->execute();
			// $crow3 = $cstm3->fetch();
      // $pendingClubs = $cstm3->rowCount();

			// codes toretrieve all Pending Events
      // $todayDate = date('Y-m-d');
			// $cstm3b = $db->query("SELECT * FROM event WHERE date>=$todayDate");
			// $cstm3b->execute();
			// $crow3b = $cstm3b->fetch();
      // $pendingEvents= $cstm3b->rowCount();

			// codes toretrieve all students in clubs
			// $cstm4 = $db->query("SELECT * FROM student s JOIN membership m ON s.student_id=m.member GROUP BY m.member");
			// $cstm4->execute();
			// $crow4 = $cstm4->fetch();
      // $studentsInClubs = $cstm4->rowCount();

			// codes toretrieve all students in general
			// $cstm5 = $db->query("SELECT * FROM student");
			// $cstm5->execute();
			// $crow5 = $cstm5->fetch();
      // $studentsInGeneral = $cstm5->rowCount();
		?>
	<body>
		<div class="wrapper">
			<!-- sidebar start here -->
			<?php 
				include('includes/sidebar.php');
			?>

			<!-- sidebar end here -->

			<!-- main holder div of body content start here -->
			<div class="main">
				<!-- naviagtion bar start here -->
				<?php 
					include('includes/navbar.php');
				?>

        <main class="content">
					<div class="container-fluid p-0">

						<div class="row mb-2 mb-xl-3">
							<div class="col-auto d-none d-sm-block">
								<h3> Dashboard</h3>
							</div>

							<div class="col-auto ml-auto text-right mt-n1">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
										<li class="breadcrumb-item"><a href="#">SCMS</a></li>
										<li class="breadcrumb-item"><a href="index.php">Dashboards</a></li>
										<!-- <li class="breadcrumb-item active" aria-current="page">Analytics</li> -->
									</ol>
								</nav>
							</div>
						</div>
						<div class="row">
							<div class="col-xl-12 col-xxl-10 d-flex">
								<div class="w-100">
									<div class="row">
										<div class="col-sm-4">
											<div class="card">
												<div class="card-body">
													<h5 class="card-title mb-4">All Registered Students</h5>
													<h1 class="display-5 mt-1 mb-3"><?php print_r($studentsInGeneral); ?></h1>
													<div class="mb-1">
														<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> <a class="text-danger" href="ReportStudent.php"> Read</a> </span>
														<span class="text-muted">More</span>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-body">
													<h5 class="card-title mb-4">Pending Events</h5>
													<h1 class="display-5 mt-1 mb-3"><?php print_r($pendingEvents); ?></h1>
													<div class="mb-1">
														<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> <a class="text-danger" href="ReportEvents.php"> Read</a></span>
														<span class="text-muted">More</span>
                            <!-- $pendingEvents -->
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="card">
												<div class="card-body">
													<h5 class="card-title mb-4">Allowed Clubs</h5>
													<h1 class="display-5 mt-1 mb-3"><?php print_r($acceptedClubs); ?></h1>
													<div class="mb-1">
														<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> <a class="text-danger" href="ReportAllowed.php"> Read</a> </span>
														<span class="text-muted">More</span>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-body">
													<h5 class="card-title mb-4">Pending Club Requests</h5>
													<h1 class="display-5 mt-1 mb-3"><?php print_r($pendingClubs); ?></h1>
													<div class="mb-1">
														<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> <a class="text-danger" href="ReportPending.php"> Read</a></span>
														<span class="text-muted">More</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="card">
												<div class="card-body">
													<h5 class="card-title mb-4">Rejected Club Requests</h5>
													<h1 class="display-5 mt-1 mb-3"><?php print_r($rejectedClubs); ?></h1>
													<div class="mb-1">
														<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> <a class="text-danger" href="ReportRejected.php"> Read</a></span>
														<span class="text-muted">More</span>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-body">
													<h5 class="card-title mb-4">Students in Clubs</h5>
													<h1 class="display-5 mt-1 mb-3"><?php print_r($studentsInClubs); ?></h1>
													<div class="mb-1">
														<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> <a class="text-danger" href="ReportInclub.php"> Read</a></span>
														<span class="text-muted">More</span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- <div class="col-xl-6 col-xxl-7">
							</div> -->
						</div>

						<div class="row">
							<div class="col-6 col-md-6 col-xxl-3 d-flex">
								<div class="card flex-fill w-100">
									<div class="card-header">

										<h5 class="card-title mb-0">Created Clubs Statistics</h5>
									</div>
									<div class="card-body d-flex w-100">
										<div class="align-self-center chart chart-lg">
											<canvas id="chartjs-dashboard-bar2"></canvas>
										</div>
									</div>
								</div>
							</div>
							<!-- <div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
								<div class="card flex-fill w-100">
									<div class="card-header">

										<h5 class="card-title mb-0">Real-Time</h5>
									</div>
									<div class="card-body px-4">
										<div id="world_map" style="height:350px;"></div>
									</div>
								</div>
							</div>
							<div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-1">
								<div class="card flex-fill">
									<div class="card-header">

										<h5 class="card-title mb-0">Calendar</h5>
									</div>
									<div class="card-body d-flex">
										<div class="align-self-center w-100">
											<div class="chart">
												<div id="datetimepicker-dashboard"></div>
											</div>
										</div>
									</div>
								</div>
							</div> -->
						</div>

						<!-- <div class="row">
							<div class="col-12 col-lg-8 col-xxl-9 d-flex">
								<div class="card flex-fill">
									<div class="card-header">

										<h5 class="card-title mb-0">Latest Projects</h5>
									</div>
									<table class="table table-hover my-0">
										<thead>
											<tr>
												<th>Name</th>
												<th class="d-none d-xl-table-cell">Start Date</th>
												<th class="d-none d-xl-table-cell">End Date</th>
												<th>Status</th>
												<th class="d-none d-md-table-cell">Assignee</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Project Apollo</td>
												<td class="d-none d-xl-table-cell">01/01/2020</td>
												<td class="d-none d-xl-table-cell">31/06/2020</td>
												<td><span class="badge badge-success">Done</span></td>
												<td class="d-none d-md-table-cell">Vanessa Tucker</td>
											</tr>
											<tr>
												<td>Project Fireball</td>
												<td class="d-none d-xl-table-cell">01/01/2020</td>
												<td class="d-none d-xl-table-cell">31/06/2020</td>
												<td><span class="badge badge-danger">Cancelled</span></td>
												<td class="d-none d-md-table-cell">William Harris</td>
											</tr>
											<tr>
												<td>Project Hades</td>
												<td class="d-none d-xl-table-cell">01/01/2020</td>
												<td class="d-none d-xl-table-cell">31/06/2020</td>
												<td><span class="badge badge-success">Done</span></td>
												<td class="d-none d-md-table-cell">Sharon Lessman</td>
											</tr>
											<tr>
												<td>Project Nitro</td>
												<td class="d-none d-xl-table-cell">01/01/2020</td>
												<td class="d-none d-xl-table-cell">31/06/2020</td>
												<td><span class="badge badge-warning">In progress</span></td>
												<td class="d-none d-md-table-cell">Vanessa Tucker</td>
											</tr>
											<tr>
												<td>Project Phoenix</td>
												<td class="d-none d-xl-table-cell">01/01/2020</td>
												<td class="d-none d-xl-table-cell">31/06/2020</td>
												<td><span class="badge badge-success">Done</span></td>
												<td class="d-none d-md-table-cell">William Harris</td>
											</tr>
											<tr>
												<td>Project X</td>
												<td class="d-none d-xl-table-cell">01/01/2020</td>
												<td class="d-none d-xl-table-cell">31/06/2020</td>
												<td><span class="badge badge-success">Done</span></td>
												<td class="d-none d-md-table-cell">Sharon Lessman</td>
											</tr>
											<tr>
												<td>Project Romeo</td>
												<td class="d-none d-xl-table-cell">01/01/2020</td>
												<td class="d-none d-xl-table-cell">31/06/2020</td>
												<td><span class="badge badge-success">Done</span></td>
												<td class="d-none d-md-table-cell">Christina Mason</td>
											</tr>
											<tr>
												<td>Project Wombat</td>
												<td class="d-none d-xl-table-cell">01/01/2020</td>
												<td class="d-none d-xl-table-cell">31/06/2020</td>
												<td><span class="badge badge-warning">In progress</span></td>
												<td class="d-none d-md-table-cell">William Harris</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="col-12 col-lg-4 col-xxl-3 d-flex">
								<div class="card flex-fill w-100">
									<div class="card-header">

										<h5 class="card-title mb-0">Monthly Sales</h5>
									</div>
									<div class="card-body d-flex w-100">
										<div class="align-self-center chart chart-lg">
											<canvas id="chartjs-dashboard-bar"></canvas>
										</div>
									</div>
								</div>
							</div>
						</div> -->

					</div>
				</main>
				<?php 
					include('includes/footer.php');
				?>
      <?php
      // Created clubs statistics Codes
      // try {
      //   $crtdClubs = $db->prepare("SELECT * FROM club");
      //   $crtdClubs->execute();
        
      //   $clbCreatedTotal = 0;
      //   // $clbTotal = 0;
      //   $m1 = 0; $m2 = 0; $m3 = 0; $m4 = 0;
      //   $m5 = 0; $m6 = 0; $m7 = 0; $m8 = 0;
      //   $m9 = 0; $m10 = 0; $m11 = 0; $m12 = 0;
      //   while($mx= $crtdClubs->fetch(PDO::FETCH_ASSOC)){
          
      //     try {
      //       $thisyear = date('Y-m-d');
      //       $stclb = $db->prepare("SELECT * FROM club WHERE startDate=:thisyear");
      //       $stclb->execute(['thisyear'=>$thisyear]);
      //       $nbclb= $stclb->fetch();
        
      //       if($stclb->rowCount() > 0){
      //         $clbCreatedTotal = $stclb->rowCount();
              
      //       }
      //     } catch(PDOException $e){
      //       $_SESSION['error'] = $e->getMessage();
      //     }
      //     $thisYr = date('Y');
      //     $fetchedYr = date('Y',strtotime($mx['startDate']));
      //     if ($thisYr==$fetchedYr) {
      //       switch (date('M',strtotime($mx['startDate']))) {
      //         case 'Jan':
      //           $m1 = $m1 +1;
      //           $clbCreatedTotal -= 1;
      //           break;
      //         case 'Feb':
      //           $m2 = $m2 +1;
      //           $clbCreatedTotal -= 1;
      //           break;
      //         case 'Mar':
      //           $m3 = $m3 +1;
      //           $clbCreatedTotal -= 1;
      //           break;
      //         case 'Apr':
      //           $m4 = $m4 +1;
      //           $clbCreatedTotal -= 1;
      //           break;
      //         case 'May':
      //           $m5 = $m5 +1;
      //           $clbCreatedTotal -= 1;
      //           break;
      //         case 'Jun':
      //           $m6 = $m6 +1;
      //           $clbCreatedTotal -= 1;
      //           break;
      //         case 'Jul':
      //           $m7 = $m7 +1;
      //           $clbCreatedTotal -= 1;
      //           break;
      //         case 'Aug':
      //           $m8 = $m8 +1;
      //           $clbCreatedTotal -= 1;
      //           break;
      //         case 'Sep':
      //           $m9 = $m9 +1;
      //           $clbCreatedTotal -= 1;
      //           break;
      //         case 'Oct':
      //           $m10 = $m10 +1;
      //           $clbCreatedTotal -= 1;
      //           break;
      //         case 'Nov':
      //           $m11 = $m11 +1;
      //           $clbCreatedTotal -= 1;
      //           break;
      //         case 'Dec':
      //           $m12 = $m12 +1;
      //           $clbCreatedTotal -= 1;
      //           break;
              
      //         default:
      //           # code...
      //           break;
      //       }
      //     }
      //   }
        
        
    
        
      // } catch(PDOException $e){
      //   $_SESSION['error'] = $e->getMessage();
      // }
       ?>
      <script>
          $(function() {
            var ctxx = document.getElementById('chartjs-dashboard-bar2').getContext("2d");
            var gradient2 = ctxx.createLinearGradient(0, 0, 0, 225);
            gradient2.addColorStop(0, 'rgba(215, 227, 244, 1)');
            gradient2.addColorStop(1, 'rgba(215, 227, 244, 0)');
            // Line chart
            new Chart(document.getElementById("chartjs-dashboard-bar2"), {
              type: 'bar',
              data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                  label: "Created Clubs",
                  fill: true,
                  backgroundColor: window.theme.primary,
                  borderColor: window.theme.primary,
                  hoverBackgroundColor: window.theme.primary,
                  hoverBorderColor: window.theme.primary,
                  data: [
                    <?=$m1?>,
                    <?=$m2?>,
                    <?=$m3?>,
                    <?=$m4?>,
                    <?=$m5?>,
                    <?=$m6?>,
                    <?=$m7?>,
                    <?=$m8?>,
                    <?=$m9?>,
                    <?=$m10?>,
                    <?=$m11?>,
                    <?=$m12?>
                  ],
                  barPercentage: .75,
                  categoryPercentage: .5
                }]
              },
              options: {
                maintainAspectRatio: false,
                legend: {
                  display: true
                },
                scales: {
                  yAxes: [{
                    gridLines: {
                      display: false
                    },
                    stacked: false,
                    ticks: {
                      stepSize: 20
                    }
                  }],
                  xAxes: [{
                    stacked: false,
                    gridLines: {
                      color: "transparent"
                    }
                  }]
                }
              }
            });
          });
        </script>
	</body>

	</html>

<?php 
}else{
	header('Location: ../login.php');
	} 
	?>