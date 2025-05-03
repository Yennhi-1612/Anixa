<?php
// Bao gồm file cấu hình và kết nối DB
include('config.php');
include('db.php');

// Kết nối cơ sở dữ liệu
$conn = getDBConnection();

// Truy vấn dữ liệu từ bảng products
$sql = "SELECT id, product_name_vn, product_name_en FROM products";
$query = sqlsrv_query($conn, $sql);

// Kiểm tra truy vấn
if(!$query) {
    die( print_r(sqlsrv_errors(), true));
}

// Hiển thị dữ liệu
while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
    echo "ID: " . $row['id'] . "<br>";
    echo "Tên sản phẩm (VN): " . $row['product_name_vn'] . "<br>";
    echo "Tên sản phẩm (EN): " . $row['product_name_en'] . "<br><br>";
}

// Đóng kết nối
closeDBConnection($conn);
$page = $_GET['page'] ?? 'home'; // Nếu không có thì mặc định là trang home
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Anixa</title>
    <!-- CSS chung -->
    <link rel="stylesheet" href="/anixa/css/main.css">
    <link rel="stylesheet" href="/anixa/css/Header.css">
    <link rel="stylesheet" href="/anixa/css/Navbar.css">
    <link rel="stylesheet" href="/anixa/css/Footer.css">

    <?php if ($page === 'product'): ?>
        <link rel="stylesheet" href="/anixa/css/Product.css">
    <?php else: ?>
        <link rel="stylesheet" href="/anixa/css/HomePage.css">
    <?php endif; ?>
</head>

<body>
    <?php include 'components/Header.php'; ?>
    <?php include 'components/Navbar.php'; ?>

    <div id="main-content">
        <?php
        if ($page === 'product') {
            include 'pages/Product.php';
        } else {
            include 'pages/Homepage.php';
        }
        ?>
    </div>

    <?php include 'components/Footer.php'; ?>
</body>

</html>