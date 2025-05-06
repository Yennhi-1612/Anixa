<?php
require_once('db.php');

$conn = getDBConnection();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_code = $_POST['product_code'];
    $product_name_vn = $_POST['product_name_vn'];
    $product_name_en = $_POST['product_name_en'];
    $category_id = $_POST['category_id'];
    $product_detail = $_POST['product_detail'];
    $product_applications = $_POST['product_applications'];

    // Xác định thư mục ảnh theo loại
    $categoryMap = [
        '1' => 'img/seriX/',
        '2' => 'img/seriY/',
        '3' => 'img/seriZ/',
    ];
    $imageDir = $categoryMap[$category_id] ?? 'img/others/';
    $imageFullPath = __DIR__ . '/' . $imageDir;
    
    if (!is_dir($imageFullPath)) {
        mkdir($imageFullPath, 0777, true);
    }
    
    $image_url = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_name = time() . "_" . basename($_FILES['image']['name']);
        $image_path = $imageDir . $image_name; // Lưu vào DB
        $uploaded_image = $imageFullPath . $image_name; // Đường dẫn vật lý để upload
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaded_image)) {
            $image_url = $image_path;
        }
    }

    // Xử lý tài liệu
    $docs_url = '';
    if (isset($_FILES['doc_file']) && $_FILES['doc_file']['error'] === UPLOAD_ERR_OK) {
        $docDir = __DIR__ . '/doc/';
        if (!is_dir($docDir)) {
            mkdir($docDir, 0777, true);
        }
        $doc_name = time() . "_" . basename($_FILES['doc_file']['name']);
        $doc_path = 'doc/' . $doc_name;
        $uploaded_doc = $docDir . $doc_name;
        if (move_uploaded_file($_FILES['doc_file']['tmp_name'], $uploaded_doc)) {
            $docs_url = $doc_path;
        }
    }

    // Chèn vào DB
    $stmt = $conn->prepare("INSERT INTO products (product_code, product_name_vn, product_name_en, category_id, product_detail, product_applications, image_url, docs_url)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssissss", $product_code, $product_name_vn, $product_name_en, $category_id, $product_detail, $product_applications, $image_url, $docs_url);

    if ($stmt->execute()) {
        echo "<script>alert('Thêm sản phẩm thành công!'); window.location.href='index.php';</script>";
        exit;
    } else {
        $message = "Lỗi khi thêm sản phẩm: " . $stmt->error;
    }

    $stmt->close();
    closeDBConnection($conn);
}
?>
