
<?php
if(isset($_SESSION['category_id'])): 
// Get all Tecnics in form
$te = "SELECT * FROM technics";
$technics = $db->prepare($te);
$technics->execute();

// Get All CAtegories
$cate = "SELECT * FROM category";
$categories = $db->prepare($cate);
$categories->execute();

  // $pro = "SELECT cat.name AS category_name,cat.description AS category_desc ,p.pid, p.catid, p.name AS paint_name, 
  //           p.price, p.status, p.vendorid, p.height, p.width, p.quantity, p.photoid, p.likes, p.madeDate, p.dateAdded,
  //           pho.fileName AS photo_name, pho.owner, ve.phone AS vendor_phone, ve.address AS vendor_address, 
  //           ve.logo AS vendor_logo, ve.businessName, ve.email AS vendor_email 
  //         FROM paintings p
  //         LEFT JOIN category cat ON p.catid = cat.catid
  //         LEFT JOIN vendor ve ON p.vendorid = ve.vendorid
  //         LEFT JOIN photo pho ON p.photoid = pho.photoid
  //         WHERE p.catid = :catid";
  $pro = "SELECT cat.name AS category_name,cat.description AS category_desc ,p.pid AS pid, p.catid, p.name AS paint_name, 
                p.price, p.status, p.vendorid, p.height, p.width, p.quantity, p.photoid AS paintingPhoto, p.likes, p.madeDate, p.dateAdded,
                GROUP_CONCAT(DISTINCT pho.fileName ORDER BY pho.photoid SEPARATOR',') AS photo_name, pho.owner,
                ve.phone AS vendor_phone, ve.address AS vendor_address, 
                ve.logo AS vendor_logo, ve.businessName, ve.email AS vendor_email 
              FROM paintings p
              LEFT JOIN category cat ON p.catid = cat.catid
              LEFT JOIN vendor ve ON p.vendorid = ve.vendorid
              LEFT JOIN photo pho ON p.photoid = pho.photoid

              WHERE p.catid = :catid AND p.vendorid=:pvendorid GROUP BY p.pid";
  $paint = $db->prepare($pro);
  $paint->execute(array(
    ':catid' => $_SESSION['category_id'],
    ':pvendorid' => $_SESSION['vendorid']
  ));

  // Delete Paint
  if(isset($_POST['c_dele'])){
    $pid = $_POST['pid'];
    $query = "DELETE FROM paintings WHERE pid = :pid";
    $dele = $db->prepare($query);
    $dele->execute(array(':pid' => $pid));
    if($dele->rowCount() > 0){
      $alert_class = "class='alert alert-info alert-dismissable alert-sm'";
			$result = "<small>Request to remove Paint approved! Do not worry if you still see paint on screen</small>";
      $msg = "<strong>Yeap!</strong>";
    }
  }
?>

<div class="row">
  <div class="col-7">
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
  </div>
