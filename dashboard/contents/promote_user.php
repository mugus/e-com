<?php
$sqly = "SELECT u.user_id,ur.role_name, u.firstname, u.lastname, u.email, u.user_role,u.status_code, u.join_date
        FROM users u 
        LEFT JOIN user_roles ur ON u.user_role = ur.role_code
        WHERE u.status_code = 1";
$stmtit = $db->prepare($sqly);
$stmtit->execute();

// roles
$sqlrole = "SELECT * FROM user_roles";
$stmtrole = $db->prepare($sqlrole);
$stmtrole->execute();

if(isset($_POST['activate'])){
    // echo "<script>alert('ready')</script>";
    $currentUser = $_POST['validateuser'];
    $new_role = $_POST['newrole'];

    $sql = "UPDATE users SET user_role= :user_role WHERE user_id = :user_id";
    $stmt = $db->prepare($sql);
    $stmt->execute(
        array(
            'user_role'=>$new_role,
            'user_id'=>$currentUser
        )
    );
    if($stmt->rowCount() > 0){
        $result = "<small>User Acticated successfully</small>";
        $alert = "alert-success";
    }else{
        $result = "<small>Something went wrong</small>";
        $alert = "alert-danger";
    }
}
?>
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
    <div class="card-body">
      <form onsubmit="" method="POST" action="" enctype="multipart/form-data">

        <div class="form-row">
          <div class="col-md-6">
            <label class="form-label">Select user <span class="text-danger">*</span></label>
            <select name="validateuser" id="">
                <option value="">Select </option>
                <?php while($row = $stmtit->fetch(PDO::FETCH_ASSOC)): ?>
                    <option value="<?= $row['user_id'] ?>"><?= $row['firstname'].' '.$row['lastname'].': '.$row['role_name'] ?></option>
                <?php endwhile ?>
            </select>
          </div>
        </div><br>
        <div class="form-row">
          <div class="col-md-6">
            <label class="form-label">Select New Role<span class="text-danger">*</span></label>
            <select name="newrole" id="">
                <option value="">Select</option>
                <?php while($row = $stmtrole->fetch(PDO::FETCH_ASSOC)): ?>
                    <option value="<?= $row['role_code'] ?>"><?= $row['role_name'] ?></option>
                <?php endwhile ?>
            </select>
          </div>
        </div><br>

        <button type="submit" class="btn btn-primary" id="validate" name="activate">Validate</button>
      </form>
    </div>
  </div>