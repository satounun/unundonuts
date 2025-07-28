<?php session_start(); ?>
<?php
$page_title = '情報確認';
require 'header.php';
?>

<nav class="pan">
  <ol>
    <li><a href="index.php">TOP</a> ＞</li>
    <li><a href="./ccdonuts/includes/.php">カート</a> ＞</li>
    <li><a href="/ccdonuts/includes/.php">購入確認</a> ＞</li>
    <li><a href="/ccdonuts/includes/card-input">カード情報</a></li>
    <li>情報確認</li>
  </ol>
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
$name = htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES, 'UTF-8');
$card_number = htmlspecialchars($_POST['card_number'] ?? '', ENT_QUOTES, 'UTF-8');
$card_company = htmlspecialchars($_POST['card_company'] ?? '', ENT_QUOTES, 'UTF-8');
$card_m = htmlspecialchars($_POST['card_m'] ?? '', ENT_QUOTES, 'UTF-8');
$card_y = htmlspecialchars($_POST['card_y'] ?? '', ENT_QUOTES, 'UTF-8');
$card_cvv = htmlspecialchars($_POST['card_cvv'] ?? '', ENT_QUOTES, 'UTF-8');

echo '<div class="h2"><h2 class="h2">入力情報確認</h2></div>';
echo '<form action="includes/card-output.php" method="post" class="logform cinfo ccon">';
echo '<p>お名前</p>'; 
echo '<p class="answer">' . $name . '</p>';
echo '<p>カード番号</p>';
echo '<p class="answer">' . $card_number . '</p>';
echo '<p>カード会社</p>';
echo '<p class="answer">' . $card_company . '</p>';
echo '<p>有効期限</p>';
echo '<p class="answer cmy">' . $card_m . '<span>月</span></p>';
echo '<p class="answer cmy">' . $card_y . '<span>年</span></p>';
echo '<p>セキュリティコード</p>';
echo '<p class="answer">' . $card_cvv . '</p>';

echo '<input type="hidden" name="name" value="', $name, '">';
echo '<input type="hidden" name="card_number" value="', $card_number, '">';
echo '<input type="hidden" name="card_company" value="', $card_company, '">';
echo '<input type="hidden" name="card_m" value="', $card_m, '">';
echo '<input type="hidden" name="card_y" value="', $card_y, '">';
echo '<input type="hidden" name="card_cvv" value="', $card_cvv, '">';

echo '<p class="tolog"><input type="submit" value="登録する"></p>';
echo '</form>';

?>


<?php require 'footer.php'; ?>