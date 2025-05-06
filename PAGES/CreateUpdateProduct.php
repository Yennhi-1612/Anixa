<?php
// Sử dụng require_once với đường dẫn đúng
require_once(__DIR__ . '/../db.php');  // Đảm bảo đường dẫn đúng tới db.php

$conn = getDBConnection();

$message = $_GET['message'] ?? '';
$categories = [];
$result = $conn->query("SELECT id, category_name FROM categories");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}
?>

<div class="product-form-container">
    <h2>Thêm Sản Phẩm</h2>
    <?php if ($message): ?>
        <p style="color: green; font-weight: bold;"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
    <form method="post" enctype="multipart/form-data" action="HandleProductCreate.php">
        <div class="form-group">
            <label>Mã sản phẩm</label>
            <input type="text" name="product_code" required>
        </div>
        <div class="form-group">
            <label>Tên sản phẩm (VN)</label>
            <input type="text" name="product_name_vn" required>
        </div>
        <div class="form-group">
            <label>Tên sản phẩm (EN)</label>
            <input type="text" name="product_name_en">
        </div>
        <div class="form-group">
            <label>Danh mục</label>
            <select name="category_id" required>
                <option value="">-- Chọn danh mục --</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['category_name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Thông số kỹ thuật</label>
            <textarea name="product_detail" rows="5"></textarea>
        </div>
        <div class="form-group">
            <label>Ứng dụng</label>
            <textarea name="product_applications" rows="5"></textarea>
        </div>
        <div class="form-group">
            <label>Hình ảnh</label>
            <input type="file" name="image" accept="image/*" required>
        </div>
        <div class="form-group">
            <label>Tài liệu kỹ thuật (PDF, DOC, DOCX)</label>
            <input type="file" name="doc_file" accept=".doc,.docx,.pdf">
        </div>
        <div class="form-group">
            <button type="submit">Thêm sản phẩm</button>
        </div>
    </form>
</div>
