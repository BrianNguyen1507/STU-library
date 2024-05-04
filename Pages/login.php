<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Login Site</title>
  <!-- <link rel="icon" type="image/png" href="../assets/img/logo.png"> -->
  <link rel="stylesheet" href="../css/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
  <div class="center">
    <input type="checkbox" id="show" style="display: none;">
    <div class="container">
      <div class="text">
        Đăng nhập
      </div>
      <form action="" id="login-form" onsubmit="return handleSubmitLogin(event)">
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
        <div id="status"></div>
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
    window.onload = function () {
      document.getElementById('show').checked = true;
    };
  </script>



  <script>
    function handleSubmitLogin(event) {
      event.preventDefault();

      let email = document.getElementById("email").value;
      let password = document.getElementById("password").value;

      let loginData = {
        email: email,
        password: password,
      };

      sendLoginData(loginData);
    }

    function sendLoginData(loginData) {
      var xhr = new XMLHttpRequest();
      var url = '../modules/login/handleLogin.php';
      xhr.open("POST", url, true);
      xhr.setRequestHeader("Content-Type", "application/json");
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.token && response.role) {
              sessionStorage.setItem("token", response.token);
              sessionStorage.setItem("type", response.type);
              sessionStorage.setItem("role", response.role);
              sessionStorage.setItem("email", response.email);
              if (response.role === "Role_Student") {
                window.location.href = "../index.html";

                //phan trang
                // } else if (response.role === "admin") {
                //     window.location.href = "admin.php";
              } else {
                document.getElementById("status").innerText = "Unknown role";
                document.getElementById("status").style.color = "red";
              }
            } else {
              document.getElementById("status").innerText = "Login failed";
              document.getElementById("status").style.color = "red";
            }
          } else {
            document.getElementById("status").innerText = "Server error";
            document.getElementById("status").style.color = "red";
          }
        }
      };
      var jsonData = JSON.stringify(loginData);
      console.log(jsonData);
      xhr.send(jsonData);
    }
  </script>


</body>

</html>