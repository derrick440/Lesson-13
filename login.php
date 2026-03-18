<?php
require_once('Connections/conn_db.php');
(!isset($_SESSION)) ? session_start() : "";
require_once("php_lib.php");


?>
<?php
if (isset($_GET['sPath'])) {
  $sPath = $_GET['sPath'] . ".php";
} else {
  $sPath = "./index.php";
}
if (!empty($_SESSION['login'])) {
  header(sprintf("location:%s", $sPath));
  // echo "<script>window.location.href='" . $sPath . "';</script>";
}
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
          <?php require_once("./login_content.php")
          ?>
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
  <div id="loading" style="display: none;position:fixed;width:100%;height:100%;top:0;left:0;background-color:rgba(255, 255  , 255, 0.5);z-index:9999;"><i class="fas fa-spinner fa-spin fa-5x fa-fw" style="position: absolute;top:50%;left:50%;"></i></div>
</body>
<?php require_once("./jsfile.php"); ?>
<script>
  $(function() {
    $("#form1").submit(function(e) {
      e.preventDefault();
      const inputAccount = $("#inputAccount").val();
      const inputPassword = $("#inputPassword").val();
      $("#loading").show();
      $.ajax({
        url: 'auth_user.php',
        type: 'post',
        dataType: 'json',
        data: {
          inputAccount: inputAccount,
          inputPassword: inputPassword,
        },
        success: function(data) {
          if (data.c == true) {
            alert(data.m);
            window.location.href = "<?= $sPath ?>";
          } else {
            alert(data.m);
          }
        },
        error: function(data) {
          alert("系統目前無法連接到後台資料庫");
        }
      })
    })
  });
</script>

</html>
