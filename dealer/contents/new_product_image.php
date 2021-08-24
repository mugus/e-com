
<div class="row">

  <!-- <div class="col-2 col-xl-1"></div> -->
  <div class="col-12 col-xl-6">
    <div class="card">
      <div class="card-header">
        <?php if(isset($result)){
          echo "<div $alert_class role='alert'>
                  <div class='alert-icon'>
                  <i class='far fa-fw fa-bell'></i>
                  </div>
                  <div class='alert-message'>
                  $msg $result!
                  </div>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>";
              }
        ?>
        <h5 class="card-title">Painting Images</h5>
        <h6 class="card-subtitle text-muted">Add More image Till You see a Green Button called Submit & Finish on the form!</h6>
      </div>
      <div class="card-body">
                  
        <form method="POST" action="" enctype="multipart/form-data">
          
          <div class="form-row">
            <div class="form-group col-md-12">
              <label class="form-label w-100">Add Image <span class="text-danger">*</span></label>
              <input type="file" name="photo_id">
            </div>
          </div>

          <button type="submit" class="btn btn-primary" name="add_new_painting_image">Submit</button>
          <?php
            $chkNumPhotoSql = "SELECT * FROM photo WHERE photoid=:photoid";
            $chkNumPhotoStmt = $db->prepare($chkNumPhotoSql);
            $chkNumPhotoStmt->execute(array(
              'photoid'=>$photoid
            ));
            if ($chkNumPhotoStmt->rowCount() >= 2) {
              # code...
              ?>
              <button type="submit" class="btn btn-success" name="finish_add_new_painting_image">Submit & Finish</button>
              <?php
            }
          ?>
        </form>
      </div>
    </div>
  </div>
</div>