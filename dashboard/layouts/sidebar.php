



<div id="admin_nav" style="min-height: 410px!important;">
  <h2>Admin Menu</h2>
  <ul type="none"><br>
    <?php if($_SESSION['user_role'] == 2): ?>
      <!-- For Accountant -->
      <li><a href="./accountant.index.php" class='btn' style="width: 100%;">Home</a></li><br><br>
    <?php elseif($_SESSION['user_role'] == 3): ?>
      <!-- For Warehouse Keeper -->
      <li><a href="./warehouse.index.php" class='btn' style="width: 100%;">Home</a></li><br>
      <li><a href="./select_shop.php" class='btn' style="width: 100%;">Visit Shop</a></li><br>
      <li><a href="./warehouse.shipped.php" class='btn' style="width: 100%;">Shipped Orders</a></li><br>
      <li><a href="./new_coop.php" class='btn' style="width: 100%;">Manage Coop</a></li><br>
      <li><a href="./" class='btn' style="width: 100%;">Manage Farmers</a></li><br>

    <?php elseif($_SESSION['user_role'] == 4): ?>
      <!-- For Admins -->
      <li><a href="./promote_user.php" class='btn' style="width: 100%;">Validate Agent</a></li><br>
      <li><a href="./new_coop.php" class='btn' style="width: 100%;">Manage Coop</a></li><br>
      <li><a href="../register" class='btn' style="width: 100%;">Record New Agent</a></li><br>
      <li><a href="./select_shop.php" class='btn' style="width: 100%;">Visit Shop</a></li><br>
      <li><a href="./new_product.php" class='btn' style="width: 100%;">Manage Products</a></li><br>
    <?php else: ?>
      <!-- For Agents -->
      <li><a href="./" class='btn' style="width: 100%;">Manage Farmers</a></li><br>
      <li><a href="./new_coop.php" class='btn' style="width: 100%;">Manage Coop</a></li><br>
      <li><a href="./select_shop.php" class='btn' style="width: 100%;">Visit Shop</a></li><br>
      <li><a href="./orders.php" class='btn' style="width: 100%;">Review Your Orders</a></li><br>
    <?php endif ?>
  </ul>
</div>
