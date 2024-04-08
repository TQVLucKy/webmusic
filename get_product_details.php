<?php

// Lấy ID sản phẩm từ yêu cầu
$productId = isset($_GET['id']) ? $_GET['id'] : null;

if ($productId) {
    // Chuẩn bị câu lệnh truy vấn
    $sql = "SELECT * FROM storemusic WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind tham số
    mysqli_stmt_bind_param($stmt, "i", $productId);

    // Thực hiện truy vấn
    mysqli_stmt_execute($stmt);

    // Lấy kết quả
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // Lấy dữ liệu sản phẩm từ kết quả
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    } else {
        echo json_encode(array("error" => "Không tìm thấy chi tiết sản phẩm."));
    }

    // Đóng câu lệnh truy vấn
    mysqli_stmt_close($stmt);
} else {
    echo json_encode(array("error" => "ID sản phẩm không hợp lệ."));
}

// Đóng kết nối
mysqli_close($conn);
?>
