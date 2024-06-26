var getToken = sessionStorage.getItem("token");
if (getToken) {
  var headers = new Headers();
  headers.append("Authorization", "Bearer " + getToken);
  var request = new Request(
    "http://localhost:8085/api/NguoiDung/GetNguoiDung",
    {
      method: "GET",
      headers: headers,
      mode: "cors",
      cache: "default",
    }
  );
  fetch(request)
    .then((response) => response.json())
    .then((data) => {
      var userInfo = data;
      var userInfoHTML = "";
      userInfoHTML +=
        "<form id='user-update-form' onsubmit='handleUpdateSubmit(event)'>";
      userInfoHTML += "<div class='tab-content' id='nav-tabContent'>";
      userInfoHTML +=
        "<div class='tab-pane fade active show' id='nav-sign-in' role='tabpanel' aria-labelledby='nav-sign-in-tab'>";
      userInfoHTML += "<div class='form-group py-3'>";
      userInfoHTML += "<label class='mb-2' for='sign-in'>Email</label>";
      userInfoHTML +=
        "<input type='text' minlength='2' name='emailUsers' id='emailUsers' class='form-control w-100 rounded-3 p-3' value='" +
        userInfo.taiKhoan.email +
        "' readonly>";
      userInfoHTML += "</div>";
      userInfoHTML += "<div class='form-group pb-3'>";
      userInfoHTML +=
        "<label class='mb-2' for='sign-in'>Tên người dùng</label>";
      userInfoHTML +=
        "<input type='text' minlength='2' name='usernameUsers' id='usernameUsers' class='form-control w-100 rounded-3 p-3' value='" +
        userInfo.tenNguoiDung +
        "' required>";
      userInfoHTML += "</div>";
      userInfoHTML += "<div class='form-group pb-3'>";
      userInfoHTML += "<label class='mb-2' for='sign-in'>Địa chỉ</label>";
      userInfoHTML +=
        "<input type='text' minlength='2' name='diaChiUsers'  id='diaChiUsers' class='form-control w-100 rounded-3 p-3' value='" +
        userInfo.diaChi +
        "' required>";
      userInfoHTML += "</div>";
      userInfoHTML += "<div class='form-group pb-3'>";
      userInfoHTML += "<label class='mb-2' for='sign-in'>SĐT</label>";
      userInfoHTML +=
        "<input type='text' minlength='2' name='dienThoaiUsers' id='dienThoaiUsers' class='form-control w-100 rounded-3 p-3' value='" +
        userInfo.dienThoai +
        "' required>";
      userInfoHTML += "</div>";
      userInfoHTML += "<div id='update-response'></div>";
      userInfoHTML += "</div>";
      userInfoHTML +=
        "<button type='submit' class='btn btn-dark w-100 my-3'>Cập nhật</button>";
      userInfoHTML += "</div>";
      userInfoHTML += "</div>";
      userInfoHTML += "</form>";
      document.getElementById("user-info").innerHTML = userInfoHTML;
    })
    .catch((error) => console.error("Error:", error));
} else {
  console.log("Token not found in session storage");
}
function getUsers() {
  $.ajax({
    url: "http://localhost:8085/api/NguoiDung/filter",
    type: "GET",
    contentType: "application/json",
    success: function (response) {
      displayList(response.contents);
    },
    error: function (xhr, status, error) {
      console.error("Error fetching users:", error);
    },
  });
}
function displayList(data) {
  const list = $("#list");
  list.empty();
  data.forEach(function (item) {
    const row = $("<tr>");
    const idCell = $("<td>").text(item.id);
    const nameCell = $("<td>").text(item.tenNguoiDung);
    const emailCell = $("<td>").text(item.email || "");
    const addressCell = $("<td>").text(item.diaChi || "");
    const phoneCell = $("<td>").text(item.dienThoai || "");
    row.append(idCell, nameCell, emailCell, addressCell, phoneCell);
    list.append(row);
  });
  $("#listContainer").show();
}