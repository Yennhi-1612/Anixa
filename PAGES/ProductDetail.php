<?php
// Lấy ID từ URL
$product_id = $_GET['id'] ?? null;

if (!$product_id) {
    die("Không có sản phẩm để hiển thị.");
}

$conn = getDBConnection();

// Truy vấn chi tiết sản phẩm
$sql = "SELECT id, product_name_vn, product_name_en, image_url, product_detail, product_applications FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Sản phẩm không tồn tại.");
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
        <p class="product-detail-detail"><?= htmlspecialchars($product['product_detail']) ?></p>
        <p class="product-">ỨNG DỤNG: <?= htmlspecialchars($product['product_applications']) ?></p>
    </div>
</div>

<?php
closeDBConnection($conn);
?>
