<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Add New Deliverer</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="php/deliverers_edit.php" enctype="multipart/form-data">
                <div class="row">
									<div class="col-md-12">
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="email" class="col-sm-6 control-label">Email</label>

												<div class="col-sm-12">
													<input type="email" class="form-control" title='required' onfocusout='emailField(this.id)' id="email" name="email" required>
                          <span class="text-success">&nbsp;</span>
												</div>
											</div>
											<div class="form-group col-md-6">
												<label for="Password" class="col-sm-10 control-label">Password <strong class="text-success"><small>( Copy This some where )</small></strong></label>

												<div class="col-sm-12">
													<input type="text" class="form-control" id="passwdKey" name="delivererPassword" required readonly>
												</div>
											</div>
											<div class="form-group col-md-6">
													<label for="firstName" class="col-sm-6 control-label">First Name</label>

													<div class="col-sm-12">
														<input type="text" class="form-control" title='required' onfocusout='stringField(this.id, 30)' id="firstName" name="firstname" required>
                            <span class="text-success">&nbsp;</span>
													</div>
											</div>
											<div class="form-group col-md-6">
													<label for="lastName" class="col-sm-6 control-label">Last Name</label>

													<div class="col-sm-12">
														<input type="text" class="form-control" title='required' onfocusout='stringField(this.id, 30)' id="lastName" name="lastname" required>
                            <span class="text-success">&nbsp;</span>
													</div>
											</div>
										</div>
                    <div class="form-group col-md-12">
                        <label for="company" class="col-sm-6 control-label">From Which Company?</label>

                        <div class="col-sm-12">
                          <select name="company" id="" class="form-control">
                          <option value="">...Select The company..</option>
                          <?php
                          $compst = $db->prepare("SELECT * FROM company ORDER BY brand ASC");
                          $compst->execute();
                          ?>
                          <?php while($comres = $compst->fetch()): ?>
                          <option value="<?=$comres['companyid']?>"><?=$comres['brand']?></option>
                          <?php endwhile ?>
                          </select>
                          <span class="text-success">&nbsp;</span>
                        </div>
                    </div>
										<div class="form-row">
											<div class="form-group col-md-12">
													<label for="address" class="col-sm-6 control-label">Address</label>

													<div class="col-sm-12">
														<input type="text" class="form-control"title='required' onfocusout='maximumLength(this.id, 50)' id="address" name="address" required>
                            <span class="text-success">&nbsp;</span>
													</div>
											</div>
											<div class="form-group col-md-12">
													<label for="phone" class="col-sm-6 control-label">Phone Number</label>

													<div class="col-sm-12">
														<input type="text" class="form-control" title='required' onfocusout='phoneField(this.id)' id="phone" name="phone">
                            <span class="text-success">&nbsp;</span>
													</div>
											</div>
										</div>
										
										
									</div>
									<div class="col-md-12">
										<div class="form-group" style="height:180px;">
											<div class="profile-content">
												<div class="position-absolute col-md-12" >
													<div class="picture-container">
														<div class="picture">
																<img class="picture-src" id="wizardPicturePreview" title=""/>
																<input type="file" id="wizard-picture" name="photo">
														</div>
														<h6 style="text-shadow: -1px -1px 0 #ffffff; color:black">Click in dark area to Choose a Logo</h6>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
                
                
            </div>
            <div class="modal-footer" >
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-left">
              <h4 class="modal-title"><b>Edit Deliverer</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="php/deliverers_edit.php" onsubmit="return checkFormInput(this.id)">
                <input type="hidden" class="editDelivererid" name="id">
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="edit_firstname" class="col-sm-6 control-label">First Name</label>

                        <div class="col-sm-12">
                          <input type="text" class="form-control" title='required' id="edit_firstname" name="firstname">
                          <span class="text-success">&nbsp;</span>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="edit_lastname" class="col-sm-6 control-label">Last Name</label>

                        <div class="col-sm-12">
                          <input type="text" class="form-control" title='required' id="edit_lastname" name="lastname">
                          <span class="text-success">&nbsp;</span>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="edit_email" class="col-sm-6 control-label">Email</label>

                        <div class="col-sm-12">
                          <input type="email" class="form-control" title='required' id="edit_email" name="email">
                          <span class="text-success">&nbsp;</span>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="edit_password" class="col-sm-12 control-label"> Current Password <small class="text-primary"> <strong>(Type the current password for Modification)</strong></small></label>

                        <div class="col-sm-12">
                          <input type="password" class="form-control"  id="edit_passwd" name="currentpassword">
                          <span class="text-success">&nbsp;</span>
                        </div>
                    </div>
                  </div>
                </div>
								<div class="form-row">
									<div class="col-md-6">
                  <div class="form-group">
												<label for="edit_phone" class="col-sm-6 control-label">Phone Number</label>
	
												<div class="col-sm-12">
													<input type="text" class="form-control" title='required' onfocusout='phoneField(this.id)' id="edit_phone" name="phone">
                          <span class="text-success">&nbsp;</span>
												</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
                        <label for="edit_newpasswd" class="col-sm-6 control-label">New Password</label>

                        <div class="col-sm-12">
                          <input type="password" class="form-control" title='required' onfocusout='passwordField(this.id, 8)' id="edit_newpasswd" name="newpassword">
                          <span class="text-success">&nbsp;</span>
                        </div>
                    </div>
									</div>
								</div>
								<div class="form-row">
									<div class="col-md-6">
										<div class="form-group">
												<label for="edit_address" class="col-sm-6 control-label">Address</label>
		
												<div class="col-sm-12">
													<input type="text" class="form-control" title='required' id="edit_address" name="address" required>
                          <span class="text-success">&nbsp;</span>
												</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
                        <label for="edit_repass" class="col-sm-6 control-label">Re-type New Password</label>

                        <div class="col-sm-12">
                          <input type="password" class="form-control" title='required' onfocusout="confirmField(this.id, 'edit_newpasswd')" id="edit_repass" name="repassword">
                          <span class="text-success">&nbsp;</span>
                        </div>
                    </div>
									</div>
								</div>
                <div class="form-row">
									<div class="col-md-6">
                    <div class="form-group">
                      <label for="companyId" class="col-sm-6 control-label">Change Company</label>
                      <div class="col-sm-12">
                        <select name="company" id="companyId" class="form-control">
                          <option value="">...Select The company..</option>
                          <?php
                          $compstedit = $db->prepare("SELECT * FROM company ORDER BY brand ASC");
                          $compstedit->execute();
                          ?>
                          <?php while($comress = $compstedit->fetch()): ?>
                          <option value="<?=$comress['companyid']?>"><?=$comress['brand']?></option>
                          <?php endwhile ?>
                        </select>
                      </div>
                    </div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
												<!-- <label for="edit_phone" class="col-sm-6 control-label">Deliverer ID</label> -->
	
												<div class="col-sm-12">
													<input type="hidden" class="form-control" id="edit_delivererid" name="editDelivererid">
                          <div class="position-relative form-check">
                            <input onclick="ShowPassword();" type="checkbox" class="form-check-input">&nbsp;
                            <label for="ShowPassword" class="form-check-label text-github"><strong> Show passwords</strong></label>
                          </div>
												</div>
										</div>
									</div>
                </div>
            </div>
            <div class="modal-footer">
              <div class="text-danger" class="responseMessage">&nbsp;</div>
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check"></i> Confirm Update</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Promote Modal -->
<div class="modal fade" id="promoteModel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-left">
              <h4 class="modal-title"><b>Promote User</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="php/deliverers_promote.php">
                <div class="form-group">
                  <label for="pNames" class="col-sm-3 control-label">Names</label>
                  <input type="hidden" class="form-control" id="pFullNames"  name="names">
                  
                  <div class="col-sm-12">
                    <span  class="control-label" id="pNames" ></span>
                    <input type="hidden" class="form-control pDelivererid" id="pDelivererid"  name="id">
                    </div>
                </div>
                <div class="form-group">
                    <label for="pRole" class="col-sm-3 control-label">Choose Role</label>

                    <div class="col-sm-12">
                      <!-- <input type="text" class="form-control" id="pRole" name="role"> -->
                      <select name="role" class="form-control" id="pRole">
                        <option value="3">Guild President</option>
                      </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="promote"><i class="fa fa-check-square-o"></i> Promote</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Disable -->
