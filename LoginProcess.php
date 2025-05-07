<?php
session_start();
include('db.php');

// Nhận dữ liệu từ form
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Kết nối đến database chứa thông tin đăng nhập (anixa_authdb)
$conn = getAuthDBConnection(); // Hàm kết nối đúng DB auth

// Chuẩn bị và thực thi truy vấn
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // So sánh mật khẩu trực tiếp (không mã hóa)
    if ($password === $user['password']) {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $user['username'];
        $_SESSION['role_id'] = $user['role_id'];
        $_SESSION['user_id'] = $user['id']; // <== Cần đảm bảo dòng này có mặt
    
        header("Location: index.php");
        exit;
    } else {
        echo "Sai mật khẩu!";
    }
} else {
    echo "Không tìm thấy tài khoản!";
}

$stmt->close();
$conn->close();
