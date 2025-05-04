<?php
include('config.php');
include('db.php');

// Khai báo biến page sớm trước khi dùng
$page = $_GET['page'] ?? 'home';
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
    <link rel="stylesheet" href="/anixa/css/Product.css">
    <link rel="stylesheet" href="/anixa/css/HomePage.css">
</head>

<body>
    <?php include 'components/Header.php'; ?>
    <?php include 'components/Navbar.php'; ?>

    <div id="main-content">
        <?php
        if ($page === 'product') {
            include 'pages/Product.php';
        } elseif ($page === 'productDetail') {
            include 'pages/productDetail.php';
        } else {
            include 'pages/Homepage.php';
        }
        ?>
    </div>

    <?php include 'components/Footer.php'; ?>
</body>

</html>