<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Registration Site</title>
  <!-- <link rel="icon" type="image/png" href="../assets/img/logo.png"> -->
  <link rel="stylesheet" href="./css/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
          <label>Chức vụ</label>
          <select id="phanQuyenId" name="phanQuyenId" class="select-pretty">
            <option value="4">Sinh Viên</option>
            <option value="3">Giảng Viên</option>
          </select>
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
    $(() => {
      document.getElementById('show').checked = true;
      sessionStorage.getItem("token") && (window.location.href = "index.php");
    });

    function handleSubmitRegister(event) {
      event.preventDefault();
      const username = $("#tenDangNhap").val();
      const email = $("#email").val();
      const password = $("#password").val();
      const confirmPassword = $("#passwordConfirm").val();
      const role = $("#phanQuyenId").val();;

      sendRegistrationData({
        tenDangNhap: username,
        email: email,
        password: password,
        passwordConfirm: confirmPassword,
        phanQuyenId: role
      });
    }


    function sendRegistrationData(registrationData) {
      $.ajax({
        url: 'modules/register/handleRegister.php',
        type: 'POST',
        data: JSON.stringify(registrationData),
      }).done((data) => {
        Swal.fire({
          icon: 'success',
          title: 'Đăng ký thành công!',
          showConfirmButton: false,
          timer: 1500
        });
        setTimeout(() => {
          window.location.href = "login.php";
        }, 1500);
      }).fail((data) => {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Đăng ký thất bại!',
        })
      });
    }
  </script>
</body