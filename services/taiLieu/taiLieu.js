const getTaiLieu = (keywords) => {
  $(".product-swiper .swiper-wrapper").html("");
  $.ajax({
    url: keywords
      ? `http://localhost:8085/api/filterTaiLieu?keyword=${keywords}`
      : `http://localhost:8085/api/filterTaiLieu`,
    type: "GET",
    contentType: "application/json",
  })
    .done((response) => {
      const taiLieu = response.contents;
      taiLieu.forEach((item) => {
        const taiLieuItem = `
                <div class="swiper-slide">
                    <div class="card position-relative p-4 border rounded-3">
                        <img src="${item.hinhAnhDaiDien}" class="img-fluid shadow-sm" alt="">
                        <h6 class="mt-4 mb-0 fw-bold"><a href="#" class="detail-link" data-id="${item.id}">${item.tenTaiLieu}</a></h6>
                        <p>Thể loại: ${item.theLoai}</p>
                        <p>Nhà xuất bản: ${item.nhaXuatBan}</p>
                        <p>Số lượng còn lại: ${item.soLuongTon}</p>
                        <span class="price text-primary fw-bold mb-2 fs-5">${item.soLuongTon}</span>
                        <div class="card-concern position-absolute start-0 end-0 d-flex gap-2">
                            <a class="btn btn-dark detail-link" data-id="${item.id}" onClick="chiTietTaiLieu(this);">Xem chi tiết</a>
                            <a class="btn btn-dark add-link" data-id="${item.id}" onClick="chonPhieuMuon_taiLieu(this.getAttribute('data-id'))">Thêm</a>
                        </div>
                    </div>
                </div>
            `;
        $(".product-swiper .swiper-wrapper").append(taiLieuItem);
      });
    })
    .fail((error) => {
      console.log(error);
    });
};
const addTaiLieu = (phieuMuonId) => {
  if (selectedTaiLieuId != null) {
    const token = sessionStorage.getItem("token");
    const headers = {
      "Content-Type": "application/json",
      Authorization: `Bearer ${token}`,
    };

    const requestBody = JSON.stringify({
      phieuMuonId: phieuMuonId,
      taiLieuId: selectedTaiLieuId,
    });

    $.ajax({
      url: `http://localhost:8085/api/addTaiLieutoPhieuMuon?phieuMuonId=${phieuMuonId}&taiLieuId=${selectedTaiLieuId}`,
      type: "POST",
      headers: headers,
      contentType: "application/json",
      data: requestBody,
    })
      .done(() => {
        Swal.fire({
          icon: "success",
          title: `Thêm Tài Liệu vào Phiếu Mượn thành công!`,
        });
      })
      .fail((error) => {
        Swal.fire({
          icon: "error",
          title: `Thêm Tài Liệu vào Phiếu Mượn thất bại!`,
        });
      });
  } else {
    console.log("Không có tài liệu được chọn.");
  }
};
const themTaiLieu = () => {
  Swal.fire({
    title: "Thêm tài liệu",
    html: `
            <div class="input-group">
                <span class="input-group-text" id="basic-addon3">Tên tài liệu</span>
                <input type="text" class="form-control" id="tenTaiLieu" aria-describedby="basic-addon3 basic-addon4">
            </div>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon3">Tên tác giả</span>
                <input type="text" class="form-control" id="tenTacGia" aria-describedby="basic-addon3 basic-addon4">
            </div>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon3">Ngôn ngữ</span>
                <input type="text" class="form-control" id="ngonNgu" aria-describedby="basic-addon3 basic-addon4">
            </div>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon3">Thể loại</span>
                <input type="text" class="form-control" id="theLoai" aria-describedby="basic-addon3 basic-addon4">
            </div>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon3">Nhà xuất bản</span>
                <input type="text" class="form-control" id="nhaXuatBan" aria-describedby="basic-addon3 basic-addon4">
            </div>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon3">Nội dung</span>
                <input type="text" class="form-control" id="noiDung" aria-describedby="basic-addon3 basic-addon4">
            </div>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon3">Số lương tồn</span>
                <input type="text" class="form-control" id="soLuongTon" aria-describedby="basic-addon3 basic-addon4">
            </div>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon3">Hình ảnh đại diện</span>
                <input type="text" class="form-control" id="hinhAnhDaiDien" aria-describedby="basic-addon3 basic-addon4">
            </div>
        `,
    showCancelButton: true,
    confirmButtonText: "Thêm tài liệu",
    showLoaderOnConfirm: true,
    preConfirm: async (login) => {},
    allowOutsideClick: () => !Swal.isLoading(),
  }).then((result) => {
    if (result.isConfirmed) {
      const tenTaiLieu = $("#tenTaiLieu").val();
      const tenTacGia = $("#tenTacGia").val();
      const ngonNgu = $("#ngonNgu").val();
      const theLoai = $("#theLoai").val();
      const nhaXuatBan = $("#nhaXuatBan").val();
      const noiDung = $("#noiDung").val();
      const soLuongTon = $("#soLuongTon").val();
      const hinhAnhDaiDien = $("#hinhAnhDaiDien").val();
      $.ajax({
        url: "http://localhost:8085/api/createTaiLieu",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify({
          tenTaiLieu,
          tenTacGia,
          ngonNgu,
          theLoai,
          nhaXuatBan,
          noiDung,
          soLuongTon,
          hinhAnhDaiDien,
        }),
      })
        .done((response) => {
          getTaiLieu();
          Swal.fire({
            icon: "success",
            title: `Tạo tài liệu thành công`,
          });
        })
        .fail((error) => {
          Swal.fire({
            icon: "error",
            title: `Tạo tài liệu thất bại`,
          });
        });
    }
  });
};
const chiTietTaiLieu = (e) => {
  const id = $(e).data("id");

  $.ajax({
    url: `http://localhost:8085/api/taiLieu_id=${id}`,
    type: "GET",
  })
    .done((data) => {
      Swal.fire({
        title: data.tenTaiLieu,
        html: `
            <img src="${data.hinhAnhDaiDien}" class="img-fluid shadow-sm" alt="${data.tenTaiLieu}">
            <p>Tác giả: ${data.tenTacGia}</p>
            <p>Ngôn ngữ: ${data.ngonNgu}</p>
            <p>Thể loại: ${data.theLoai}</p>
            <p>Nhà xuất bản: ${data.nhaXuatBan}</p>
            <p>Nội dung: ${data.noiDung}</p>
            <p>Số lượng còn lại: ${data.soLuongTon}</p>
        `,
      });
    })
    .fail((err) => {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: id,
      });
    });
};