</div>
<style type="text/css">
      /* body {
        font-family:Arial;
        font-size:12px;
        background:#ededed;
      } */
      .example-desc {
        margin:3px 0;
        padding:5px;
      }

      .carouseln {
        width:330px;
        /* border:1px dotted #222; */
        height:200px;
        position:relative;
        margin-top:5px;
        margin-left: -6px;
        clear:both;
        overflow:hidden;
        background:#b4b4bd;
      }
      #carouseln img {
        visibility:hidden; /* hide images until carousel can handle them */
        cursor:pointer; /* otherwise it's not as obvious items can be clicked */
      }

      .split-left {
        width:450px;
        float:left;
      }
      .split-right {
        width:400px;
        float:left;
        margin-left:10px;
      }
      #callback-output {
        height:250px;
        overflow:scroll;
      }
      textarea#newoptions {
        width:430px;
      }

      /* Style to modify painting details */
      .product-detail{
        background: #ffffff;
        padding: 10px 10px;
        width:330px;
      }
        .product-detail .product-price-tag {
          display: flex;
          flex-direction: row;
          align-items: baseline;
          justify-content: space-between;
        }
        .product-detail .product-price-tag .product-price .discounted {
          text-decoration: line-through 2px solid #666;
          padding: 0;
          margin: 0;
        }
        .product-detail .product-price-tag .product-price .discounted-price {
          padding: 0;
          margin: 0;
          font-size: 18px;
          text-align: center;
          font-weight: bold;
          transform: translateY(-3px);
        }
        .product-detail .product-size-color .product-size .text p::before {
          content: "";
          position: absolute;
          height: 2px;
          width: 100%;
          background-color: grey;
          bottom: 0;
          left: -100%;
          z-index: -1;
          transition: all 650ms ease;
        }
        .product-detail .product-size-color .product-size .text p:hover::before {
          left: 0%;
        }
        .product-detail .product-size-color .product-size .sizes {
          display: flex;
          flex-direction: row;
          justify-content: space-around;
        }
        .product-detail .product-size-color .product-size .sizes .size-square {
          height: 20px;
          width: auto;
          min-width: 25px !important ;
          border: 1px solid grey;
          padding: 0px 2px;
          border-radius: 3px;
          display: flex;
          align-items: center;
          justify-content: center;
          transition: all 650ms ease;
        }
        .product-detail .product-size-color .product-size .sizes .size-square span {
          font-size: 13px;
          color: gray;
          transition: all 650ms ease;
        }
        .product-detail .product-size-color .product-size .sizes .size-square:hover {
          border: 1px solid black;
          cursor: pointer;
          background-color: grey;
        }
        .product-detail .product-size-color .product-size .sizes .size-square:hover span {
          color: black;
        }
        .product-detail .product-size-color .product-size .sizes .disable {
          cursor: not-allowed !important;
          text-decoration: line-through;
        }
        .product-detail .product-size-color .product-size .sizes .disable:hover {
          border: 1px solid grey;
          background-color: white;
        }
        .product-detail .product-size-color .product-colors .colors {
          display: flex;
          flex-direction: row;
          justify-content: space-around;
        }

        .product-detail .product-size-color .product-colors .colors .color-red {
          background-color: #611223;
        }
        .product-detail .product-size-color .product-colors .colors .color-blue {
          background-color: #313b95;
        }
        .product-detail .product-size-color .product-colors .colors .color-black {
          background-color: #303030;
        }
        .product-detail .product-size-color .product-colors .colors .color-orange {
          background-color: #c85625;
        }
        .product-detail .product-size-color .product-colors .colors .active {
          width: 25px;
          height: 25px;
          border: 1px solid black;
        }
        .product-detail .product-size-color .product-colors .colors .disable {
          cursor: not-allowed !important;
        }
    </style>
