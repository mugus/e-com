<?php
include("../config/db.php");
?>

<?php if($_SESSION['admin']){ ?>

<!DOCTYPE html>
<html lang="en">
	<?php 
		include('includes/header.php');
	?>

<body>
  <style>
    
    .box-header .with-border {
      border-bottom: 1px solid #f4f4f4;
    }
  </style>
	<div class="wrapper">
		<!-- sidebar start here -->
		<?php 
			include('includes/sidebar.php');
		?>

		<!-- sidebar end here -->

		<div class="main">
			
			<!-- naviagtion bar start here -->
			<?php 
				include('includes/navbar.php');
			?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Customers Page</h1>

					<div class="row">
						<div class="col-lg-12">
							<div class="card" >
                                <!-- header of div and messages part style='background:greenyellow;'-->
								<div class="card-header">
									<h5 class="card-title mb-0">General List of Customers</h5>
                  <div class="row">
                    <div class="col-md-12" style="height:40px;">
                      <?php
                          if(isset($_SESSION['error'])){
                          echo "
                              <div class='alert alert-danger alert-dismissible' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                                </button>
                                <div class='alert-icon'>
                                  <i class='fa fa-fw fa-warning'></i>
                                </div>
                                <div class='alert-message'>
                                  <strong>Error! </strong> ".$_SESSION['error']."
                                </div>
                              </div>
                          ";
                          unset($_SESSION['error']);
                          }
                          if(isset($_SESSION['success'])){
                          echo "
                              <div class='alert alert-success alert-dismissible' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                                </button>
                                <div class='alert-icon'>
                                  <i class='fa fa-fw fa-check'></i>
                                </div>
                                <div class='alert-message'>
                                  <strong>Well Done! </strong> ".$_SESSION['success']."
                                </div>
                              </div>
                          ";
                          unset($_SESSION['success']);
                          }
                      ?>
                    </div>
                  </div>
								</div>
                  <!-- content div body -->
                <div class="col-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="box table-responsive">
                        <div class="box-header with-border" style='text-align:center;'>
                            <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
                        </div>
                          <table id="example1" class="table table-bordered mb-0">
                            <thead>
                              <th scope="col">Photo</th>
                              <th scope="col">Name</th>
                              <th scope="col">Email</th>
                              <th scope="col">Status</th>
                              <th scope="col">Type</th>
                              <th scope="col">Date Added</th>
                              <th scope="col">Tools</th>
                            </thead>
                            <tbody>
                              <?php
                                  try{
                                  $stmt = $db->prepare("SELECT * FROM  users  ORDER BY id DESC");
                                  $stmt->execute();
                                  $is_empty = $stmt->rowCount();
                                  if(!empty($is_empty)){
                                    foreach($stmt as $row){
                                        // if ($row['role']==3) {
                                        // $rolefinal = 'Guild President';
                                        // }else if ($row['role']==2) {
                                        // $rolefinal = 'Club Leader';
                                        // }else{
                                          // }
                                          $rolefinal = 'CUSTOMER';
                                        $photo = (!empty($row['photo'])) ? '../Profiles/'.$row['photo'] : '../Profiles/profile.png';
                                        $status = ($row['status']) ? '<span class="label label-success">active</span>' : '<span class="label label-danger">not verified</span>';
                                        $active = (!$row['status']) ? '<span class="pull-right"><a href="#activate" class="status" data-toggle="modal" data-id="'.$row['id'].'"><i class="fa fa-check-square-o"></i></a></span>' : '';
                                        echo "
                                        <tr>
                                            <td>
                                            <img src='".$photo."' height='30px' width='30px'>
                                            <span class='pull-right'><a href='#edit_photo' class='photo' data-toggle='modal' data-id='".$row['id']."'><i class='fa fa-edit'></i></a></span>
                                            </td>
                                            <td>".$row['firstname'].' '.$row['lastname']."</td>
                                            <td>".$row['email']."</td>
                                            <td>
                                            ".$status."
                                            ".$active."
                                            </td>
                                            <td>".$rolefinal."</td>
                                            <td>".date('m/d/Y', strtotime($row['created_on']))."</td>
                                            <td>
                                              <div class='btn-group' role='group' aria-label='Button group with nested dropdown'>
                                                <a href='cart.php?user=".$row['id']."' class='btn btn-info btn-sm btn-flat'><i class='fa fa-search'></i> View</a>
                                                <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['id']."'><i class='fa fa-edit'></i> Edit</button>
                                                <button class='btn btn-warning btn-sm promoteUser btn-flat' data-id='".$row['id']."'><i class='fa fa-certificate'></i> Promote</button>";
                                                if ($row['status']=='Activated') {
                                                  echo "<button class='btn btn-danger btn-sm deactivate btn-flat' data-id='".$row['id']."'><i class='fa fa-trash'></i> Deactivate</button>
                                                  </div>
                                                </td>
                                            </tr>
                                            ";
                                                } else {
                                                 echo" <button class='btn btn-secondary btn-sm activate btn-flat' data-id='".$row['id']."'><i class='fa fa-edit'></i> Activate</button>
                                              </div>
                                            </td>
                                        </tr>
                                        ";
                                                }
                                    }
                                  }
                                  }
                                  catch(PDOException $e){
                                  echo $e->getMessage();
                                  }

                              ?>
                            </tbody>
                          </table>
                      </div>
                    </div>
                  </div>
								</div>

                <!-- begin Modals -->
                  <!-- viewUserForm Modal -->
                  <div class="modal fade" id="viewUserForm">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header text-center">
                              <h4 class="modal-title"><h4 id="nameOfClubAtd"></h4>&nbsp User &nbsp<b>Profile</b> </h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body" id="clubMembersPrint">
                              <table class="table table-sm table-hover table-striped" id="clubMembersTable">
                                <thead>
                                <tr >
                                  <td class="profilePic" style="height:250px; margin:0px 0px; width:280px; background:url('../Profiles/profile.png');background-repeat: no-repeat; background-size: cover;" rowspan="10">
                                  <!-- <div ></div> -->
                                  </td>
                                </tr>
                                  <tr>
                                    <th class="d-none d-md-table-cell">Names</th>
                                    <td id="userNames"></td>
                                  </tr>
                                  <tr>
                                    <th class="d-none d-md-table-cell">Faculty</th>
                                    <td id="userFaculty"></td>
                                  </tr>
                                  <tr>
                                    <th class="d-none d-md-table-cell">Reg N<sup><u>0</u></sup></th>
                                    <td id="userRegno"></td>
                                  </tr>
                                  <tr>
                                    <th class="d-none d-md-table-cell">Phone Number</th>
                                    <td id="userPhone"></td>
                                  </tr>
                                  <tr>
                                    <th class="d-none d-md-table-cell">Email</th>
                                    <td id="userEmail"></td>
                                  </tr>
                                  <tr>
                                    <th class="d-none d-md-table-cell">Gender</th>
                                    <td id="userGender"></td>
                                  </tr>
                                  <tr>
                                    <th class="d-none d-md-table-cell">Address</th>
                                    <td id="userAddress"></td>
                                  </tr>
                                  <tr>
                                    <th class="d-none d-md-table-cell">Role</th>
                                    <td id="userRole"></td>
                                  </tr>
                                  <tr>
                                    <th class="d-none d-md-table-cell">Status</th>
                                    <td id="userStatus"></td>
                                  </tr>
                                </thead>
                                <tbody id="attendeesMenu" class="attendeesMenu">
                                  
                                  <tr>
                                    <th></th>
                                    <th class="d-none d-md-table-cell" rowspan="4">About</th>
                                    <td id="userAbout"></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                            <div class="modal-footer text-center">
                              <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                              <button type="button" onclick="javascript:printDiv('clubMembersPrint')" class="btn btn-primary btn-flat pull-center" name="print"><i class="fa fa-print"></i> Print</button>
                              
                            </div>
                        </div>
                    </div>
                  </div>
                <!-- End Modals -->
							</div>
						</div>
					</div>

				</div>
			</main>
			
			<?php 
				include('includes/footer.php');
                include('includes/users_modal.php'); 
			?>
            <?php include('includes/scripts.php'); ?>
		</div>
	</div>
<script>
    $(function(){

    $(document).on('click', '.edit', function(e){
        e.preventDefault();
        $('#edit').modal('show');
        var id = $(this).data('id');
        getRow(id);
    });

    $(document).on('click', '.viewUser', function(e){
        e.preventDefault();
        $('#viewUserForm').modal('show');
        var id = $(this).data('id');
        getRow(id);
    });

    $(document).on('click', '.promoteUser', function(e){
        e.preventDefault();
        $('#promoteModel').modal('show');
        var id = $(this).data('id');
        getRow(id);
    });

    $(document).on('click', '.deactivate', function(e){
        e.preventDefault();
        $('#deactivate').modal('show');
        var id = $(this).data('id');
        getRow(id);
    });

    $(document).on('click', '.activate', function(e){
        e.preventDefault();
        $('#activate').modal('show');
        var id = $(this).data('id');
        getRow(id);
    });

    $(document).on('click', '.photo', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        getRow(id);
    });

    $(document).on('click', '.status', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        getRow(id);
    });

    });

    function getRow(id){
    $.ajax({
        type: 'POST',
        url: 'php/users_row.php',
        data: {id:id},
        dataType: 'json',
        success: function(response){
        $('.userid').val(response.id);
        $('.useridPic').val(response.id);
        $('.activateuserid').val(response.id);
        $('#edit_email').val(response.email);
        $('#edit_username').val(response.username);
        // $('#edit_password').val(response.password);
        $('#edit_firstname').val(response.firstname);
        $('#edit_lastname').val(response.lastname);
        $('#edit_address').val(response.address);
        $('#edit_contact').val(response.phone);
        $('.fullname').html(response.firstname+' '+response.lastname);
        $('.fullname2').val(response.firstname+' '+response.lastname);
        $('.activatefullname').html(response.firstname+' '+response.lastname);
        $('.activatefullname2').val(response.firstname+' '+response.lastname);
        $('#fullPicnames').val(response.firstname+' '+response.lastname);
        // promote Student Modal Values
        $('#pUserid').val(response.id);
        $('#pFullNames').val(response.firstname+' '+response.lastname);
        $('#pNames').html(response.firstname+' '+response.lastname);
        // view user details Modal values
        var pphoto='';
        if (response.photo==' ') {
          pphoto='profile.png';
        }else{
          pphoto=response.photo;
        }
        $('.profilePic').css({
                'height'                : '250px',
                'width'                : '280px',
                // 'margin-bottom'         : '30px',
                'background'            : 'url(../Profiles/'+pimage+')',
                'background-repeat'     : 'no-repeat',
                'background-position'   : 'center',
                'background-size'       : 'cover',
                // '-webkit-filter'        : 'blur(10px)',
                // '-moz-filter'           : 'blur(10px)',
                // '-o-filter'             : 'blur(10px)',
                // '-ms-filter'            : 'blur(10px)',
                // 'filter'                : 'blur(10px)',
                'min-width'             : '20vw'
              });
        $('#userNames').html(response.firstname+' '+response.lastname);
        $('#userFaculty').html(response.faculty);
        $('#userRegno').html(response.regNo);
        $('#userPhone').html(response.phone);
        $('#userEmail').html(response.email);
        $('#userGender').html(response.gender);
        $('#userAddress').html(response.address);
        var roleVerify='';
        if (response.role==1) {
          roleVerify='Student';
        }else if(response.role==2){
          roleVerify='Club Leader';

        }else if(response.role==3){
          roleVerify='Guild President';

        }
        $('#userRole').html(roleVerify);
        $('#userStatus').html(response.status);
        $('#userAbout').html(response.about);
        }
    });
    }
</script>

</body>

</html>

<?php 
}else{
	header('Location: ../login.php');
	} 
	?>
  