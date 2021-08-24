<?php
                                if($stmt->rowCount() > 0){
                                    while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
                                        // $total = (int)$res['price'] * (int)$res['qty'];
                                        ?>
                                        <tr>
                                            <td class="cart__product__item">
                                                <img src="img/shop-cart/cp-1.jpg" alt="">
                                                <div class="cart__product__item__title">
                                                    <h6><?= $res['name'] ?></h6>
                                                    <div class="rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart__price"><span id="price"><?= $res['price'] ?></span> Rwf</td>
                                            <td class="cart__quantity">
                                                <div class="pro-qty">
                                                    <input type="number" onchange="UpdateQty(<?= $res['pen_id'] ?>,<?= $res['pid'] ?>, this.value)" value="<?= $res['qty'] ?>" class="form-control" name="qty" id="qty"> 
                                                    <input type="hidden" value="<?= $res['pid'] ?>" class="pid" name="pid" id="pid"> 
                                                </div>
                                            </td>
                                            <td class="cart__total"><i id="total"></i><?= $res['Subtotal'] ?> Rwf</td>
                                            <td class="cart__close"><span class="icon_close"></span></td>
                                            <div id="result"></div>
                                        </tr>
                                    <?php }
                                }else{ ?>
                                        <tr>
                                            <td colspan="4" class="text-center text-info">Empty Cart</td>
                                        </tr>
                                <?php } ?>