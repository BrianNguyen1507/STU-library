const getPhieuMuon = () => {
  const token = sessionStorage.getItem("token");
  const headers = {
    "Content-Type": "application/json",
    Authorization: `Bearer ${token}`,
  };
  $.ajax({
    url: "http://localhost:8085/api/getPhieuMuonAuthentication",
    type: "GET",
    headers: headers,
    contentType: "application/json",
  })
    .done((response) => {
      const phieuMuonItems = response
        .map((phieuMuon) => {
          return phieuMuon.xacNhanMuon === "false"
            ? `
<li class="list-group-item bg-transparent d-flex justify-content-between lh-sm" data-phieu-muon-id="${
                phieuMuon.id
              }">
    <div>
        <h5>
            <a href="">Phiếu Mượn Số: ${phieuMuon.id}</a>
        </h5>
        <h6>Ngày mượn: <span><small> ${
          phieuMuon.ngayMuon
            ? formatDate(phieuMuon.ngayMuon)
            : "Chưa có dữ liệu"
        }</small></span></h6>
        <h6>Hạn mượn:<span><small> ${
          phieuMuon.hanMuon ? formatDate(phieuMuon.hanMuon) : "Chưa có dữ liệu"
        }</small></span></h6>
        <h6>Trạng thái mượn:  <span><small>${
          phieuMuon.xacNhanMuon == "true" ? "Đã xác nhận" : "Chưa xác nhận"
        }</small></span> </h6>
    </div>
    <button id="button-hit" style="padding: 10px 10px;" class="btn btn-primary btn-select"  data-phieumuon="${
      phieuMuon.id
    }" onClick="addTaiLieu(this.getAttribute('data-phieumuon'))">Chọn</button>
    </li>
`
            : ``;
        })
        .join("");
      $(".list-PhieuMuon , .custom-class").html(phieuMuonItems);
      $(".custom-class #button-hit").hide();
    })
    .fail((error) => {
      console.log(error);
    });
};

const taoPhieuMuon = () => {
  Swal.fire({
    title: "Bạn muốn tạo phiếu mượn?",
    icon: "info",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "OK",
  }).then((result) => {
    if (result.isConfirmed) {
      const token = sessionStorage.getItem("token");
      const headers = {
        "Content-Type": "application/json",
        Authorization: `Bearer ${token}`,
      };

      $.ajax({
        url: "http://localhost:8085/api/addPhieuMuon",
        type: "POST",
        headers: headers,
        contentType: "application/json",
        data: JSON.stringify({}),
        success: function (response) {
          Swal.fire({
            icon: "success",
            title: `Tạo phiếu mượn thành công`,
          });
          getPhieuMuon();
        },
        error: function (xhr, status, error) {
          Swal.fire({
            icon: "error",
            title: `Tạo phiếu mượn thất bại`,
          });
        },
      });
    }
  });
};
function displayList(data) {
  let role = sessionStorage.getItem("role");
  const list = $("#list-phieu");
  list.empty();
  data.forEach(function (item) {
    const row = $("<tr>");
    const idCell = $("<td>").text(item.id);
    const ngayMuonCell = $("<td>").text(
      !isNaN(Date.parse(item.ngayMuon)) ? formatDate(item.ngayMuon) : "Unknown"
    );
    const hanMuonCell = $("<td>").text(
      !isNaN(Date.parse(item.hanMuon)) ? formatDate(item.hanMuon) : "Unknown"
    );
    const trangthaiCell = $("<td>").text(
      item.xacNhanMuon === "true" ? "Đã xác nhận" : "Chưa xác nhận"
    );
    const tenNguoiDungCell = $("<td>").text(
      item.nguoiDungDTO.tenNguoiDung || "Unknown"
    );
    const diaChiCell = $("<td>").text(item.nguoiDungDTO.diaChi || "Unknown");
    const dienThoaiCell = $("<td>").text(
      item.nguoiDungDTO.dienThoai || "Unknown"
    );
    const confirmButton = $("<button>")
      .text("Xác nhận")
      .addClass("btn btn-primary confirm-button")
      .click(function () {
        Swal.fire({
          title: "Xác nhận",
          text: `Bạn có chắc xác nhận Phiếu mượn ${item.id} ?`,
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Xác nhận",
        }).then((result) => {
          if (result.isConfirmed) {
            xacNhanMuon(item.id);
            window.location.reload();
          }
        });
      });
    const returnButton = $("<button>")
      .text("Tạo Phiếu Trả")
      .addClass("btn btn-primary confirm-button")
      .click(function () {
        Swal.fire({
          title: "Xác nhân Trả",
          text: `Tạo Phiếu Trả cho người dùng ${item.nguoiDungDTO.tenNguoiDung} \n với số phiếu mượn: ${item.id}?`,
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Xác nhận",
        }).then((result) => {
          if (result.isConfirmed) {
            taoPhieuTra(item.id);
            window.location.reload();
          }
        });
      });
    if (role !== "Role_LibraryManager") {
      confirmButton.hide();
      returnButton.hide();
    } else {
      if (item.xacNhanMuon === "true") {
        confirmButton.hide();
        returnButton.show();
      } else {
        confirmButton.show();
        returnButton.hide();
      }
    }
    const confirmCell = $("<td>").append(confirmButton);
    const returnCell = $("<td>").append(returnButton);
    row.click(function () {
      $(".selected-row").removeClass("selected-row");
      row.addClass("selected-row");
      const getid = item.id;
    });
    row.append(
      idCell,
      ngayMuonCell,
      hanMuonCell,
      trangthaiCell,
      tenNguoiDungCell,
      diaChiCell,
      dienThoaiCell,
      confirmCell,
      returnCell
    );
    list.append(row);
  });
  $("#listContainer").show();
}