<?php
include_once(__DIR__ . '/../db.php');

$conn = getDBConnection();

// Lấy danh sách categories và sản phẩm tương ứng
$sql = "SELECT c.category_name, p.id AS product_id, p.product_code 
        FROM categories c
        LEFT JOIN products p ON c.id = p.category_id
        ORDER BY c.category_name";

$result = $conn->query($sql);

$menu = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $category = $row['category_name'];
        $menu[$category][] = [
            'id' => $row['product_id'],
            'code' => $row['product_code']
        ];
    }
}
?>

<div id="navbar">
    <div class="navbar-item-container">
        <p class="navbar-item" onclick="goToHomePage()">Trang chủ</p>
        <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] === 1): ?>
            <p class="navbar-item" onclick="goToCreateProduct()">Quản lý</p>
        <?php endif; ?>
        <?php foreach ($menu as $category => $products): ?>
            <div class="navbar-item-wrapper">
                <p class="navbar-item">Seri <?= htmlspecialchars($category) ?></p>
                <div class="dropdown-menu">
                    <?php foreach ($products as $product): ?>
                        <?php if ($product['id']): ?>
                            <div class="dropdown-item" onclick="goToProductDetail(<?= $product['id'] ?>)">
                                <?= htmlspecialchars($product['code']) ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
        <!-- thêm tuỳ ý -->
        <div class="navbar-item-wrapper">
            <p class="navbar-item">Công nghệ</p>
            <div class="dropdown-menu">
                <div class="dropdown-item" onclick="goToDuck()">
                    Chân vịt Mango
                </div>
                <div class="dropdown-item" onclick="goToEngine()">
                    Động cơ BLDC
                </div>
            </div>
        </div>
        <div class="navbar-item-wrapper">
            <p class="navbar-item">Liên hệ</p>
            <div class="dropdown-menu">
                <div class="dropdown-item">
                    TP. Hồ Chí Minh
                </div>
                <div class="dropdown-item">
                    Hà Nội
                </div>
                <div class="dropdown-item">
                    Đà Nẵng
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function goToProductDetail(id) {
        window.location.href = 'index.php?page=productDetail&id=' + id;
    }

    function goToHomePage() {
        window.location.href = 'index.php?page=';
    }

    function goToCreateProduct() {
        window.location.href = 'index.php?page=create';
    }

    function goToDuck() {
        window.location.href = 'index.php?page=duck';
    }

    function goToEngine() {
        window.location.href = 'index.php?page=engine';
    }
</script>