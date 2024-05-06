<?php
try {
    $url = 'http://localhost:8085/api/filterTaiLieu';
    $data = file_get_contents($url);
    if ($data !== false) {
        $result = json_decode($data, true);

        foreach ($result['contents'] as $ele) {
            echo '
            <div class="swiper-slide">
                <div class="card position-relative p-4 border rounded-3">
                    <img src="' . $ele['hinhAnhDaiDien'] . '" class="img-fluid shadow-sm" alt="' . $ele['tenTaiLieu'] . '">
                    <h6 class="mt-4 mb-0 fw-bold"><a href="#" class="detail-link" data-id="' . $ele['id'] . '">' . $ele['tenTaiLieu'] . '</a></h6>
                    <p>Thể loại: ' . $ele['theLoai'] . '</p>
                    <p>Nhà xuất bản: ' . $ele['nhaXuatBan'] . '</p>
                    <p>Số lượng còn lại:</p>
                    <span class="price text-primary fw-bold mb-2 fs-5">' . $ele['soLuongTon'] . '</span>
                    <div class="card-concern position-absolute start-0 end-0 d-flex gap-2">
                        <a class="btn btn-dark detail-link" data-id="' . $ele['id'] . '">Xem chi tiết</a>
                        <a class="btn btn-dark add-link" data-id="' . $ele['id'] . '">Thêm</a>
                    </div>
                </div>
            </div>';
        }

        echo '<div class="pagination">';
        echo '<a href="#" class="prevBtn">Previous</a>';
        echo '<a href="#" class="nextBtn">Next</a>';
        echo '</div>';

    }
} catch (PDOException $err) {
    echo "<script>console.log('FAILED. Error: $err' );</script><br><br>";
}
?>

<script>
    $(".detail-link").click((e) => {
        e.preventDefault();
        const id = $(e.target).data("id");

        $.ajax({
            url: `http://localhost:8085/api/taiLieu_id=${id}`,
            type: "GET",
        }).done((data) => {
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
        }).fail((err) => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: id,
            });
        });
    });
</script>

<!-- <script src="utils/detail.js"></script> -->