<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Add New User</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="users_edit.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="user_type" class="col-sm-3 control-label">User Type</label>

                    <div class="col-sm-9">
                      <select class="form-control" id="user_type" name="role" required>
                        <option value="1">Student</option>
                        <!-- <option value="1">student</option> -->
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email</label>

                    <div class="col-sm-9">
                      <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="col-sm-3 control-label">username</label>

                    <div class="col-sm-9">
                      <input type="username" class="form-control" id="username" name="username" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password</label>

                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Firstname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact" class="col-sm-3 control-label">Phone Number</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="contact" name="phone">
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-sm-3 control-label">Gender</label>

                    <div class="col-sm-9">
                      <select name="gender" class="form-control" id="gender">
                        <option class="light-400" value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="addUser"><i class="fa fa-save"></i> Save</button>
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
              <h4 class="modal-title"><b>Edit User</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="users_edit.php">
                <input type="hidden" class="userid" name="student_id">
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="edit_username" class="col-sm-3 control-label">Username</label>

                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="edit_username" name="username">
                        </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="edit_password" class="col-sm-3 control-label">Password</label>

                        <div class="col-sm-9">
                          <input type="password" class="form-control" id="edit_password" name="password">
                        </div>
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="edit_firstname" class="col-sm-3 control-label">Firstname</label>

                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="edit_firstname" name="firstname">
                        </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="edit_lastname" class="col-sm-3 control-label">Lastname</label>

                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="edit_lastname" name="lastname">
                        </div>
                    </div>
                    </div>
                </div>
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="edit_contact" class="col-sm-3 control-label">Contact Info</label>

                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="edit_contact" name="phone">
                        </div>
                    </div>

                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="edit_email" class="col-sm-3 control-label">Email</label>

                        <div class="col-sm-9">
                          <input type="email" class="form-control" id="edit_email" name="email">
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
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
              <form class="form-horizontal" method="POST" action="php/users_promote.php">
                <div class="form-group">
                  <label for="pNames" class="col-sm-3 control-label">Names</label>
                  <input type="hidden" class="form-control" id="pFullNames"  name="names">
                  
                  <div class="col-sm-9">
                    <span  class="control-label" id="pNames" ></span>
                    <input type="hidden" class="form-control pUserid" id="pUserid"  name="student_id">
                    </div>
                </div>
                <div class="form-group">
                    <label for="pRole" class="col-sm-3 control-label">Choose Role</label>

                    <div class="col-sm-9">
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
              <form class="form-horizontal" method="POST" action="users_edit.php">
                <input type="hidden" class="userid" name="student_id">
                <div class="text-center">
                    <p>DISABLE USER</p>
                    <h2 class="bold fullname"></h2>
                    <input type="hidden" name="usernames" class="bold fullname2" id="">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-danger btn-flat" name="deactivate"><i class="fa fa-trash"></i> Confirm</button>
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
              <form class="form-horizontal" method="POST" action="users_edit.php">
                <input type="hidden" class="activateuserid" name="student_id">
                <div class="text-center">
                    <p>ACTIVATE USER</p>
                    <h2 class="bold activatefullname"></h2>
                    <input type="hidden" name="names"class="bold activatefullname2" id="">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="activate"><i class="fa fa-check"></i> Confirm</button>
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
              <form class="form-horizontal" method="POST" action="users_edit.php" enctype="multipart/form-data">
                <input type="hidden" class="useridPic" name="student_id">
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo" required>
                      <input type="hidden" id="fullPicnames" name="names" required>
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
              <form class="form-horizontal" method="POST" action="users_activate.php">
                <input type="hidden" class="userid" name="id">
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


     