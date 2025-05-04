<?php
$conn = getDBConnection();

$sql = "SELECT id, product_name_vn, product_name_en, image_url FROM products";
$query = $conn->query($sql);

if (!$query) {
    die("Lỗi truy vấn: " . $conn->error);
}
?>

<div id="product">
    <div class="title">
        <p>SẢN PHẨM</p>
        <hr>
    </div>

    <div class="product">
        <?php while ($row = $query->fetch_assoc()): ?>
            <div onclick="location.href='index.php?page=productDetail&id=<?= $row['id'] ?>'" class="product-item">
                <img src="<?= htmlspecialchars($row['image_url']) ?>" class="product-img" alt="Ảnh sản phẩm">
                <p><?= htmlspecialchars($row['product_name_vn']) ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php
closeDBConnection($conn);
?>

<script>
function goToProductDetail(id) {
    window.location.href = "productDetail.php?id=" + id; // Điều hướng tới trang chi tiết sản phẩm
}
</script>
