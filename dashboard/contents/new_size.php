<?php


if(isset($result)){
      echo "<div class='alert $alert alert-dismissable alert-sm' role='alert'>
              <div class='alert-message'>
              $result!
              </div>
            </div>";
          }
    ?>
<div class="card">
    <div class="card-header">
      <h5 class="card-title"><?= $product['name'] ?> Sizes</h5>
      <h6 class="card-subtitle text-muted">Please Fill each Field to Complete <?= $product['name'] ?> Size!</h6>
    </div>
    <div class="card-body">
      <form onsubmit="" method="POST" action="" enctype="multipart/form-data">
        <div class="container">
          <div class="form-row clonedSection" id="clonedSection1">
            <div class="form-group col-sm-4 col-4 col-md-4">
              <label class="form-label">Product Size Name <span class="text-danger">*</span> </label>
              <input type="text" name="product_size1" id="product_size1" class="form-control" placeholder="E.g: 200ML or 500Gr" required>
              <small class="text-danger" id="p_name_msg"></small>
            </div>
            <div class="form-group col-sm-4 col-4 col-md-4">
                <label for="inputAddress">Product Price(<span class="text-muted">Rwf</span>) <span
                    class="text-danger">*</span></label>
                <input type="text" name="price1" id="price1" class="form-control" placeholder="E.g: 4500" required>
                <small class="text-danger" id="tech_msg"></small>
            </div>
            <!-- <div class="form-group col-sm-4 col-4 col-md-4">
                <label for="inputAddress">Product Stock(<span class="text-muted">Boxes</span>) <span
                    class="text-danger">*</span></label>
                <input type="text" name="stock1" id="stock1" class="form-control" placeholder="E.g: 45" required>
                <small class="text-danger" id="tech_msg"></small>
            </div> -->
            
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputAddress">Manufactured date <span class="text-danger">*</span></label>
              <input type="date" name="man_date1" id="man_date1" class="form-control" required>
            </div>
            <div class="form-group col-md-4">
              <label for="inputAddress">Expired date <span class="text-danger">*</span></label>
              <input type="date" name="exp_date1" id="exp_date1" class="form-control" required>
            </div>
          </div>
          <!-- <div class="form-row btn-group"><hr>
            <input type="button" class="btn" id="btnAdd" value="add another Size" />
            <input type="button" class="btn btn-danger" id="btnDel" value="Remove Field" />
          </div><hr> -->
          <div class="form-row">
            <div class="form-group col-md-8">
              <button type="submit" class="btn btn-primary" style="width: 100%" name="add_new_size">Confirm <?= $product['name'] ?> Sizes</button>
            </div>
          </div>

        </div>

      </form>
    </div>
  </div>