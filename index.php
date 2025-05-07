<?php
session_start();
include('config.php');
include('db.php');

// Kiểm tra đăng nhập
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    include 'Login.php';
    exit;
}

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
    <!-- <link rel="stylesheet" href="/anixa/css/Product.css"> -->
    <link rel="stylesheet" href="/anixa/css/HomePage.css">
    <link rel="stylesheet" href="/anixa/css/ProductDetail.css">
    <link rel="stylesheet" href="/anixa/css/CreateUpdateProduct.css">
</head>

<body>
    <?php include 'components/Header.php'; ?>
    <?php include 'components/Navbar.php'; ?>

    <div id="main-content">
        <?php
        // if ($page === 'product') {
        //     include 'pages/Product.php';
        // } else
        if ($page === 'productDetail') {
            include 'pages/productDetail.php';
        } else if ($page === 'create') {
            include 'pages/CreateUpdateProduct.php';
        } else if ($page === 'duck') {
            include 'pages/Duck.php';
        } else if ($page === 'engine') {
            include 'pages/EngineBLDC.php';
        } else {
            include 'pages/Homepage.php';
        }
        ?>
    </div>

    <?php include 'components/Footer.php'; ?>
</body>

</html>