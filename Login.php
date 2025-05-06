<?php
// Ngôn ngữ mặc định là tiếng Việt
$lang = $_GET['lang'] ?? 'vi';

// Dữ liệu ngôn ngữ
$text = [
  'vi' => [
    'title' => 'Đăng nhập',
    'username' => 'Tên đăng nhập / ID',
    'password' => 'Mật khẩu / PASSWORD',
    'remember' => 'Ghi nhớ đăng nhập',
    'forgot' => 'Quên mật khẩu?',
    'login' => 'Đăng nhập'
  ],
  'en' => [
    'title' => 'Login',
    'username' => 'User Name / ID',
    'password' => 'Password',
    'remember' => 'Remember Me',
    'forgot' => 'Forget the password?',
    'login' => 'LOGIN'
  ]
];
$t = $text[$lang];
?>

<?php if (!empty($_SESSION['login_error'])): ?>
  <p style="color: red; text-align: center;"><?= $_SESSION['login_error'] ?></p>
  <?php unset($_SESSION['login_error']); ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
  <meta charset="UTF-8">
  <title><?= $t['title'] ?></title>
  <link rel="stylesheet" href="/anixa/css/Login.css">
</head>
<body>

  <!-- Chuyển đổi ngôn ngữ -->
  <div class="language-switcher" style="position: absolute; top: 15px; right: 20px;">
  <a href="?lang=vi"><img src="/anixa/img/vn-flag.svg" alt="Tiếng Việt" style="width: 30px; margin-right: 5px;"></a>
  <a href="?lang=en"><img src="/anixa/img/en-flag.svg" alt="English" style="width: 30px;"></a>
</div>



  <div class="login-container">
    <div class="login-box">
      <div class="login-avatar">
        <img src="/anixa/img/Sample_User_Icon.png" alt="User Icon">
      </div>
      <form action="LoginProcess.php" method="post">
        <input type="text" name="username" placeholder="<?= $t['username'] ?>" required>
        <input type="password" name="password" placeholder="<?= $t['password'] ?>" required>
        
        <div class="login-options">
          <label><input type="checkbox" name="remember"> <?= $t['remember'] ?></label>
          <a href="#"><?= $t['forgot'] ?></a>
        </div>
        
        <button type="submit"><?= $t['login'] ?></button>
      </form>
    </div>
  </div>

</body>
</html>
