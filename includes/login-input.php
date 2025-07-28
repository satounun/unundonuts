<?php session_start(); ?>
<?php
$page_title = 'ログイン';
require 'header.php';
?>

<nav class="pan">
  <ol>
    <li>
      <a href="index.php">TOP</a>＞</li>
    <li>ログイン</li>
  </ol>
</nav>

<?php
if (isset($_SESSION['customer'])) {
    echo '<p class="guest">ようこそ、', htmlspecialchars($_SESSION['customer']['name'], ENT_QUOTES, 'UTF-8'), '様</p>';
} else {
    echo '<p class="guest">ようこそ、ゲスト様</p>';
}
?>

<div class="h2"><h2>ログイン</h2></div>
<form action="/ccdonuts/includes/login-output.php" method="post" class="logform">
    <p>メールアドレス</p>
    <p><input type="text" name="mail"></p>
    <p>パスワード</p>
    <p><input type="text" name="password"></p>
    <p class="tolog"><input type="submit" value="ログインする"></p>
</form>
<p class="toCus toCus1"><a href="/ccdonuts/includes/customer-input.php">会員登録はこちら</a></p>
<p class="toCus"><a href="/ccdonuts/includes/logout-input.php">ログアウトはこちら</a></p>


<?php require 'footer.php'; ?>