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
    .input-group>.form-control {
      width: 100%;
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
          <div class="row">
            <div class="col-12 text-center">
              <h1>會員註冊頁面</h1>
              <p>請輸入相關資料，*為必須輸入欄位</p>
            </div>
          </div>
          <div class="row">
            <div class="col-8 offset-2 text-left">
              <form id="reg" name="reg" action="./register.php" method="post">
                <div class="input-group mb-3">
                  <input type="email" name="email" id="email" class="form-control" placeholder="*請輸入email帳號" autocomplete="off">
                </div>
                <div class="input-group mb-3">
                  <input type="password" name="pw1" id="pw1" class="form-control" placeholder="*請輸入密碼">
                </div>
                <div class="input-group mb-3">
                  <input type="password" name="pw2" id="pw2" class="form-control" placeholder="*請再次輸入密碼">
                </div>
                <div class="input-group mb-3">
                  <input type="text" name="cname" id="cname" class="form-control" placeholder="*請輸入姓名">
                </div>
                <div class="input-group mb-3">
                  <input type="text" name="tssn" id="tssn" class="form-control" placeholder="*請輸入身份證字號">
                </div>
                <div class="input-group mb-3">
                  <input type="text" name="birthday" id="birthday" class="form-control" placeholder="*請選擇生日" onfocus="(this.type='date')">
                </div>
                <div class="input-group mb-3">
                  <input type="text" name="mobile" id="mobile" class="form-control" placeholder="請輸入手機號碼">
                </div>
                <div class="input-group mb-3">
                  <select name="myCity" id="myCity" class="form-control">
                    <option value="">請選擇市區</option>
                    <?php $city = "SELECT *FROM city WHERE State=0";
                    $city_rs = $link->query($city);
                    while ($city_rows = $city_rs->fetch()) { ?>
                      <option value="<?= $city_rows['AutoNo']; ?>"><?= $city_rows['Name'] ?></option>
                    <?php } ?>
                  </select>
                  <select name="myTown" id="myTown" class="form-control">
                    <option value="">請選擇地區</option>
                  </select>
                </div>
                <label for="address" class="form-label" id="zipcode" name="zipcode">郵遞區號:地址</label>
                <div class="input-group mb-3">
                  <input type="hidden" name="myZip" id="myZip">
                  <input type="text" name="address" id="address" class="form-control" placeholder="請輸入後續地址">
                </div>
                <label for="fileToUpload" class="form-label">上傳相片:</label>
                <div class="input-group mb-3">
                  <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" title="請上傳相片圖示" accept="image/x-png,image/jpeg,image/gif,image/jpg">
                  <p><button type="button" class="btn btn-danger" id="uploadForm" name="uploadForm">開始上傳</button></p>
                  <div id="progress-div01" class="progress" style="width: 100%;display:none;">
                    <div id="progress-bar01" class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">0%</div>
                  </div>
                  <input type="hidden" name="uploadname" id="uploadname" value="" />
                  <img src="" alt="photo" id="showing" name="showing" style="display: none;" class="img-fluid">
                </div>
                <div class="input-group mb-3">
                  <input type="hidden" name="captcha" id="captcha" value="">
                  <a href="javascript:void(0);" title="按我更新認證" onclick="getCaptcha">
                    <canvas id="can"></canvas>
                  </a>
                  <input type="text" name="recaptcha" id="recaptcha" class="form-control" placeholder="請輸入認證碼">
                </div>
                <input type="hidden" name="formctl" id="formctl" value="reg">
                <div class="input-group mb-3">
                  <button type="submit" class="btn btn-success btn-lg">送出</button>
                </div>
              </form>
            </div>
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
<script src="./commlib.js"></script>
<script>
  function getId(el) {
    return document.getElementById(el);
  }
  $("#uploadForm").click(function(e) {
    var fileName = $('#fileToUpload').val();
    if (!fileName) {
      alert("請先選擇圖片再上傳!");
      return false;
    }
    var idxDot = fileName.lastIndexOf(".") + 1;
    let extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
    if (extFile == "jpg" || extFile == "jpeg" || extFile == "png" || extFile == "gif") {
      $("#progress-div01").css("display", "flex");
      let file1 = getId("fileToUpload").files[0];
      let formdata = new FormData();
      formdata.append("file1", file1);
      let ajax = new XMLHttpRequest();
      ajax.upload.addEventListener("progress", progressHandler, false);
      ajax.addEventListener("load", completeHandler, false);
      ajax.addEventListener("error", errorHandler, false);
      ajax.addEventListener("abort", abortHandler, false);
      ajax.open("POST", "file_upload_parser.php");
      ajax.send(formdata);
      return false
    } else {
      alert("目前只支援jpg,jpeg,png,gif檔案格式上傳!");
    }
  });

  function progressHandler(event) {
    let percent = Math.round((event.loaded / event.total) * 100);
    $("#progress-bar01").css("width", percent + "%");
    $("#progress-bar01").html(percent + "%");
  }

  function completeHandler(event) {
    let data = JSON.parse(event.target.responseText);
    if (data.success === "true") {
      $("#uploadname").val(data.fileName);
      $("#showing").attr({
        'src': "uploads/" + data.fileName,
        'style': "display:block;"
      });
      $('button.btn.btn-danger').attr({
        'style': 'display:none;'
      });
    } else {
      alert(data.error);
    }
  }

  function errorHandler(event) {
    alert("Upload Failed:上傳發生錯誤");
  }

  function abortHandler(event) {
    alert("Upload Aborted:上傳作業取消");
  }
  $(function() {
    $("#myCity").change(function() {
      var CNo = $('#myCity').val();
      if (CNo == "") {
        return false;
      }
      $.ajax({
        url: 'Town_ajax.php',
        type: 'post',
        dataType: 'json',
        data: {
          CNo: CNo,
        },
        success: function(data) {
          if (data.c == true) {
            $('#myTown').html(data.m);
            $("#myZip").val("");
          } else {
            alert(data.m);
          }
        },
        error: function(data) {
          alert('系統目前無法連接到後台資料庫');
        }
      });
    });
    $("#myTown").change(function() {
      var AutoNo = $("#myTown").val();
      if (AutoNo == "") {
        return false;
      }
      $.ajax({
        url: "Zip_ajax.php",
        type: "get",
        dataType: "json",
        data: {
          AutoNo: AutoNo,
        },
        success: function(data) {
          if (data.c == true) {
            $("#myZip").val(data.Post);
            $("#zipcode").html(data.Post + data.Cityname + data.Name);
          } else {
            alert(data.m);
          }
        },
        error: function(data) {
          alert("系統目前無法連接到後台資料庫");
        }
      });
    });
  });

  function getCaptcha() {
    var inputTxt = document.getElementById("captcha");
    inputTxt.value = captchaCode("can", 150, 50, "blue", "white", "28px", 5);
  }
  $(function() {
    getCaptcha();
  })
</script>

</html>
