<div id="navbar">
    <div class="navbar-item-container">
        <button onclick="goToPage('home')" class="navbar-btn">Trang chủ</button>
        <button onclick="goToPage('product')" class="navbar-btn">Sản phẩm</button>
        <button onclick="goToPage('contact')" class="navbar-btn">Liên hệ</button>
    </div>
</div>

<script>
    function goToPage(page) {
        window.location.href = 'index.php?page=' + page;
    }
</script>