<div class="modal fade" id="deactivate">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Disable...</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="php/deliverers_edit.php">
                <input type="hidden" class="disableDelivererid" name="id">
                <div class="text-center">
                    <p>DISABLE DELIVERER TO ACCESS PSOMS</p>
                    <h2 class="bold disableFullname"></h2>
                    <input type="hidden" name="fullname" class="bold disableFullname2" id="">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-danger btn-flat" name="deactivate"><i class="fa fa-trash"></i> Confirm Deactivation</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Enable User Modal -->
<div class="modal fade" id="activate">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Activate...</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="php/deliverers_edit.php">
                <input type="hidden" class="activateDelivererid" name="id">
                <div class="text-center">
                    <p>ACTIVATE DELIVERER TO GRANT ACCESS TO PSOMS</p>
                    <h2 class="bold activateFullname"></h2>
                    <input type="hidden" name="fullname" class="bold activateFullname2" id="">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-warning btn-flat" name="activate"><i class="fa fa-check"></i> Confirm Activation</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Photo -->
<div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b><span class="fullname"></span></b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="php/deliverers_edit.php" enctype="multipart/form-data">
                <input type="hidden" class="photoDelivererid" id="photoDelivererid" name="id">
                <div class="text-center">
                    <!-- <p>CHANGE PROFILE PICTURE OF <p></p></p> -->
                    <h2 class="bold photoShowNames"></h2>&nbsp 
                    <p class="text-muted"> Profile Picture Modifications</p>
                </div>
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-12">
                      <input type="file" id="photo" name="photo" required>
                      <input type="hidden" id="photoFullname" name="fullname" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="uploadPhoto"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div> 


