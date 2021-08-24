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

					<h1 class="h3 mb-3">Vendors Page</h1>

					<div class="row">
						<div class="col-lg-12">
							<div class="card" >
                                <!-- header of div and messages part style='background:greenyellow;'-->
								<div class="card-header">
									<h5 class="card-title mb-0">General List of Vendors</h5>
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
                      <div class="box table-responsive" id="vendorTable">
                        <div class="box-header with-border" style='text-align:center;'>
                            <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
                            <button type="button" class="btn btn-primary btn-sm btn-flat" onclick="javascript:printDiv('vendorTable')" name="print"><i class="fa fa-print"></i> Print</button>
                            
                        </div>
                          <table id="example1" class="table table-bordered mb-0">
                            <thead>
                              <th scope="col">Picture</th>
                              <th scope="col">Names</th>
                              <th scope="col">Email</th>
                              <th scope="col">Address</th>
                              <th scope="col">Phone</th>
                              <th scope="col">Status</th>
                              <th scope="col">Date Added</th>
                              <th scope="col">Tools</th>
                            </thead>
                            <tbody>
                              <?php
                                  try{
                                  $stmt = $db->prepare("SELECT * FROM deliverer ORDER BY id DESC");
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
                                        $photo = (!empty($row['photo'])) ? '../img/profiles/'.$row['photo'] : '../img/profiles/profile.png';
                                        $status = ($row['status']) ? '<span class="label label-success">active</span>' : '<span class="label label-danger">not verified</span>';
                                        echo "
                                        <tr>
                                            <td>
                                            <img src='".$photo."' height='30px' width='30px'>
                                            <span class='pull-right'><a href='#edit_logo' class='photo' data-toggle='modal' data-id='".$row['id']."'><i class='fa fa-edit'></i></a></span>
                                            </td>
                                            <td>".$row['firstname'].' '.$row['lastname']."</td>
                                            <td>".$row['email']."</td>
                                            <td>".$row['address']."</td>
                                            <td>".$row['phone']."</td>
                                            <td>".$row['status']."</td>
                                            <td>".date('m/d/Y', strtotime($row['createdDate']))."</td>
                                            <td>
                                              <div class='btn-group' role='group' aria-label='Button group with nested dropdown'>
                                                <button class='btn btn-sm btn-info view btn-flat' data-id='".$row['id'] ."' type='button'><i class='fa fa-search'></i>View</button>
                                                <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['id']."'><i class='fa fa-edit'></i> Edit</button>";
                                                if ($row['status']=='Activated') {
                                                  echo "<button class='btn btn-danger btn-sm deactivate btn-flat' data-id='".$row['id']."'><i class='fa fa-trash'></i> Deactivate</button>
                                                  </div>
                                                </td>
                                            </tr>
                                            ";
                                                } else {
                                                 echo" <button class='btn btn-warning btn-sm activate btn-flat' data-id='".$row['id']."'><i class='fa fa-edit'></i> Activate</button>
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
        include('includes/deliverer_modal.php'); 
				include('includes/footer.php');
			?>
      <!-- <script src="js/jquery-3.2.1.min.js"></script> -->
      <script src="js/validation.js"></script>
            <?php include('includes/scripts.php'); ?>
		</div>
	</div>
      <script>
        // random password
        function Random(){
        let passwdKey = document.getElementById('passwdKey');
        
        let charset = "0123456789ABCDEFGHIJKLMOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz@?&%$#!?";
        let max_Length = 7;
        let min_Length = 9;
        let charPicker = Math.floor(Math.random() * ((max_Length - min_Length) + 1) + min_Length);
        let randomId = [];
        let num = "";
          try {
        for(let i = 0; i < charPicker; i++){
          num = num + charset.charAt(Math.floor(Math.random() * charset.length));
        }
        randomId.push(num);
        console.log(randomId);
            
          } catch (error) {
            console.log(error);
          }
        return randomId;
        
        }
        passwdKey.value = Random();
      </script>

      <!-- SCRIPTS TO UNHIDE PASSWORDS FIELDS -->
      <script>
        let currentpassword = document.getElementById('edit_passwd');
        let password = document.getElementById('edit_newpasswd');
        let repassword = document.getElementById('edit_repass');
        function ShowPassword(){
          if (password.type === "password"){
            password.type = "text";
            repassword.type = "text";
            currentpassword.type = "text";
                // console.log("changed");
          }else{
            password.type = "password";
            repassword.type = "password";
            currentpassword.type = "password";
          }
        }
        </script>

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

    $(document).on('click', '.view', function(e){
        e.preventDefault();
        $('#view').modal('show');
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
        $('#edit_photo').modal('show');
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
        url: 'php/deliverers_row.php',
        data: {id:id},
        dataType: 'json',
        success: function(response){
        $('#edit_id').val(response.id);
        $('.editDelivererid').val(response.id);
        $('.disableDelivererid').val(response.id);
        $('.activateDelivererid').val(response.id);
        $('#edit_firstname').val(response.firstname);
        $('#edit_lastname').val(response.lastname);
        $('#edit_email').val(response.email);
        $('#edit_fullName').val(response.firstname+' '+response.lastname);
        $('#edit_phone').val(response.phone);
        $('#edit_address').val(response.address);
        $('#edit_logo').val(response.photo);
        $('#companyId').val(response.company);
        $('.disableFullname').html(response.firstname+' '+response.lastname);
        $('.disableFullname2').val(response.firstname+' '+response.lastname);
        $('.activateFullname').html(response.firstname+' '+response.lastname);
        $('.activateFullname2').val(response.firstname+' '+response.lastname);
        
        // view user details Modal values
        $('#viewFullname').html(response.firstname+' '+response.lastname);
        $('#viewPhone').html(response.phone);
        $('#viewEmail').html(response.email);
        $('#viewAddress').html(response.address);
        $('#viewCompany').html(response.brand);
        $('.viewDelivererid').val(response.id);
        var viewPhoto='';
        if (response.photo==' ') {
          viewPhoto='default.jpg';
        }else{
          viewPhoto=response.photo;
        }
        $('#viewPhotobg').css({
                'height'                : '120px',
                'margin-bottom'         : '2px',
                'background'            : 'url(../img/category/c1.jpg)',
                'background-repeat'     : 'no-repeat',
                'background-position'   : 'center',
                'background-size'       : 'cover',
                'border-radius'         : '5px',
                '-webkit-filter'        : 'blur(10px)',
                '-moz-filter'           : 'blur(10px)',
                '-o-filter'             : 'blur(10px)',
                '-ms-filter'            : 'blur(10px)',
                'filter'                : 'blur(10px)',
                // 'min-width'             : '90%'
              });
        $('#viewProfile').css({
                'height'                : '114px',
                'min-width'             : '90px',
                'max-width'             : '110px',
                'margin-top'            : '8px',
                'border'                : 'solid 3px #999999',
                'background'            : 'url(../img/profiles/'+viewPhoto+')',
                'background-repeat'     : 'no-repeat',
                'background-position'   : 'center',
                'background-size'       : 'contain',
                'border-radius'       : '10px',
              });
        $('#photoDelivererid').val(response.id);
        $('#photoFullname').val(response.firstname+' '+response.lastname);
        $('.photoShowNames').html(response.firstname+' '+response.lastname);
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
<script>
        $(document).ready(function(){

          $('#wizard-picture').change(function(){
          readURL(this);
          });
        });

        //function to preview image before upload
        function readURL(input){
        if(input.files && input.files[0]){
          let reader = new FileReader();
          reader.onload = function (e) {
          $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
          }
          reader.readAsDataURL(input.files[0]);
        }

        }
      </script>
      <!-- *********** PRINT ACTION **************************** -->
          
      <script language="javascript" type="text/javascript">
            function printDiv(divID) {
                //Get the HTML of div
                var divElements = document.getElementById(divID).innerHTML;
                //Get the HTML of whole page
                var oldPage = document.body.innerHTML;

                //Reset the page's HTML with div's HTML only
                document.body.innerHTML = 
                "<html><head><title></title></head><body>" + 
                divElements + "</body>";

                //Print Page
                window.print();

                //Restore orignal HTML
                document.body.innerHTML = oldPage;
            }
            </script>
          <!-- *********** PRINT ACTION END ************************** -->
</body>

</html>

<?php 
}else{
	header('Location: ../login.php');
	} 
	?>
  