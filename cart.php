<?php
require_once('Connections/conn_db.php');
(!isset($_SESSION)) ? session_start() : "";
require_once("php_lib.php");


?>

<!doctype html>
<html lang="zh-tw">

<head>
  <?php require_once("./headfile.php"); ?>
  <style>
    table input:invalid {
      border: solid red 3px;
    }
  </style>
</head>

<body>
  <section id="header">
    <?php require_once("./navbar.php"); ?>
  </section>
  <section id="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2">
          <?php require_once("./sidebar.php"); ?>
          <?php require_once("./hot.php"); ?>
        </div>
        <div class="col-md-10">
          <?php require_once('cart_content.php');
          ?>

          <div class="table-responsive-md">
            <table class="table table-hover mt-3">
              <thead>
                <tr class="table-warning">
                  <td width="10%">產品編號</td>
                  <td width="10%">圖片</td>
                  <td width="25%">名稱</td>
                  <td width="15%">價格</td>
                  <td width="10%">數量</td>
                  <td width="15%">小計</td>
                  <td width="15%">下次再買</td>
                </tr>
              </thead>
              <?php while ($cart_data = $cart_rs->fetch()) { ?>
                <tbody>
                  <tr>
                    <td><?= $cart_data['p_id']; ?></td>
                    <td>
                      <img src="./product_img/<?= $cart_data['img_file']; ?>" alt="<?= $cart_data['p_name'] ?>" class="img-fluid">
                    </td>
                    <td>
                      <?= $cart_data['p_name'] ?>
                    </td>
                    <td>
                      <h4 class="color_e600a0 pt-1"><?= $cart_data['p_price'] ?></h4>
                    </td>
                    <td style="min-width: 100px;">
                      <div class="input-group">
                        <input type="number" class="form-control" name="qty[]" id="qty[]" value="<?= $cart_data['qty'] ?>" min="1" max="49" cartid="<?= $cart_data['cartid'] ?>" required>
                      </div>
                    </td>
                    <td>
                      $<?= $cart_data['p_price'] * $cart_data['qty'] ?>
                    </td>
                    <td><button type="button" id="btn[]" class="btn btn-danger" name="btn[]" onclick="btn_confirmLink('確定刪除本資料?','shopcart_del.php?mode=1&cartid=<?= $cart_data['cartid']; ?>')">取消</button></td>
                  </tr>
                <?php $ptotal += $cart_data['p_price'] * $cart_data['qty'];
              } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="7">累計:<?= $ptotal; ?></td>
                  </tr>
                  <tr>
                    <td colspan="7">運費:100</td>
                  </tr>
                  <tr>
                    <td colspan="7" class="color_red">總計:<?= $ptotal + 100; ?></td>
                  </tr>
                </tfoot>
            </table>
          </div>
        </div>

      </div>

    </div>
  </section>
  <hr>
  <section id="scontent">
    <?php require_once("./scontent.php"); ?>
  </section>
  <section id="footer">
    <?php require_once("./footer.php"); ?>
  </section>
  <button id="backToTop" onclick="scrollToTop()" style="display:none; position:fixed; bottom:20px; right:20px;">
    TOP
  </button>

</body>
<?php require_once("./jsfile.php"); ?>
<script>
  $("input").change(function() {
    var qty = $(this).val();
    const cartid = $(this).attr("cartid");
    if (qty <= 0 || qty >= 50) {
      alert("更改數量需大於0以上，以及小於50以下。");
      return false;
    }
    $.ajax({
      url: 'change_qty.php',
      type: 'post',
      dataType: 'json',
      data: {
        cartid: cartid,
        qty: qty,
      },
      success: function(data) {
        if (data.c == true) {
          //alert(data.m)
          window.location.reload();
        } else {
          alert(data.m);
        }
      },
      error: function(data) {
        alert("系統目前無法連接到後台資料庫");
      }
    });
  });
</script>

</html>