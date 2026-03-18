<style>
  .col-md-10 {
    background-repeat: no-repeat;
    background-image: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));
  }

  .mycard.mycard-container {
    max-width: 400px;
    height: 450px;
  }

  .mycard {
    background-color: #f7f7f7;
    padding: 20px 25px 30px;
    margin: 0 auto 25px;
    margin-top: 50px;
    border-radius: 10px;

  }

  .profile-img-card {
    margin: 0 auto 10px auto;
    display: block;
    width: 100px;
  }

  .profile-name-card {
    font-size: 20px;
    text-align: center;
  }

  .form-sigin input[type="email"],
  .form-sigin input[type="password"],
  .form-sigin button {
    width: 100%;
    height: 44px;
    font-size: 16px;
    display: block;
    margin-bottom: 20px;
  }

  .btn.btn-sigin {
    font-weight: 700;
    background-color: rgb(104, 145, 162);
    color: white;
    height: 38px;
    transition: background-color 1s;
  }

  .btn.btn.btn-sigin:hover,
  .btn.btn.btn-sigin:active,
  .btn.btn.btn-sigin:focus {
    background-color: rgb(12, 97, 33);
  }

  .other a {
    color: rgb(104, 145, 162);
  }

  .other a:hover,
  .other a:active,
  .other a:focus {
    color: rgb(12, 97, 33);
  }
</style>
<div class="mycard mycard-container">
  <img id="profile-img" class="profile-img-card" src="./images/logo03.svg" alt="logo">
  <p id="profile-name" class="profile-name-card">電商藥粧:會員登入</p>
  <form action="" method="post" class="form-sigin" id="form1">
    <input type="email" id="inputAccount" name="inputAccount" class="form-control" placeholder="Account" required autofocus>
    <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
    <button type="submit" class="btn btn-sigin mt-4">sign in</button>
    <div class="other mt-5 text-center">
      <a href="reqister.php">New user/</a><a href="#">Forgot the password?</a>
    </div>
</div>
</form>

</div>