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
          <?php require_once('./breadcrumb.php'); ?>
          <?php require_once("./goods_content.php")
          ?>
        </div>
      </div>
    </div>
  </section>
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
<script type="text/javascript" src="./fancybox-2.1.7/source/jquery.fancybox.js"></script>
<script type="text/javascript">
  $(function() {
    $('.card .row.mt-2 .col-md-4 a').mouseover(function() {
      var imgsrc = $(this).children("img").attr("src");
      $("#showGoods").attr({
        "src": imgsrc
      });
    });
    $(".fancybox").fancybox();
  });
</script>


</html>