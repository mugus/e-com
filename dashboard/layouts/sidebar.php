



<div id="admin_nav">
  <h2>Admin Menu</h2>
  <ul type="none">
    <?php if($_SESSION['user_role'] == 2): ?>
      <li><a href="./accountant.index.php" class="btn text-left" style="width: 100%;">Home</a></li>
    <?php elseif($_SESSION['user_role'] == 3): ?>
      <li><a href="./warehouse.index.php" class="btn text-left" style="width: 100%;">Home</a></li>
      <li><a href="./warehouse.shipped.php" class="btn text-left" style="width: 100%;">Shipped Orders</a></li>
    <?php else: ?>
      <li><a href="./" class="btn text-left" style="width: 100%;">Manage Farmers</a></li>
      <li><a href="../shop" class="btn text-left" style="width: 100%;">Visit Shop</a></li>
      <li><a href="./new_farmer.php" class="btn text-left" style="width: 100%;">Record New Farmer</a></li>
      <li><a href="../register" class="btn text-left" style="width: 100%;">Record New Agent</a></li>
      <li><a href="./new_product.php" class="btn text-left" style="width: 100%;">Record New Product</a></li>
      <li><a href="./new_coop.php" class="btn text-left" style="width: 100%;">Record New Coop</a></li>
      <li><a href="#" class="btn text-left" style="width: 100%;">Validate Agent</a></li>
      <li><a href="./orders.php" class="btn text-left" style="width: 100%;">Review Your Orders</a></li>
    <?php endif ?>
  </ul>
</div>
<div id="phone_nav">
  <h2>Admin Menu</h2>
  <ul type="none">
    <?php if($_SESSION['user_role'] == 2): ?>
      <li><a href="./accountant.index.php" class="btn text-left" style="width: 100%;">Home</a></li>
    <?php elseif($_SESSION['user_role'] == 3): ?>
      <li><a href="./warehouse.index.php" class="btn text-left" style="width: 100%;">Home</a></li>
      <li><a href="./warehouse.shipped.php" class="btn text-left" style="width: 100%;">Shipped Orders</a></li>
    <?php else: ?>
      <li><a href="./" class="btn text-left" style="width: 100%;">Manage Farmers</a></li>
      <li><a href="../shop" class="btn text-left" style="width: 100%;">Visit Shop</a></li>
      <li><a href="./new_farmer.php" class="btn text-left" style="width: 100%;">Record New Farmer</a></li>
      <li><a href="../register" class="btn text-left" style="width: 100%;">Record New Agent</a></li>
      <li><a href="./new_product.php" class="btn text-left" style="width: 100%;">Record New Product</a></li>
      <li><a href="./new_coop.php" class="btn text-left" style="width: 100%;">Record New Coop</a></li>
      <li><a href="#" class="btn text-left" style="width: 100%;">Validate Agent</a></li>
      <li><a href="./orders.php" class="btn text-left" style="width: 100%;">Review Your Orders</a></li>
    <?php endif ?>
    
  </ul>
</div>