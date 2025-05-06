<div class="header">
    <img src="/anixa/img/logo.png" alt="" class="logo">
    <h3>CHÀO MỪNG BẠN ĐẾN VỚI ANIXA</h3>
    <div class="user">
        <?php if (isset($_SESSION['username'])): ?>
            <img src="/anixa/img/User_icon_2.svg.png" alt="" class="avatar" onclick="toggleDropdown()">
            <div class="user-dropdown" id="userDropdown">
                <a href="logout.php">Đăng xuất</a>
            </div>
        <?php else: ?>
            <a href="Login.php">Đăng nhập</a>
        <?php endif; ?>
    </div>
</div>
<script>
    // Lắng nghe sự kiện click trên toàn bộ trang
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('userDropdown');
        const userIcon = document.querySelector('.user img'); // Lấy avatar (người dùng click vào để mở dropdown)

        // Kiểm tra nếu click ngoài dropdown và ngoài avatar
        if (!dropdown.contains(event.target) && !userIcon.contains(event.target)) {
            dropdown.style.display = "none"; // Ẩn dropdown
        }
    });

    // Hàm toggle để hiển thị/ẩn dropdown khi click vào avatar
    function toggleDropdown() {
        const dropdown = document.getElementById('userDropdown');
        if (dropdown.style.display === "none" || dropdown.style.display === "") {
            dropdown.style.display = "block"; // Hiện dropdown
        } else {
            dropdown.style.display = "none"; // Ẩn dropdown
        }
    }
</script>