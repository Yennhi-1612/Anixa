<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once(__DIR__ . '/../db.php');

$product_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($product_id <= 0) {
    // Không có ID hợp lệ, chuyển hướng về trang sản phẩm
    header('Location: index.php?page=product');
    exit;
}

$conn = getDBConnection();

// Truy vấn chi tiết sản phẩm
$sql = "SELECT id, product_name_vn, product_name_en, image_url, product_detail, product_applications, docs_url 
        FROM products 
        WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<p style='text-align:center; margin-top:50px;'>Sản phẩm không tồn tại.</p>";
    closeDBConnection($conn);
    exit;
}

$product = $result->fetch_assoc();
?>

<div class="product-detail">
    <div class="product-detail-left">
        <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="Ảnh sản phẩm">
    </div>
    <div class="product-detail-right">
        <p class="product-detail-name-vn"><?= htmlspecialchars($product['product_name_vn']) ?></p>
        <p class="product-detail-name-en"><?= htmlspecialchars($product['product_name_en']) ?></p>
        <p class="product-detail-parameter">Thông số</p>
        <p class="product-detail-detail"><?= nl2br(htmlspecialchars($product['product_detail'])) ?></p>
        <p class="product-">ỨNG DỤNG: <?= nl2br(htmlspecialchars($product['product_applications'])) ?></p>
        <?php if (!empty($product['docs_url']) && isset($_SESSION['role_id']) && $_SESSION['role_id'] === 1): ?>
            <a href="<?= htmlspecialchars($product['docs_url']) ?>" download class="download-btn">Tải tài liệu</a>
        <?php else: ?>
            <p style="color: gray;">Không có tài liệu đính kèm hoặc bạn không có quyền tải.</p>
        <?php endif; ?>
    </div>
</div>

<?php closeDBConnection($conn); ?>