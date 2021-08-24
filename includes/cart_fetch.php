<?php 
include("../config/db.php");

$output = array('tablevalue'=>'');

$user_ip = $_SERVER['REMOTE_ADDR'];
$sql = "SELECT pc.id AS pen_id, pc.cart_code, pc.pid, pc.qty, pai.pid,pai.name,pai.catid,pai.tech_id,pai.vendorid,pai.quantity,
            pai.price,pai.status,pai.photoid ,pc.created_at,pai.price * pc.qty AS Subtotal
        FROM pending_cart pc 
        LEFT JOIN paintings pai ON pc.pid = pai.pid
        WHERE pc.cart_code = :cart_code";
 $stmt = $db->prepare($sql);
 $stmt->execute(array('cart_code'=>$user_ip));



  if($stmt->rowCount() > 0){
      while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
          // $total = (int)$res['price'] * (int)$res['qty'];
          $output['tablevalue'] .="
          <tr>
              <td class='cart__product__item'>
                  <img src='img/shop-cart/cp-1.jpg' alt=''>
                  <div class='cart__product__item__title'>
                      <h6>". $res['name'] ."</h6>
                      <div class='rating'>
                          <i class='fa fa-star'></i>
                          <i class='fa fa-star'></i>
                          <i class='fa fa-star'></i>
                          <i class='fa fa-star'></i>
                          <i class='fa fa-star'></i>
                      </div>
                  </div>
              </td>
              <td class='cart__price'><span id='price'>". $res['price'] ."</span> Rwf</td>
              <td class='cart__quantity'>
                  <div class='pro-qty'>
                      <input type='number' onchange='UpdateQty(". $res['pen_id'] .",". $res['pid'] .", this.value)' value='". $res['qty'] ."' class='form-control' name='qty' id='qty'> 
                      <input type='hidden' value='". $res['pid'] ."' class='pid' name='pid' id='pid'> 
                  </div>
              </td>
              <td class='cart__total'><i id='total'></i>". $res['Subtotal'] ." Rwf</td>
              <td class='cart__close'><a href='shop-cart.php?pen_id=".$res['pen_id']."'><span class='icon_close'></span></a></td>
              <div id='result'></div>
          </tr>";
          ?>
      <?php }
    }else{ 
    $output['tablevalue'] .="<tr>
              <td colspan='4' class='text-center text-info'>Empty Cart</td>
          </tr>";
    } 
  
echo json_encode($output);
  ?>