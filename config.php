<?php
// Cấu hình kết nối MySQL dùng cho sản phẩm
if (!defined('DB_SERVER')) define('DB_SERVER', 'localhost');
if (!defined('DB_USERNAME')) define('DB_USERNAME', 'root');
if (!defined('DB_PASSWORD')) define('DB_PASSWORD', '');
if (!defined('DB_PRODUCT_DB')) define('DB_PRODUCT_DB', 'Anixa_ProductDB');

// Cấu hình kết nối MySQL dùng cho xác thực người dùng
if (!defined('DB_AUTH_DB')) define('DB_AUTH_DB', 'Anixa_AuthDB');
?>
