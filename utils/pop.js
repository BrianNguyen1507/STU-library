window.addEventListener('popstate', function(event) {
    sessionStorage.clear();
    window.location.href = "Pages/login.php";
});