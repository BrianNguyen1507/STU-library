<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Login Site</title>
  <link rel="stylesheet" href="./css/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="icon" type="image/x-icon" href="images/logo/Logo_STU.pn" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <div class="center">
    <input type="checkbox" id="show" style="display: none;">
    <div class="container">
      <div class="text">
        Đăng nhập
      </div>
      <form action="" id="login-form" onsubmit="handleSubmitLogin(event)">
        <div class="data">
          <label>Email</label>
          <input type="text" required id="email" name="email" placeholder="Email">
        </div>
        <div class="data">
          <label>Mật khẩu</label>
          <input type="password" required id="password" name="password" placeholder="Mật khẩu">
        </div>
        <div class="forgot-pass">
          <a href="#">Quên mật khẩu?</a>
        </div></br>
        <div class="btn">
          <div class="inner"></div>
          <button type="submit">login</button>
        </div>
        <div class="signup-link">
          Chưa có tài khoản? <a href="register.php"> Đăng ký ngay</a>
        </div>
      </form>
    </div>
  </div>
  <script>
    $(() => {
      document.getElementById('show').checked = true;
      sessionStorage.getItem("token") && (window.location.href = "index.php");
    });

    function handleSubmitLogin(event) {
      event.preventDefault();

      const email = $("#email").val();
      const password = $("#password").val();
      sendLoginData({
        email: email,
        password: password,
      });
    }
    function sendLoginData(loginData) {
      $.ajax({
        url: "http://localhost:8085/api/login",
        type: "POST",
        data: JSON.stringify(loginData),
        contentType: "application/json",
      }).done((data) => {
        sessionStorage.setItem("token", data.token);
        sessionStorage.setItem("email", data.email);
        sessionStorage.setItem("role", data.role);
        window.location.href = "index.php";
      }).fail((data) => {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Email hoặc mật khẩu không đúng!',
        })
      });
    }
  </script>
</body>

</html>