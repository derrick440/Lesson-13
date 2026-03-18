<?php
$SQLstring = "SELECT * FROM cart WHERE orderid is NULL AND ip='" . $_SERVER['REMOTE_ADDR'] . "'";
$cart_rs = $link->query($SQLstring);
?>
<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="./index.php"><img src="./images/logo.jpg" alt="電商藥粧" class="img-fluid rounded-circle"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

        <?php multlist01(); ?>
        <li class="nav-item">
          <a class="nav-link" href="#">會員註冊</a>
        </li>
        <?php if (!empty($_SESSION['login'])) { ?>
          <li class="nav-item">
            <a href="javascript:void(0);" onclick="btn_confirmLink('是否確定登出?','./logout.php')" class="nav-link">會員登出</a>
          </li>
        <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link" href="login.php">會員登入</a>
          </li>
        <?php } ?>
        <li class="nav-item">
          <a class="nav-link" href="#">會員中心</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            最新活動
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">查訂單</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">折價券</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./cart.php">購物車<span class="badge text-bg-info"><?= ($cart_rs) ? $cart_rs->rowCount() : '';  ?></span></a>
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
        <?php //multlist02(); 
        ?>
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
          <a href="#" class="dropdown-item dropdown-toggle"><i class="fas <?php echo $pyclass01_Rows['fonticon']; ?> fa-lg fa-fw"></i><?php echo $pyclass01_Rows['cname']; ?></a>
          <?php
          $SQLstring = sprintf("SELECT * FROM pyclass WHERE level = 2 AND uplink=%d ORDER By sort", $pyclass01_Rows['classid']);
          $pyclass02 = $link->query($SQLstring);
          ?>
          <ul class="dropdown-menu">
            <?php while ($pyclass02_Rows = $pyclass02->fetch()) { ?>
              <li><a href="drugstore.php?classid=<?= $pyclass02_Rows['classid']; ?>" class="dropdown-item"><em class="fas <?php echo $pyclass02_Rows['fonticon']; ?> fa-fw"></em><?php echo $pyclass02_Rows['cname'] ?></a></li>
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
            <a class="dropdown-item" href="drugstore.php?classid=<?= $pyclass02_Rows['classid']; ?>">
              <em class="fas <?php echo $pyclass02_Rows['fonticon']; ?> fa-fw"></em>
              <?php echo $pyclass02_Rows['cname'] ?>
            </a>
          </li>
        <?php } ?>
      </ul>
    </li>
  <?php } ?>
<?php } ?>