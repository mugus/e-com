
    <?php if(isset($result)){
      echo "<div class='alert $alert alert-dismissable alert-sm' role='alert'>
              <div class='alert-message'>
              $result!
              </div>
            </div>";
          }
    ?>
  <div class="card">
    <div class="card-header">
      <h5 class="card-title">New Coop</h5>
      <h6 class="card-subtitle text-muted">Please Fill each Field to Complete New Coop Registration!</h6>
    </div>
    <div class="card-body">
      <form onsubmit="" method="POST" action="" enctype="multipart/form-data">
        <div class="form-row">
          <div class="col-md-6">
            <label class="form-label">Coop Name <span class="text-danger">*</span> </label>
            <input type="text" name="coop_name" id="coop_name" class="form-control" placeholder="E.g: Tuzamurane">
          </div>
          <div class="col-md-6">
            <label class="form-label">Coop Phone N<sup>o</sup> to Contact <span class="text-danger">*</span> </label>
            <input type="number" name="phone_to_contact" id="phone_to_contact" class="form-control" placeholder="E.g: 0787848876">
          </div>
        </div><br>
        <h4 class="text-primary"><b> <span class="fa fa-star"></span> Coop Addresses & Descriptions</b></h4>

        <div class="form-row">
          <div class="col-md-3">
            <label for="inputAddress">Province<span class="text-danger">*</span></label>
            <input type="text" name="province" id="province" class="form-control" placeholder="E.g: East" required>
          </div>
          <div class="col-md-3">
            <label for="inputAddress">District<span class="text-danger">*</span></label>
            <input type="text" name="district" id="district" class="form-control" placeholder="E.g: Nyagatare" required>
          </div>
          <div class="col-md-3">
            <label for="inputAddress">Sector<span class="text-danger">*</span></label>
            <input type="text" name="sector" id="sector" class="form-control" placeholder="E.g: Gatunda" required>
          </div>
          <div class="col-md-3">
            <label for="inputAddress">Cell<span class="text-danger">*</span></label>
            <input type="text" name="cell" id="cell" class="form-control" placeholder="E.g: Cyagaju" required>
          </div>
          <div class="row">
            <div class="col-md-12">
              <label for="inputAddress">Village<span class="text-danger">*</span></label>
              <input type="text" name="village" id="village" class="form-control" placeholder="E.g: Kabeza" required>
            </div>
          </div>
        </div><br>
        
        <div class="form-row">
          <div class="form-group col-md-12">
            <label class="form-label w-100">Add Coop Descriptions <small class="text-secondary">Optional</small></label>
            <textarea name="descriptions" id="descriptions" class="form-control" cols="30" rows="6"
              placeholder="About Coop"></textarea>
            <small class="text-danger" id="coop_desc"></small>
          </div>
          <!-- <small class="form-text text-muted">To be more specific, <br> We recommend you to add two images to your
            product right after submitting this form!</small> -->
        </div>

        <button type="submit" class="btn btn-primary" name="add_new_coop">Submit</button>
      </form>
    </div>
  </div>