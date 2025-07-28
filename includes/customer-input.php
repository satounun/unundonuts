<?php session_start(); ?>
<?php
$page_title = '会員登録';
require 'header.php';
?>

<nav class="pan">
  <ol>
    <li><a href="index.php">TOP</a> ＞</li>
    <li><a href="/ccdonuts/includes/login-input.php">ログイン</a> ＞</li>
    <li>会員登録</li>
  </ol>
</nav>
<p class="guest">ようこそ　ゲスト様</p>

<?php
$name = $furigana = $postcode_a = $postcode_b = $address = $mail = $password = '';

if (isset($_SESSION['customer'])) {
  $name = $_SESSION['customer']['name'] ?? '';
  $furigana = $_SESSION['customer']['furigana'] ?? '';
  $postcode_a = $_SESSION['customer']['postcode_a'] ?? '';
  $postcode_b = $_SESSION['customer']['postcode_b'] ?? '';
  $address = $_SESSION['customer']['address'] ?? '';
  $mail = $_SESSION['customer']['mail'] ?? '';
  $password = $_SESSION['customer']['password'] ?? '';
}
?>

<div class="h2"><h2>会員登録</h2></div>
<form action="includes/customer-confirm.php" method="post" class="logform cinfo">
    <p>お名前<span class="require">（必須）</span></p>
    <p><input type="text" name="name" placeholder="山田花子" required></p>
    <p>お名前（フリガナ）<span class="require">（必須）</span></p>
    <p><input type="text" name="furigana" placeholder="ヤマダハナコ" required></p>
    <p>郵便番号<span class="require">（必須）</span></p>
    <p><input type="text" name="postcode_a" pattern="\d{3}" class="post1" placeholder="123" required>
      <input type="text" name="postcode_b" pattern="\d{4}" class="post2" placeholder="4567" required></p>
    <p>住所<span class="require">（必須）</span></p>
    <p><input type="text" name="address" placeholder="東京都○○区○○1-1-1" required></p>
    <p>メールアドレス<span class="require">（必須）</span></p>
    <p><input type="email" name="mail" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" placeholder="yamadahanako@gmail.com" required></p>
    <p>メールアドレス確認用<span class="require">（必須）</span></p>
    <p><input type="email" name="mail2" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" placeholder="yamadahanako@gmail.com" required></p>
    <p>パスワード<span class="require">（必須）</span></p>
    <p class="reqred">半角英数字8文字以上20文字以内で入力してください。※記号の使用はできません</p>
    <p><input type="text" name="password" pattern="[a-zA-Z0-9]{8,20}" title="半角英数字8〜20文字、記号は使えません" placeholder="1234abcd" required></p>
    <p>パスワード確認用<span class="require">（必須）</span></p>
    <p><input type="text" name="password2" pattern="[a-zA-Z0-9]{8,20}" title="半角英数字8〜20文字、記号は使えません" placeholder="1234abcd" required></p>
    <p class="tolog"><input type="submit" value="入力確認する"></p>
</form>

<?php require 'footer.php'; ?>