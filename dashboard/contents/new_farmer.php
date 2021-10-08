<h2>New farmer</h2>
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
      <h5 class="card-title">Record New Farmer</h5>
      <h6 class="card-subtitle text-muted">Please Fill each Field to Complete New Farmer Registration!</h6>
    </div>
    <div class="card-body">
      <form onsubmit="" method="POST" action="" enctype="multipart/form-data">

        <div class="form-row">
          <div class="col-md-4">
            <label class="form-label">FirstName <span class="text-danger">*</span> </label>
            <input type="text" name="farmer_firstname" id="farmer_firstname" class="form-control" placeholder="E.g: John" required>
          </div>
          <div class="col-md-4">
            <label class="form-label">SurName <span class="text-danger">*</span> </label>
            <input type="text" name="farmer_lastname" id="farmer_lastname" class="form-control" placeholder="E.g: Muhizi" required>
          </div>
          <div class="col-md-4">
            <label class="form-label">Reg N<sup>o</sup> <span class="text-danger">*</span> <small class="text-info">Auto generated</small> </label>
            <input type="text" name="farmer_reg_no" id="farmer_reg_no" class="form-control">
            <small class="text-danger reg_info"></small>
          </div>
        </div><br>
        <h4 class="text-primary"><b> <span class="fa fa-star"></span> Farmer Addresses</b></h4>
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
          <div class="col-md-6">
            <label for="inputAddress">Phone N<sup>o</sup><span class="text-danger">*</span></label>
            <input type="text" name="farmer_phone" id="farmer_phone" class="form-control" placeholder="E.g: 0787848876" required>
            <small class="text-danger phone_info"></small>
          </div>
          <div class="col-md-6">
            <label for="inputAddress">Landsize <span class="text-muted">(in m<sup>2</sup> )</span> <small class="text-secondary">Optional</small></label>
            <input type="text" name="farmer_landsize" id="farmer_landsize" class="form-control" placeholder="E.g: 340">
          </div>
        </div><br>
        <h4 class="text-primary"><b> <span class="fa fa-star"></span> Farmer Seasonal Product Consumption</b></h4>
        <div class="form-row">
          <div class="col-md-4">
            <label for="inputAddress">In Trimester A <small class="text-secondary">Optional</small></label>
            <select name="farmer_product_season_A" id="farmer_product_season_A" class="form-control">
              <option value="">Choose</option>
              <option value="vegetable">Vegetables</option>
              <option value="fruit">Fruits</option>
              <option value="wheat">Wheat</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="inputAddress">In Trimester B <small class="text-secondary">Optional</small></label>
            <select name="farmer_product_season_B" id="farmer_product_season_B" class="form-control">
              <option value="">Choose</option>
              <option value="vegetable">Vegetables</option>
              <option value="fruit">Fruits</option>
              <option value="wheat">Wheat</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="inputAddress">In Trimester C <small class="text-secondary">Optional</small></label>
            <select name="farmer_product_season_C" id="farmer_product_season_C" class="form-control">
              <option value="" selected>Choose</option>
              <option value="vegetable">Vegetables</option>
              <option value="fruit">Fruits</option>
              <option value="wheat">Wheat</option>
            </select>
          </div>
        </div><br>

        <button type="submit" class="btn btn-primary" id="add_new_farmer" name="add_new_farmer">Submit</button>
      </form>
    </div>
  </div>