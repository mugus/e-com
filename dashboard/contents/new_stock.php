<?php
$coo = "SELECT * FROM cooperatives";
$coops = $db->prepare($coo);
$coops->execute();


$pro = "SELECT id AS ps_id,product_size,name AS product_name,cat_name, stock FROM products_size p 
LEFT JOIN products pro ON p.product_id = pro.product_id
LEFT JOIN categories cat ON pro.cat_id = cat.cat_id";
$products = $db->prepare($pro);
$products->execute();

if(isset($_POST['add_stock'])){
    $ps_id = $_POST['ps_id'];
    $coop_id = $_POST['coop_id'];
    $stock = $_POST['stock'];

    $sql = "SELECT * FROM stock_mgt WHERE ps_id=:ps_id AND coop_id=:coop_id";
    $stmt = $db->prepare($sql);
    $stmt->execute(
        array(
            'ps_id'=>$ps_id,
            'coop_id'=>$coop_id
        )
    );
    if($stmt->rowCount() <= 0){
        $sql = "INSERT INTO stock_mgt (ps_id,coop_id,stock) VALUES (:ps_id,:coop_id,:stock)";
        $stmt = $db->prepare($sql);
        $stmt->execute(
            array(
                'ps_id'=>$ps_id,
                'coop_id'=>$coop_id,
                'stock'=>$stock
            )
        );
        if($stmt->rowCount() == 1){
            // update stock in products size
            $ps = "SELECT * FROM products_size WHERE id=:id";
            $ps_stmt = $db->prepare($ps);
            $ps_stmt->execute(
                array(
                    'id'=>$ps_id
                )
            );
            $row = $ps_stmt->fetch(PDO::FETCH_ASSOC);
            $current_stock = (int)$row['stock'];
            $new_stock = ($current_stock + (int)$stock);
            $sql = "UPDATE products_size SET stock=:stock WHERE id=:id";
            $stmt = $db->prepare($sql);
            $stmt->execute(
                array(
                    'id'=>$ps_id,
                    'stock'=>$new_stock
                )
            );
            if($stmt->rowCount() == 1){
                echo "<script language='javascript'>";
                echo "if(!alert('Stock Added successfully')){
                  window.location.replace('./new_product.php');
                }";
                echo "</script>";
            }else{
                echo "<script language='javascript'>";
                echo "if(!alert('Something went wrong! failed to update current stock')){
                  window.location.replace('./new_product.php');
                }";
                echo "</script>";
            }
        }else{
            echo "<script language='javascript'>";
                echo "if(!alert('Not inserted! Something went wrong! Try again')){
                  window.location.replace('./new_product.php');
                }";
                echo "</script>";
        }
    }else {
        # Product size exist in db
        echo "<script language='javascript'>";
        echo "if(!alert('Stock exist!Go to Manage Products->Stocks->Update Stock')){
          window.location.replace('./new_product.php');
        }";
        echo "</script>";
    }



}

?>
<div class="card">
    <div class="card-header">
      <h5 class="card-title">Products Stocks</h5>
      <h6 class="card-subtitle text-muted">Please Fill each Field to Complete Stock of product</h6>
    </div>
    <div class="card-body">
        <form onsubmit="" method="POST" action="" enctype="multipart/form-data">
            <div class="container">
                <div class="form-row">
                    <div class="form-group col-sm-6 col-6 col-md-6">
                        <label for="inputAddress">Product <span class="text-danger">*</span></label>
                        <select name="ps_id" id="" required>
                            <option value="" hidden>Select Product</option>
                            <?php while($row = $products->fetch(PDO::FETCH_ASSOC)): ?>
                                <option value="<?= $row['ps_id'] ?>"><?= $row['cat_name'].': '.$row['product_name'].': '.$row['product_size'] ?></option>
                            <?php endwhile ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-6 col-6 col-md-6">
                        <label for="inputAddress">Choose Warehouse <span class="text-danger">*</span></label>
                        <select name="coop_id" id="" required>
                            <option value="" hidden>Select Warehouse</option>
                            <?php while($row = $coops->fetch(PDO::FETCH_ASSOC)): ?>
                                <option value="<?= $row['coop_id'] ?>"><?= $row['coop_name'].': '.$row['district'] ?></option>
                            <?php endwhile ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-sm-12 col-12 col-md-12">
                        <label for="inputAddress">Product Stock(<span class="text-muted">Boxes</span>) <span
                            class="text-danger">*</span></label>
                        <input type="number" name="stock" id="stock" class="form-control" placeholder="E.g: 145" required>
                        <small class="text-danger" id="tech_msg"></small>
                    </div>
                </div>
                
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%" name="add_stock">Confirm Stock</button>
        </form>
    </div>
</div>