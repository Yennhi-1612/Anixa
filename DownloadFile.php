<?php
session_start();
include_once(__DIR__ . '/db.php');

// 1. Kiểm tra đăng nhập và quyền admin
if (!isset($_SESSION['logged_in'])) {
    http_response_code(403);
    echo "Bạn không có quyền tải tài liệu.";
    exit;
}

// 2. Lấy ID sản phẩm từ URL
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($product_id <= 0) {
    http_response_code(400);
    echo "Thiếu hoặc sai ID sản phẩm.";
    exit;
}

// 3. Kết nối DB sản phẩm để lấy URL tài liệu
$productConn = getDBConnection();
$stmt = $productConn->prepare("SELECT docs_url FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Không tìm thấy tài liệu.";
    exit;
}

$product = $result->fetch_assoc();
$docs_url = $product['docs_url'];
$stmt->close();
closeDBConnection($productConn);

// 4. Kiểm tra session user_id trước khi ghi log
if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo "Không xác định được người dùng. Vui lòng đăng nhập lại.";
    exit;
}
$user_id = $_SESSION['user_id'];

// 5. Ghi log download vào DB `anixa_authdb`
$authConn = getAuthDBConnection();
$logStmt = $authConn->prepare("INSERT INTO download_logs (user_id, product_id) VALUES (?, ?)");
$logStmt->bind_param("ii", $user_id, $product_id);
$logStmt->execute();
$logStmt->close();
$authConn->close();

// 6. Gửi file về trình duyệt
$filepath = __DIR__ . '/' . $docs_url;

if (file_exists($filepath)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
    header('Content-Length: ' . filesize($filepath));
    flush();
    readfile($filepath);
    exit;
} else {
    echo "Tài liệu không tồn tại trên máy chủ.";
}
?>
