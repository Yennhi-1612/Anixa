<?php
// Bao gồm file cấu hình
include('config.php');

// Kết nối với SQL Server
function getDBConnection() {
    // Thiết lập kết nối
    $connectionOptions = array(
        "Database" => DB_DATABASE,
        "Uid" => DB_USERNAME,
        "PWD" => DB_PASSWORD
    );
    
    // Kết nối với cơ sở dữ liệu
    $conn = sqlsrv_connect(DB_SERVER, $connectionOptions);
    
    // Kiểm tra kết nối
    if( !$conn ) {
        die( print_r(sqlsrv_errors(), true));
    }
    
    return $conn;
}

// Hàm đóng kết nối
function closeDBConnection($conn) {
    sqlsrv_close($conn);
}
?>
