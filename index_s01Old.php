<?php
require_once('Connections/conn_db.php');
(!isset($_SESSION)) ? session_start() : "";
require_once("php_lib.php");


?>

<!doctype html>
<html lang="zh-tw">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>電商藥粧</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.2.1/css/all.css">
  <link rel="stylesheet" href="website_s01.css">
</head>

<body>
  <section id="header">
    <nav class="navbar navbar-expand-lg fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="./images/logo.jpg" alt="電商藥粧" class="img-fluid rounded-circle"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

            <?php multlist01(); ?>
            <li class="nav-item">
              <a class="nav-link" href="#">會員註冊</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">會員登入</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">會員中心</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">最新活動</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">查訂單</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">折價券</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">購物車</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                企業專區
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">認識企業文化</a></li>
                <li><a class="dropdown-item" href="#">全台門市資訊</a></li>
                <li><a class="dropdown-item" href="#">供應商報價服務</a></li>
                <li><a class="dropdown-item" href="#">加盟專區</a></li>
                <li><a class="dropdown-item" href="#">投資人專區</a></li>
              </ul>
            </li>
            <?php multlist02(); ?>
          </ul>
        </div>
      </div>
    </nav>




    <?php
    function multlist01()
    {
      global $link;
      $SQLstring = "SELECT * FROM pyclass WHERE level = 1 ORDER BY sort";
      $pyclass01 = $link->query($SQLstring);
    ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" aria-expanded="false">
          產品資訊
        </a>
        <ul class="dropdown-menu">
          <?php while ($pyclass01_Rows = $pyclass01->fetch()) { ?>
            <li class="dropend">
              <a href="#" class="dropdown-item dropdown-toggle"><i class="fas <?php echo $pyclass01_Rows['fonticon']; ?> fa-lg fa-fw"><?php echo $pyclass01_Rows['cname']; ?></i></a>
              <?php
              $SQLstring = sprintf("SELECT * FROM pyclass WHERE level = 2 AND uplink=%d ORDER By sort", $pyclass01_Rows['classid']);
              $pyclass02 = $link->query($SQLstring);
              ?>
              <ul class="dropdown-menu">
                <?php while ($pyclass02_Rows = $pyclass02->fetch()) { ?>
                  <li><a href="#" class="dropdown-item"><em class="fas <?php echo $pyclass02_Rows['fonticon']; ?> fa-fw"></em><?php echo $pyclass02_Rows['cname'] ?></a></li>
                <?php } ?>
              </ul>
            </li>
          <?php } ?>
        </ul>
      </li>
    <?php } ?>





    <?php
    function multlist02()
    {
      global $link;
      $SQLstring = "SELECT * FROM pyclass WHERE level = 1 ORDER BY sort";
      $pyclass01 = $link->query($SQLstring);
    ?>
      <?php while ($pyclass01_Rows = $pyclass01->fetch()) { ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $pyclass01_Rows['cname']; ?>
          </a>
          <?php
          $SQLstring = sprintf("SELECT * FROM pyclass WHERE level = 2 AND uplink=%d ORDER By sort", $pyclass01_Rows['classid']);
          $pyclass02 = $link->query($SQLstring);
          ?>
          <ul class="dropdown-menu"> <?php while ($pyclass02_Rows = $pyclass02->fetch()) { ?>
              <li>
                <a class="dropdown-item" href="#">
                  <em class="fas <?php echo $pyclass02_Rows['fonticon']; ?> fa-fw"></em>
                  <?php echo $pyclass02_Rows['cname'] ?>
                </a>
              </li>
            <?php } ?>
          </ul>
        </li>
      <?php } ?>
    <?php } ?>



  </section>
  <section id="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2">
          <div class="sidebar">
            <form action="" method="get" name="search" id="search">
              <div class="input-group">
                <input type="text" name="search_name" class="form-control" placeholder="Search...">
                <span class="input-group-btn"><button class="btn btn-defult" type="submit"><i class="fas fa-search"></i></button></span>
              </div>
            </form>
          </div>
          <?php
          $SQLstring = "SELECT * FROM pyclass WHERE level = 1 ORDER BY sort";
          $pyclass01 = $link->query($SQLstring);
          $i = 1;
          ?>
          <div class="accordion" id="accordionExample">
            <?php while ($pyclass01_Rows = $pyclass01->fetch()) { ?>
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne<?php echo $i; ?>">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?php echo $i; ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $i; ?>">
                    <i class="fas <?php echo $pyclass01_Rows['fonticon']; ?> fa-lg fa-fw"></i><?php echo $pyclass01_Rows['cname']; ?>
                  </button>
                </h2>
                <?php
                $SQLstring = sprintf("SELECT * FROM pyclass WHERE level = 2 AND uplink=%d ORDER By sort", $pyclass01_Rows['classid']);
                $pyclass02 = $link->query($SQLstring);
                ?>
                <div id="collapseOne<?php echo $i; ?>" class="accordion-collapse collapse <?php echo ($i == 1) ? 'show' : ''; ?>" aria-labelledby="headingOne<?php echo $i; ?>" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <table class="table">
                      <?php while ($pyclass02_Rows = $pyclass02->fetch()) { ?>
                        <tr>
                          <td><a href="#"><em class="fas <?php echo $pyclass02_Rows['fonticon']; ?> fa-fw"></em><?php echo $pyclass02_Rows['cname'] ?></a></td>
                        </tr>
                      <?php } ?>
                    </table>
                  </div>
                </div>
              </div>
            <?php $i++;
            } ?>
          </div>
          <?php
          $SQLstring = "SELECT * FROM hot,product,product_img WHERE hot.p_id = product_img.p_id AND hot.p_id = product.p_id AND product_img.sort=1 ORDER BY h_sort";
          $hot = $link->query($SQLstring);
          ?>
          <div class="card text-center mt-3" style="border:none;">
            <div class="card-body">
              <h5 class="card-title">站長推薦，熱銷商品</h5>
            </div>
            <?php while ($data = $hot->fetch()) { ?>
              <img src="./product_img/<?php echo $data['img_file']; ?>" class="card-img-top" title="<?php echo $data['p_name']; ?>">
            <?php } ?>
          </div>
        </div>
        <div class="col-md-10">
          <?php
          $SQLstring = "SELECT * FROM carousel WHERE caro_online ORDER BY caro_sort";
          $carousel = $link->query($SQLstring);
          $i = 0;
          ?>
          <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <?php for ($i = 0; $i < $carousel->rowCount(); $i++) { ?>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $i; ?>" class="<?= activeShow($i, 0); ?>" aria-current="true" aria-label="Slide <?php echo $i; ?>"></button>
              <?php } ?>
            </div>
            <div class="carousel-inner">
              <?php $i = 0;
              while ($data = $carousel->fetch()) { ?>
                <div class="carousel-item <?php echo activeShow($i, 0); ?>">
                  <img src="./product_img/<?php echo $data['caro_pic']; ?>" class="d-block w-100" alt="<?php echo $data['caro_title']; ?>">
                  <div class="carousel-caption d-none d-md-block">
                    <h5><?php echo $data['caro_title']; ?></h5>
                    <p><?php echo $data['caro_content']; ?></p>
                  </div>
                </div>
              <?php $i++;
              } ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
          <hr>
          <?php
          $maxRows_rs = 12;
          $pageNum_rs = 0;
          if (isset($_GET['pageNum_rs'])) {
            $pageNum_rs = $_GET['pageNum_rs'];
          }
          $startRow_rs = $pageNum_rs * $maxRows_rs;


          $queryFirst = sprintf("SELECT * FROM product,product_img WHERE p_open=1 AND product_img.sort=1 AND product.p_id=product_img.p_id ORDER BY product.p_id DESC", $maxRows_rs);
          $query = sprintf("%s LIMIT %d,%d", $queryFirst, $startRow_rs, $maxRows_rs);
          $pList01 = $link->query($query);
          $i = 1;
          ?>
          <?php while ($pList01_Rows = $pList01->fetch()) { ?>
            <?php if ($i % 4 == 1) { ?><div class="row text-center"> <?php } ?>
              <div class="card col-md-3">
                <img src="./product_img/<?= $pList01_Rows['img_file']; ?>" class="card-img-top" alt="<?= $pList01_Rows['p_name']; ?>" title="<?= $pList01_Rows['p_name']; ?>">
                <div class="card-body d-flex flex-column">
                  <h5 class="card-title"><?= $pList01_Rows['p_name']; ?></h5>
                  <p class="card-text"><?= mb_substr($pList01_Rows['p_intro'], 0, 30, "utf-8"); ?></p>
                  <p>NT<?= $pList01_Rows['p_price']; ?></p>
                  <div class="mt-auto">
                    <a href="#" class="btn btn-primary">更多資訊</a>
                    <a href="#" class="btn btn-success">放購物車</a>
                  </div>
                </div>
              </div>
              <?php if ($i % 4 == 0 || $i == $pList01->rowCount()) { ?>
              </div><?php } ?>
          <?php $i++;
          } ?><div class="row mt-2">
            <?php
            if (isset($_GET['totalRows_rs'])) {
              $totalRow_rs = $_GET['totalRows_rs'];
            } else {
              $all_rs = $link->query($queryFirst);
              $totalRow_rs = $all_rs->rowCount();
            }
            $totalPages_rs = ceil($totalRow_rs / $maxRows_rs) - 1;
            $prev_rs = "&laquo;";
            $next_rs = "&raquo;";
            $separator = "|";
            $max_links = 20;
            $pages_rs = buildNavigation($pageNum_rs, $totalPages_rs, $prev_rs, $next_rs, $separator, $max_links, true, 3, "rs");
            ?>
            <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-center">
                <?= $pages_rs[0] . $pages_rs[1] . $pages_rs[2]; ?>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>
  <hr>
  <section id="scontent">
    <div class="container-fluid">
      <div id="aboutme" class="row text-center">
        <div class="col-md-2"><img src="./images/Qrcode02.png" alt="QRCODE" class="img-fluid mx-auto"></div>
        <div class="col-md-2">
          <i class="fas fa-thumbs-up fa-5x"></i>
          <h3>關於我們</h3>
          關於我們<br>
          企業官網<br>
          招商專區<br>
          人才招募<br>
        </div>
        <div class="col-md-2">
          <i class="fas fa-truck fa-5x"></i>
          <h3>特色服務</h3>
          特色服務<br>
          大宗採購方案<br>
          直配大陸<br>
        </div>
        <div class="col-md-2">
          <i class="fas fa-users fa-5x"></i>
          <h3>客戶服務</h3>
          客戶服務<br>
          訂單/配送進度查詢<br>
          取消訂單/退貨<br>
          更改配送地址<br>
          追蹤清單<br>
          12H速達服務<br>
          折價券說明<br>
        </div>
        <div class="col-md-2">
          <i class="fas fa-comments-dollar fa-5x"></i>
          <h3>好康大放送</h3>
          好康大放送<br>
          新會員禮包<br>
          活動得獎名單<br>
        </div>
        <div class="col-md-2">
          <i class="fas fa-question fa-5x"></i>
          <h3>FAQ 常見問題</h3>
          FAQ 常見問題<br>
          系統使用問題<br>
          產品問題資訊<br>
          大宗採購問題<br>
          聯絡我們<br>
        </div>
      </div>
    </div>
  </section>
  <section id="footer">
    <div class="container-fluid">
      <div id="last-data" class="row text-center">
        <div class="col-md-12">
          <h6>中彰投分屬科技股份有限公司 40767台中西屯區工業區一路100號 電話:04-23592181 免付費電話:0800-777888</h6>
          <h6>企業通過ISO/IEC27001認證，食品業者登錄字號:A-127360000-00000-0</h6>
          <h6>版權所有copyright &copy; 2017 WDA.com Inc. All Rights Reserved.</h6>
        </div>
      </div>
    </div>
  </section>
  <button id="backToTop" onclick="scrollToTop()" style="display:none; position:fixed; bottom:20px; right:20px;">
    TOP
  </button>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js">
</script>
<script type="text/javascript" src="./gotop.js"></script>

</html>