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
                        <a href="#" class="btn btn-dark detail-link" data-id="' . $ele['id'] . '">Xem chi tiết</a>
                        <a href="#" class="btn btn-dark add-link" data-id="' . $ele['id'] . '">Thêm</a>
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

<script src="utils/detail.js"></script>