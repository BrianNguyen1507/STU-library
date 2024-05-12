function getSuppliers() {
  $.ajax({
    url: "http://localhost:8085/api/filterNhaCungCap",
    type: "GET",
    contentType: "application/json",
    success: function (response) {
      displayList(response.contents);
    },
    error: function (xhr, status, error) {
      console.error("Error fetching suppliers:", error);
    },
  });
}

const themNhaCungCap = () => {
  Swal.fire({
    title: "Thêm Nhà Cung Cấp",
    html: `
    <div class="input-group">
        <span class="input-group-text" id="basic-addon3">Tên Nhà Cung Cấp</span>
        <input type="text" class="form-control" id="tenNhaCungCap" aria-describedby="basic-addon3 basic-addon4">
    </div>
    <div class="input-group">
        <span class="input-group-text" id="basic-addon3">Email</span>
        <input type="text" class="form-control" id="email" aria-describedby="basic-addon3 basic-addon4">
    </div>
    <div class="input-group">
        <span class="input-group-text" id="basic-addon3">Địa Chỉ</span>
        <input type="text" class="form-control" id="diaChi" aria-describedby="basic-addon3 basic-addon4">
    </div>
    <div class="input-group">
        <span class="input-group-text" id="basic-addon3">Điện Thoại</span>
        <input type="text" class="form-control" id="phonenumber" aria-describedby="basic-addon3 basic-addon4">
    </div>
`,
    showCancelButton: true,
    confirmButtonText: "Thêm Nhà Cung Cấp",
    showLoaderOnConfirm: true,
    preConfirm: async (login) => {},
    allowOutsideClick: () => !Swal.isLoading(),
  }).then((result) => {
    if (result.isConfirmed) {
      const tenNhaCungCap = $("#tenNhaCungCap").val();
      const email = $("#email").val();
      const diaChi = $("#diaChi").val();
      const dienThoai = $("#phonenumber").val();

      $.ajax({
        url: "http://localhost:8085/api/createNhaCungCap",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify({
          tenNhaCungCap,
          email,
          diaChi,
          dienThoai,
        }),
      })
        .done((response) => {
          Swal.fire({
            icon: "success",
            title: `Thêm nhà cung cấp mới thành công`,
          });
        })
        .fail((xhr) => {
          Swal.fire({
            icon: "error",
            title: `Thêm nhà cung cấp thất bại`,
          });
        });
    }
  });
};
