let token = sessionStorage.getItem("token");
let type = sessionStorage.getItem("type");
let role = sessionStorage.getItem("role");
let email = sessionStorage.getItem("email");
if (!email||!token || !role) {
    window.location.href = "Pages/login.php";
} 