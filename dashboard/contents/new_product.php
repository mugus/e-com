
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
      <h5 class="card-title">New Product</h5>
      <h6 class="card-subtitle text-muted">Please Fill each Field to Complete New Product Registration!</h6>
    </div>
    <div class="card-body">
      <form onsubmit="" method="POST" action="" enctype="multipart/form-data">
        <div class="form-group">
          <label class="form-label">Product Name <span class="text-danger">*</span> </label>
          <input type="text" name="name" id="name" class="form-control" placeholder="E.g: Millmax">
          <small class="text-danger" id="p_name_msg"></small>
        </div>
        <div class="form-row">
          <div class="form-group col-md-12">
            <label for="inputAddress">Category<span class="text-danger">*</span></label>
            <select id="cat_id" name="cat_id" class="form-control">
              <option value="" hidden selected>Choose...</option>
              <?php while($category = $stmt_cat->fetch(PDO::FETCH_ASSOC)): ?>
              <option value="<?= $category['cat_id'] ?>">
                <?= $category['cat_name'] ?>
              </option>
              <?php endwhile ?>
            </select>
            <small class="text-danger" id="cat_msg"></small>
          </div>
          <!-- <div class="form-group col-md-6">
          <label for="inputAddress">Quantity in stock(<span class="text-muted">Boxes</span>) <span
                class="text-danger">*</span></label>
            <input type="text" name="stock" id="stock" class="form-control" placeholder="E.g: 30">
            <small class="text-danger" id="tech_msg"></small>
          </div> -->
        </div>
        <!-- <div class="form-row"> -->
          <!-- <div class="form-group col-md-4">
            <label for="inputAddress">Product Price(<span class="text-muted">Rwf</span>) <span
                class="text-danger">*</span></label>
            <input type="text" name="price" id="price" class="form-control" placeholder="E.g: 4500">
            <small class="text-danger" id="tech_msg"></small>
          </div> -->
          <!-- <div class="form-group col-md-6">
            <label for="inputAddress">Manufactured date <span class="text-danger">*</span></label>
            <input type="date" name="man_date" id="man_date" class="form-control">

          </div>
          <div class="form-group col-md-6">
            <label for="inputAddress">Expired date <span class="text-danger">*</span></label>
            <input type="date" name="exp_date" id="exp_date" class="form-control">
          </div>
        </div> -->
        <div class="form-row">
          <div class="form-group col-md-12">
            <label class="form-label w-100">Add Product Descriptions<span class="text-danger">*</span></label>
            <textarea name="descriptions" id="desc" class="form-control" cols="30" rows="6"
              placeholder="About the Product"></textarea>
            <small class="text-danger" id="desc_msg"></small>
          </div>
          <!-- <small class="form-text text-muted">To be more specific, <br> We recommend you to add two images to your
            product right after submitting this form!</small> -->
        </div>
        <div class="row">
          <div class="col-md-12">
            <label class="form-label w-100">Add Photo<span class="text-danger">*</span></label>
            <input type="file" name="photo" id="">
          </div>
          <!-- <small class="form-text text-muted">To be more specific, <br> We recommend you to add two images to your
            product right after submitting this form!</small> -->
        </div>

        <button type="submit" class="btn btn-primary" name="add_new_product">Submit</button>
      </form>
    </div>
  </div>