<?php session_start(); ?>
<?php
$page_title = 'ログアウト';
require 'header.php';
?>

<nav class="pan">
  <ol>
    <li><a href="index.php">TOP</a>＞ </li>
    <li><a href="includes/login-input.php">ログイン</a>＞ </li>
    <li>ログアウト</li>
  </ol>
</nav>

<?php
if (isset($_SESSION['customer'])) {
    echo '<p class="guest">ようこそ、', htmlspecialchars($_SESSION['customer']['name'], ENT_QUOTES, 'UTF-8'), '様</p>';
} else {
    echo '<p class="guest">ようこそ、ゲスト様</p>';
}
?>

<div class="h2"><h2>ログアウト</h2></div>
<div class="logform in out">
    <p>ログアウトしますか？</p>
    <p class="tolog logout"><a href="includes/logout-output.php">ログアウト</a></p>
</div>


<?php require 'footer.php'; ?>