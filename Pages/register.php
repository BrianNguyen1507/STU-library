<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Registration Site</title>
  <!-- <link rel="icon" type="image/png" href="../assets/img/logo.png"> -->
  <link rel="stylesheet" href="../css/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

</head>
<script src="../utils/closed.js"></script>
<body>
  <div class="center">
    <input type="checkbox" id="show" style="display: none;">
    <div class="container">
      <label for="show" class="close-btn fas fa-times" title="close" id="closeBtn"></label>
      <div class="text">
        Đăng ký
      </div>
      <form action="" method="POST" id="register-form" onsubmit="return handleSubmitRegister(event)">
        <div class="data">
          <label>Họ và tên</label>
          <input type="text" required id="tenDangNhap" name="tenDangNhap" placeholder="Họ và tên">
        </div>
        <div class="data">
          <label>Email</label>
          <input type="email" required id="email" name="email" placeholder="Email">
        </div>
        <div class="data">
          <label>Mật khẩu</label>
          <input type="password" required id="password" name="password" placeholder="Mật khẩu">
        </div>
        <div class="data">
          <label>Xác nhận mật khẩu</label>
          <input type="password" required id="passwordConfirm" name="passwordConfirm" placeholder="Xác nhận mật khẩu">
        </div>
        <div class="data">
          <label>Role</label>
          <input type="text" required id="phanQuyenId" name="phanQuyenId" placeholder="Role">
        </div>
        <div id="status"></div>
        <div class="btn">
          <div class="inner"></div>
          <button type="submit">Đăng ký</button>
        </div>
        <div class="signup-link">
          Bạn đã có tài khoản? <a href="login.php">Đăng nhập</a>
        </div>
      </form>
    </div>
  </div>

  <script>
    function handleSubmitRegister(event) {
      event.preventDefault();
      let username = document.getElementById("tenDangNhap").value;
      let email = document.getElementById("email").value;
      let password = document.getElementById("password").value;
      let confirmPassword = document.getElementById("passwordConfirm").value;
      let role = parseInt(document.getElementById("phanQuyenId").value);

      let registrationData = {
        tenDangNhap: username,
        email: email,
        password: password,
        passwordConfirm: confirmPassword,
        phanQuyenId: role
      };
      sendRegistrationData(registrationData);
    }


    function sendRegistrationData(registrationData) {
      fetch('../modules/register/handleRegister.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(registrationData),
      })
        .then(response => {
          if (!response.ok) {
            throw new Error('Server error');
          }
          return response.json();
        })
        .then(data => {
          if (data.httpCode === 200 && data.message === "Tao user thanh cong") {
            setTimeout(() => {
              window.location.href = "login.php";
            }, 2000);
            document.getElementById("status").innerText = data.message;
            document.getElementById("status").style.color = "green";
          } else {
            console.error("Registration failed:", data.message);
            document.getElementById("status").innerText = data.message;
            document.getElementById("status").style.color = "red";
          }
        })
        .catch(error => {
          console.error("Error:", error.message);
          document.getElementById("status").innerText = error.message;
          document.getElementById("status").style.color = "red";
        });
    }

  </script>

  <script>
    window.onload = function () {
      document.getElementById('show').checked = true;
    };
  </script>
</body