<?php session_start(); ?>
<?php
$page_title = 'カード情報';
require 'header.php';
?>

<nav class="pan">
  <ol>
    <li><a href="index.php">TOP</a> ＞</li>
    <li><a href="/ccdonuts/includes/l.php">カート</a> ＞</li>
    <li><a href="/ccdonuts/includes/.php">購入確認</a> ＞</li>
    <li>カード情報</li>
  </ol>
</nav>
<?php
if (isset($_SESSION['customer'])) {
    echo '<p class="guest">ようこそ、', htmlspecialchars($_SESSION['customer']['name'], ENT_QUOTES, 'UTF-8'), '様</p>';
} else {
    echo '<p class="guest">ようこそ、ゲスト様</p>';
}
?>

<?php
$name = $card_number = $card_company = $card_m = $card_y = $card_cvv = '';

if (isset($_SESSION['customer'])) {
  $name = $_SESSION['customer']['name'] ?? '';
  $card_number = $_SESSION['customer']['card_number'] ?? '';
  $card_company = $_SESSION['customer']['card_company'] ?? '';
  $card_m = $_SESSION['customer']['card_m'] ?? '';
  $card_y = $_SESSION['customer']['card_y'] ?? '';
  $card_cvv = $_SESSION['customer']['card_cvv'] ?? '';
}
?>

<div class="h2"><h2>カード情報登録</h2></div>
<form action="includes/card-confirm.php" method="post" class="logform cinfo ccard">
    <p>お名前<span class="require">（必須）</span></p>
    <p><input type="text" name="name" placeholder="山田花子" required></p>
    <p>カード番号<span class="require">（必須）</span></p>
    <p class="reqred">任意の12桁の数字を入力してください。</p>
    <p><input type="text" name="card_number" pattern="\d{12}" placeholder="12456789123" required></p>
    <p>カード会社<span class="require">（必須）</span></p>
    <p class="radio"><input type="radio" name="card_company" value="ABC" checked><span>ABC</span>
      <input type="radio" name="card_company" value="PHP"><span>PHP</span>
      <input type="radio" name="card_company" value="XYZ"><span>XYZ</span></p>
    <p>有効期限<span class="require">（必須）</span></p>
    <p class="my"><input type="text" name="card_m" placeholder="1" required>月</p>
    <p class="my"><input type="text" name="card_y" placeholder="1" required>年</p>
    <p>セキュリティコード<span class="require">（必須）</span></p>
    <p class="reqred">任意の6桁の数字を入力してください。</p>
    <p><input type="text" name="card_cvv" pattern="\d{6}" placeholder="123456" required></p>
    <p class="tolog"><input type="submit" value="入力確認する"></p>
</form>


<?php require 'footer.php'; ?>