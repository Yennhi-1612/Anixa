<?php
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