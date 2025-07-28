<?php session_start(); ?>
<?php
$page_title = 'ログアウト完了';
require 'header.php';
?>

<nav class="pan">
  <ol>
    <li><a href="index.php">TOP</a>＞ </li>
    <li><a href="includes/login-input.php">ログイン</a>＞ </li>
    <li><a href="includes/logout-input.php">ログアウト</a>＞ </li>
    <li>ログアウト完了</li>
  </ol>
</nav>

<p class="guest">ようこそ、ゲスト様</p>
<div class="h2"><h2>ログアウト</h2></div>

<?php
if (isset($_SESSION['customer'])) {
    unset($_SESSION['customer']);
    echo '<div class="logform in out">';
    echo '<p>ログアウトしました。</p>';
    echo '</div>';
} else {
    echo '<div class="logform in out">';
    echo '<p>すでにログアウトしています。</p>';
    echo '</div>';
}
?>

<?php require 'footer.php'; ?>