<?php
require_once('Connections/conn_db.php');
(!isset($_SESSION)) ? session_start() : "";
require_once("php_lib.php");


?>

<!doctype html>
<html lang="zh-tw">

<head>
  <?php require_once("./headfile.php"); ?>
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
          <?php require_once("./checkout.php") ?>
          <h3>電商藥粧:會員結帳作業</h3>
          <div class="row">
            <div class="card col">
              <div class="card-header" style="color:#007bff;"><i class="fas fa-truck fa-flip-horizontal me-1"></i>配送資訊
              </div>
              <div class="card-body">
                <h4 class="card-title">收件人資訊：</h4>
                <h5 class="card-title">姓名：李小明</h5>
                <p class="card-text">電話：0912345678</p>
                <p class="card-text">郵遞區號：407台中市西屯區</p>
                <p class="card-text">地址：中正路1號</p>
                <a href="#" class="btn btn-outline-primary">選擇其他收件人</a>
              </div>
            </div>
            <div class="card col ms-3">
              <div class="card-header" style="color:#000;"><i class="fas fa-credit-card me-1"></i>配送資訊
              </div>
              <div class="card-body">
                <h4 class="card-title">收件人資訊：</h4>
                <h5 class="card-title">姓名：李小明</h5>
                <p class="card-text">電話：0912345678</p>
                <p class="card-text">郵遞區號：407台中市西屯區</p>
                <p class="card-text">地址：中正路1號</p>
                <a href="#" class="btn btn-outline-primary">選擇其他收件人</a>
              </div>
            </div>
          </div>
          <div class="table-responsive-md">
            <table class="table table-hover mt-3">
              <thead>
                <tr class="text-bg-primary">
                  <td width="10%">產品編號</td>
                  <td width="10%">圖片</td>
                  <td width="30%">名稱</td>
                  <td width="15%">價格</td>
                  <td width="15%">數量</td>
                  <td width="20%">小計</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td><img src="./product_img/zoom-front-174388.webp" alt="Maybelline 媚比琳純淨礦物極效幻膚BB凝
露 升級版 SPF 50/PA++++ 01白皙色" class="img-fluid"></td>
                  <td>Maybelline 媚比琳純淨礦物極效幻膚BB凝
                    露 升級版 SPF 50/PA++++ 01白皙色</td>
                  <td>
                    <h4 class="color_e600a0 pt-1">
                      $999
                    </h4>
                  </td>
                  <td>10</td>
                  <td>
                    <h4 class="color_e600a0 pt-1">$999</h4>
                  </td>
                </tr>
                <tr>
                  <td>2</td>
                  <td><img src="./product_img/zoom-front-174388.webp" alt="Maybelline 媚比琳純淨礦物極效幻膚BB凝
露 升級版 SPF 50/PA++++ 01白皙色" class="img-fluid"></td>
                  <td>Maybelline 媚比琳純淨礦物極效幻膚BB凝
                    露 升級版 SPF 50/PA++++ 01白皙色</td>
                  <td>
                    <h4 class="color_e600a0 pt-1">
                      $999
                    </h4>
                  </td>
                  <td>10</td>
                  <td>
                    <h4 class="color_e600a0 pt-1">$999</h4>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="7">
                    累計:123456
                  </td>
                </tr>
                <tr>
                  <td colspan="7">
                    運費:100
                  </td>
                </tr>
                <tr>
                  <td colspan="7" class="color_red">
                    總計:123456
                  </td>
                </tr>
                <tr>
                  <td colspan="7">
                    <button type="button" id="btn04" name="btn-4" class="btn btn-danger"><i class="fas fa-cart-arrow-down pe-2"></i>確認結帳</button>
                  </td>
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

</html>