<div class="row" style="padding:10px 5px;background:white">

  <?php if($paint->rowCount() > 0): ?>
    <?php
    $carouselNumber=$paint->rowCount();?>
    <input type="hidden" value="<?=$carouselNumber?>" name="numberOfCarousel" id="carouselNumber" class="form-control">
    
    <?php
    $countCarousel=1;
       while($paints=$paint->fetch(PDO::FETCH_ASSOC)): 
      ?>
    <div class="col-md-4 " style="box-shadow: 0 0 2rem 0 rgb(33 37 41 / 10%); margin:10px 0px;">
            <?php
            $carouselId = 'carousel_'.$countCarousel;
            $prevId = 'prev_'.$countCarousel;
            $nextId = 'next_'.$countCarousel;
            ?>
            <div id="<?=$carouselId?>" class="carouseln">
              <?php
                $st2 = $db->prepare("SELECT * FROM  photo  WHERE photoid=:photoid");
                $st2->execute(array(
                  ':photoid'=>$paints['paintingPhoto']
                ));
                $inc = 1;
                foreach($st2 as $fot){
                  $image = (!empty($fot['fileName'])) ? './Photos/Paintings/'.$fot['fileName'] : './Photos/Paintings/profile.png';
              ?>
                <a href="#"><img src="<?=$image?>" style="width:260px;height:180px;" id="item-<?=$inc?>" /></a>
              <?php $inc++; } ?>
            </div>
            <a href="#" id="<?=$prevId?>" onclick='previousimg(this.id)' class="previousImg">Prev</a> | <a href="#" id="<?=$nextId?>" onclick='nextimg(this.id)'>Next</a>
            <input type="hidden"  name="nextControl" class="nextControl" id="nextControl" value="<?=$inc?>" class="form-control">
            <input type="hidden"  name="nextControl" class="nextControl2" id="nextControl2" value="<?=$countCarousel?>" class="form-control">
           
        <!-- Painting Details -->
        <div class="product-detail">
          <div class="product-price-tag">
            <div class="product-name">
              <h5 class="m-0 p-0"><?= $paints['paint_name'] ?></h5>
              <small class="text-muted m-0 p-0"><?= $paints['category_name'] ?></small>
            </div>
            <div class="product-price">
              <h5><?= $paints['price'] ?> Rwf</h5>
            </div>
          </div>
          <div class="product-size-color row mt-3">
            <div class="product-size col-sm-6">
              <div class="text">
                <h5>Sizes</h5>
                <p><strong>Stock</strong></p>
              </div>
              <div class="sizes">
                <div class="size-square" title="Height (cm)">
                  <span><?= $paints['height'] ?></span>
                </div>
                <div class="size-square" title="Width (cm)">
                  <span><?= $paints['width'] ?></span>
                </div>
                <div class="size-square" title="Stock Quantity">
                  <span><?= $paints['quantity'] ?></span>
                </div>
              </div>
            </div>
            <div class="product-colors col-sm-6">
              <div class="text">
                <h5>Actions</h5>
              </div>
              <div class="colors">
                <a class="btn view_product" title="Review paint Info"  data-id="<?= $paints['pid'] ?>" data-toggle="modal" data-target="#ReviewProduct"><i class="align-middle mr-2 text-success" data-feather="eye"></i></a>
                <a class="btn editInfo" title="Edit paint Info" data-id="<?= $paints['pid'] ?>" data-toggle="modal" data-target="#EditProduct"><i class="align-middle mr-2 text-info" data-feather="edit"></i></a>
                <a class="btn delete_pa" title="Delete Paint" data-id="<?= $paints['pid'] ?>" data-toggle="modal" data-target="#DeleteProduct">
                  <i class="align-middle mr-2 text-danger" data-feather="trash"></i>
                </a>
              </div>
            </div>
          </div>
          <span>
            <?php 
              // $colu = array();
              // array_push($colu, $paints['photo_name']);
              // $nam = explode(',', $paints['photo_name']);
              // print_r($nam);
              // echo count($nam);
            ?>
          </span>

        </div>

    </div>
    <?php
    $countCarousel += 1; 
    endwhile ?>
  <?php else: ?>
    <div class="text-center">
      <h5 class="text-info">No Data Found</h5>
      <!-- <a href="./add_product.php">Add New Paint</a> -->
    </div>
  <?php endif ?>
</div>

<?php else: ?>
  <script LANGUAGE='JavaScript'>
    window.location.href='./';
  </script>
<?php endif ?>


<script>

</script>



<div class="modal fade" id="ReviewProduct" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-info">More About <strong id="name"></strong> </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
        <div class="row">
          <div class="col-md-4">
            <img src="" alt="Photo" width="100%" height="100%" id="image"/>
          </div>
          <div class="col-md-8">
            <div class="conatiner">
              <h5 class="text-info">PAINT INFORMATIONS</h5>
              <div class="row">
                <div class="col-md-6">Height: <span class="text-muted" id="height"></span> cm</div>
                <div class="col-md-6">Width: <span class="text-muted" id="width"></span> cm</div>
              </div>
              <div class="row">
                <div class="col-md-6">Stock: <span class="text-muted" id="stock"></span> pieces</div>
                <div class="col-md-6">Status: <span class="text-muted" id="status"></span></div>
              </div>
              <div class="row">
                <div class="col-md-6">Price: <span class="text-muted" id="price"></span> Rwf</div>
                <div class="col-md-6">Category: <span class="text-muted" id="category"></span></div>
              </div>
            </div>
<hr>
            <div class="conatiner">
              <h5 class="text-info">OWNER INFORMATIONS</h5>
              <div class="row">
                <div class="col-md-12">Name: <span class="text-muted" id="ve_name"></span></div>
              </div>
              <div class="row">
                <div class="col-md-12">Address: <span class="text-muted" id="owner"></span></div>
              </div>
              <div class="row">
                <div class="col-md-12">Email: <span class="text-muted" id="email"></span></div>
              </div>
            </div>
          </div>
        </div>
        
      </div>

    </div>
  </div>
