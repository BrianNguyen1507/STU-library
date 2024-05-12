function getPhieuTra(keyword) {
  const url = keyword
    ? `http://localhost:8085/api/filterPhieuTraSach?keyword=${keyword}`
    : "http://localhost:8085/api/filterPhieuTraSach";

  $.ajax({
    url: url,
    type: "GET",
    contentType: "application/json",
    success: function (response) {
      displayListTra(response.contents);
    },
    error: function (xhr, status, error) {
      console.error("Error fetching users:", error);
    },
  });
}

function getPhieuMuon(keyword) {
  const url = keyword
    ? `http://localhost:8085/api/filterPhieuMuonChuaTra?keyword=${keyword}`
    : "http://localhost:8085/api/filterPhieuMuonChuaTra";

  $.ajax({
    url: url,
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
function taoPhieuTra(phieuMuonId) {
  const token = sessionStorage.getItem("token");
  const headers = {
    "Content-Type": "application/json",
    Authorization: `Bearer ${token}`,
  };
  $.ajax({
    url: `http://localhost:8085/api/addPhieuTraSach/phieuMuonId=${phieuMuonId}`,
    type: "POST",
    headers: headers,
    contentType: "application/json",
  })
    .done(() => {
      Swal.fire({
        icon: "success",
        title: `Tạo Phiếu Trả cho Phiếu mượn ${phieuMuonId} Thành Công!`,
      });
    })
    .fail((error) => {
      Swal.fire({
        icon: "error",
        title: `Tạo Phiếu Trả thất bại!`,
      });
    });
}
function displayListTra(data) {
  const list = $("#list-phieu-tra");
  list.empty();
  data.forEach(function (item) {
    const row = $("<tr>");
    const idCell = $("<td>").text(item.id);
    const ngayTra = $("<td>").text(
      !isNaN(Date.parse(item.ngayTra)) ? formatDate(item.ngayTra) : "Unknown"
    );
    const tienPhatCell = $("<td>").text(item.tienPhat || 0.0);

    const tenThuThuCell = $("<td>").text(
      item.thuThuXacNhanPhieuTra.tenNguoiDung || "Unknown"
    );
    const tenNguoiDung = $("<td>").text(
      item.phieuMuonDTO.nguoiDungDTO.tenNguoiDung || "Unknown"
    );
    const diaChiCell = $("<td>").text(
      item.phieuMuonDTO.nguoiDungDTO.diaChi || "Unknown"
    );
    const dienThoaiCell = $("<td>").text(
      item.phieuMuonDTO.nguoiDungDTO.dienThoai || "Unknown"
    );

    row.append(
      idCell,
      ngayTra,
      tienPhatCell,
      tenThuThuCell,
      tenNguoiDung,
      diaChiCell,
      dienThoaiCell
    );
    list.append(row);
    row.click(function () {
      $(".selected-row").removeClass("selected-row");
      row.addClass("selected-row");
      const getid = item.id;
    });
  });
  $("#listContainerTra").show();
}
