

<!-- Table data -->
<div class="row">
<div class="col-12 col-md-12">
    <div class="card">
      <div class="card-header">
        <h3>Collection of Registered Paintings</h3>
      </div>
      <div class="card-body">
        <div class="table-responsive" id="dataTablePaintings">
          <table id="paintingsTable"  style="width: 100%;" class="table table-bordered mb-0">
            <thead>
              <th scope="col">N<sup><u>0</u></sup></th>
              <th scope="col">NAME</th>
              <th scope="col">CATEGORY</th>
              <th scope="col">TECHNIC</th>
              <th scope="col">WIDTH</th>
              <th scope="col">HEIGHT</th>
              <th scope="col">QUANTITY</th>
              <th scope="col">PHOTO</th>
            </thead>
            <tbody>
              <?php
                  try{
                  $vid =  $_SESSION['vendorid'];
                  $stmt = $db->prepare("SELECT * FROM  paintings WHERE vendorid=:vendorid ORDER BY pid DESC");
                  $stmt->execute(array(
                    ':vendorid'=>$vid
                  ));
                  // $verfyrow = $stmt->fetch();
                  
                  $is_empty = $stmt->rowCount();
                  $i = 1;
                  if(!empty($is_empty)){ 
                      foreach($stmt as $row){
                          
                          ?>
                          <tr>
                            <td><?=$i++?></td>
                            <td><?=$row['name']?></td>
                              <?php
                                // Retrieve category of this Painting
                                $catStm = $db->prepare("SELECT * FROM  category  WHERE catid=:catid");
                                $catStm->execute(array(
                                  ':catid'=>$row['catid']
                                ));
                                $catRow = $catStm->fetch();
                                ?>
                            <td><?=$catRow['name']?></td>
                              <?php
                                // Retrieve Techinic Used on this Painting
                                $tecSt = $db->prepare("SELECT * FROM  technics  WHERE tech_id=:tech_id");
                                $tecSt->execute(array(
                                  ':tech_id'=>$row['tech_id']
                                ));
                                $tecRow = $tecSt->fetch();
                                ?>
                            <td><?=$tecRow['tech_name']?></td>
                            <td><?=$row['width']?></td>
                            <td><?=$row['height']?></td>
                            <td><?=$row['quantity']?></td>
                            <td>
                              <?php
                                $st2 = $db->prepare("SELECT * FROM  photo  WHERE photoid=:photoid");
                                $st2->execute(array(
                                  ':photoid'=>$row['photoid']
                                ));
                                foreach($st2 as $fot){
                                  $image = (!empty($fot['fileName'])) ? './Photos/Paintings/'.$fot['fileName'] : './Photos/Paintings/profile.png';
                              ?>
                              <img src='<?=$image?>' height='30px' width='30px'>
                              <span class='pull-right'><a href='#edit_photo' class='photo' data-toggle='modal' data-id="<?=$fot['id']?>"><i class='fa fa-edit'></i></a></span>
                              <?php }?>
                            </td>
                              
                          </tr>
                          <?php
                      }
                    }
                  }
                  catch(PDOException $e){
                  echo $e->getMessage();
                  }

              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>