<!-- Activate -->
<div class="modal fade" id="activate">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Activating...</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="deliverers_activate.php">
                <input type="hidden" class="delivererid" name="id">
                <div class="text-center">
                    <p>ACTIVATE USER</p>
                    <h2 class="bold fullname"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="activate"><i class="fa fa-check"></i> Activate</button>
              </form>
            </div>
        </div>
    </div>
</div> 

<!-- View Deliverer -->
<div class="modal fade" id="view">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>DELIVERER VIEW</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="delivererDiv">
              <form class="form-horizontal" method="POST" action="deliverers_edit.php">
                <input type="hidden" class="viewDelivererid" name="id">
                <div class="text-center">
                    <p>DELIVERER INFO.</p>
                    <h2 class="bold viewFullname"></h2>
                </div>
                <div class="row">
                  <div class="col-md-12 text-center viewPhotobg" id="viewPhotobg">
                  </div>
                  <div class="col-md-12" style="position:absolute">
                    <div class="row">
                      <div class="col-md-5"></div>
                      <div class="col-md-3" id="viewProfile"></div>
                      <div class="col-md-4"></div>
                    </div>
                  </div>
                </div><hr>
                <div class="row">
                  <div class="col-md-6 text-center"><strong>NAMES</strong></div>
                  <div class="col-md-6 text-center" id="viewFullname"></div>
                </div>
                <div class="row">
                  <div class="col-md-6 text-center"><strong>PHONE</strong></div>
                  <div class="col-md-6 text-center" id="viewPhone"></div>
                </div>
                <div class="row">
                  <div class="col-md-6 text-center"><strong>EMAIL</strong></div>
                  <div class="col-md-6 text-center" id="viewEmail"></div>
                </div>
                <div class="row">
                  <div class="col-md-6 text-center"><strong>ADDRESS</strong></div>
                  <div class="col-md-6 text-center" id="viewAddress"></div>
                </div>
                <div class="row">
                  <div class="col-md-6 text-center"><strong>COMPANY</strong></div>
                  <div class="col-md-6 text-center" id="viewCompany"></div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="button" class="btn btn-primary btn-flat" onclick="javascript:printDiv('delivererDiv')" name="print"><i class="fa fa-print"></i> Print</button>
              </form>
            </div>
        </div>
    </div>
</div> 


     