</div>

<!-- Delete modal -->
<div class="modal fade" id="DeleteProduct" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
      
			<div class="modal-body">
        <div class="text-center">
          <h2 class="modal-title text-danger"><strong>Danger!</strong> </h2>
        </div><hr>
        <div class="container">
          <div class="row">
            <h5 class="text-danger">Are you sure to delete this <strong>Paint</strong>?</h5>
            <small class="text-muted">Paint deleted won't be recovered if you confirm delete!</small>
            <hr>
            <div>
              <form action="" method="post">
                <input type="hidden" name="pid" id="pid">
                <input class="btn btn-sm btn-danger" type="submit" name="c_dele" value="Confirm Delete"/>
                <a data-dismiss="modal" aria-label="Close" class="btn btn-sm btn-secondary">Cancel</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Delete modal -->
<div class="modal fade" id="EditProduct" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-body">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title text-info">Edit Paint</h5>
            <h6 class="card-subtitle text-muted">You can even add project, you are currently working on!</h6><hr>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-4 text-center">
                <img class="rounded-circle rounded mr-2 mb-2" id="edit_image" alt="Image" width="140" height="140">
                  <div class="mt-2">
                  <span class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit Image</span>
                </div>
              </div>

              <div class="col-md-8">
                <small>For best results, use an image at least 128px by 128px in .jpg format!</small><br>
                <small>Make sure to upload new picture with different angles to make your art recognisable easier</small><br><br>
                <label for="" class="form-label"><i class="fas fa-upload"></i> Add New Image</label>
                <input type="file" id="new_image" name="new_image" class="btn btn-sm" />
                <input type="hidden" id="photoid"><br>
                <span id="uploaded_image"></span>
                <!-- <span class="btn btn-sm btn-primary"><i class="fas fa-upload"></i> Add New Image</span> -->
              </div>
            </div><hr>
            <form method="POST" action="" enctype="multipart/form-data">
              <div class="form-group">
                <label class="form-label">Paint Name <span class="text-danger">*</span> </label>
                <input type="text" name="edit_name" id="edit_name" class="form-control" placeholder="E.g: Rwanda tradition stand">
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputAddress">Category<span class="text-danger">*</span></label>
                  <select name="edit_category" class="form-control">
                    <?php while($categ=$categories->fetch(PDO::FETCH_ASSOC)): ?>
                    <option id="edit_category" value="<?= $categ['catid'] ?>"><?= $categ['name'] ?></option>
                    <?php endwhile ?>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="inputAddress">Technics<span class="text-danger">*</span></label>
                  <select  name="edit_technics" class="form-control">
                    <!-- <option selected>Choose...</option> -->
                    <?php while($t = $technics->fetch(PDO::FETCH_ASSOC)): ?>
                      <option id="edit_technics" value="<?= $t['tech_id'] ?>"><?= $t['tech_name'] ?></option>
                    <?php endwhile ?>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="inputCity">Height<span class="text-danger">*</span></label>
                  <input type="text" name="edit_height" class="form-control" id="edit_height" placeholder="E.g: ">
                </div>
                <div class="form-group col-md-3">
                  <label for="inputZip">Width<span class="text-danger">*</span></label>
                  <input type="text" name="edit_width" class="form-control" id="edit_width" placeholder="E.g: ">
                </div>
                <div class="form-group col-md-2">
                  <label for="inputZip">Quantity<span class="text-danger">*</span></label>
                  <input type="number" name="edit_quantity" class="form-control" id="edit_quantity" placeholder="E.g: 5">
                </div>
                <div class="form-group col-md-3">
                  <label for="inputZip">Price<span class="text-danger">*</span></label>
                  <input type="text" name="edit_price" class="form-control" id="edit_price" placeholder="E.g: ">
                </div>
              </div>
              <button type="submit" class="btn btn-primary" name="update_paint">Confirm update</button>

            </form>
          </div>
        </div>


      </div>
    </div>
  </div>
</div>

