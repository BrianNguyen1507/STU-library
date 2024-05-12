<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Detail</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<script src="../../utils/checkin.js"></script>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php
                try {
                    function fetchDocumentById($id)
                    {
                        $url = 'http://localhost:8085/api/taiLieu_id=' . $id;
                        $data = file_get_contents($url);
                        if ($data !== false) {
                            $document = json_decode($data, true);
                            return $document;
                        } else {
                            return null;
                        }
                    }
                    $id = isset($_GET['id']) ? $_GET['id'] : null;
                    if ($id !== null) {
                        $document = fetchDocumentById($id);
                        if ($document !== null) {
                            echo '
                            <div class="card position-relative p-4 border rounded-3">
                                <img src="' . $document['hinhAnhDaiDien'] . '" class="img-fluid shadow-sm" alt="' . $document['tenTaiLieu'] . '">
                                <h6 class="mt-4 mb-0 fw-bold">' . $document['tenTaiLieu'] . '</h6>
                                <p>Tác giả: ' . $document['tenTacGia'] . '</p>
                                <p>Ngôn ngữ: ' . $document['ngonNgu'] . '</p>
                                <p>Thể loại: ' . $document['theLoai'] . '</p>
                                <p>Nhà xuất bản: ' . $document['nhaXuatBan'] . '</p>
                                <p>Nội dung: ' . $document['noiDung'] . '</p>
                                <p>Số lượng còn lại: ' . $document['soLuongTon'] . '</p>
                                <div class="d-flex justify-content-between">
                                    <a href="#" class="btn btn-success add-to-cart" data-id="' . $document['id'] . '">Thêm vào danh sách</a>
                                </div>
                            </div>';

                        } else {
                            echo '<p>Không tìm thấy tài liệu với ID: ' . $id . '</p>';
                        }
                    } else {
                        echo '<p>Missing document ID.</p>';
                    }
                } catch (PDOException $err) {
                    echo "<script>console.log('FAILED. Error: $err' );</script><br><br>";
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>