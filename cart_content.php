<?php
$SQLstring = "SELECT *FROM cart,product,product_img WHERE ip='" . $_SERVER['REMOTE_ADDR'] . "' AND orderid IS NULL AND cart.p_id=product_img.p_id AND cart.p_id= product.p_id AND product_img.sort=1 ORDER BY cartid DESC";
$cart_rs = $link->query($SQLstring);
$ptotal = 0;
?>
<h3>商藥粧：購物車 </h3>
<?php if ($cart_rs->rowCount() != 0) { ?>
  <a href="index.php" id="btn01" name="btn01" class="btn btn-primary">繼續購物</a>
  <button type=button id="btn02" name="btn02" class="btn btn-info" onclick="window.history.go(-1)">回到上一頁</button>
  <button type=button id="btn03" name="btn03" class="btn btn-success" onclick="btn_confirmLink('確定清空購物車?','shopcart_del.php?mode=2')">清空購物車</button>
  <a href="checkout.php" class="btn btn-warning">前往結帳</a>
<?php } else { ?>
  <div class="alert alert-warning" role="alert">
    抱歉!目前購物車沒有相關產品。
  </div>
<?php } ?>