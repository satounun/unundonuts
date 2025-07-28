<?php session_start(); ?>
<?php
$page_title = '入力確認';
require 'header.php';
?>

<nav class="pan">
  <ol>
    <li><a href="index.php">TOP</a> ＞</li>
    <li><a href="/ccdonuts/includes/login-input.php">ログイン</a> ＞</li>
    <li><a href="/ccdonuts/includes/customer-input.php">会員登録</a> ＞</li>
    <li>入力確認</li>
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
$furigana = htmlspecialchars($_POST['furigana'] ?? '', ENT_QUOTES, 'UTF-8');
$postcode_a = htmlspecialchars($_POST['postcode_a'] ?? '', ENT_QUOTES, 'UTF-8');
$postcode_b = htmlspecialchars($_POST['postcode_b'] ?? '', ENT_QUOTES, 'UTF-8');
$postcode = $postcode_a . '-' . $postcode_b;
$address = htmlspecialchars($_POST['address'] ?? '', ENT_QUOTES, 'UTF-8');
$mail = htmlspecialchars($_POST['mail'] ?? '', ENT_QUOTES, 'UTF-8');
$mail2 = htmlspecialchars($_POST['mail2'] ?? '', ENT_QUOTES, 'UTF-8');
$password = htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES, 'UTF-8');
$password2 = htmlspecialchars($_POST['password2'] ?? '', ENT_QUOTES, 'UTF-8');

$errors = [];
if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    $errors[] = '正しいメールアドレスの形式で入力してください。';
}
if ($mail !== $mail2) {
    $errors[] = 'メールアドレスが一致しません。';
}
if ($password !== $password2) {
    $errors[] = 'パスワードが一致しません。';
}

if (count($errors) > 0) {
    echo '<ul class="error">';
    foreach ($errors as $error) {
        echo '<li>', $error, '</li>';
    }
    echo '</ul>';
    echo '<p><a href="javascript:history.back()">入力画面に戻る</a></p>';
} else {
    echo '<div class="h2"><h2 class="h2">入力確認</h2></div>';
    echo '<form action="includes/customer-output.php" method="post" class="logform cinfo ccon">';
    echo '<p>お名前</p>'; 
    echo '<p class="answer">' . $name . '</p>';
    echo '<p>お名前（フリガナ）</p>';
    echo '<p class="answer">' . $furigana . '</p>';
    echo '<p>郵便番号</p>';
    echo '<p class="answer">' . $postcode . '</p>';
    echo '<p>住所</p>';
    echo '<p class="answer">' . $address . '</p>';
    echo '<p>メールアドレス</p>';
    echo '<p class="answer">' . $mail . '</p>';
    echo '<p>メールアドレス確認用</p>';
    echo '<p class="answer">' . $mail2 . '</p>';
    echo '<p>パスワード</p>';
    echo '<p class="answer">' . $password . '</p>';
    echo '<p>パスワード確認用</p>';
    echo '<p class="answer">' . $password2 . '</p>';

    echo '<input type="hidden" name="name" value="', $name, '">';
    echo '<input type="hidden" name="furigana" value="', $furigana, '">';
    echo '<input type="hidden" name="postcode_a" value="', $postcode_a, '">';
    echo '<input type="hidden" name="postcode_b" value="', $postcode_b, '">';
    echo '<input type="hidden" name="address" value="', $address, '">';
    echo '<input type="hidden" name="mail" value="', $mail, '">';
    echo '<input type="hidden" name="password" value="', $password, '">';
    echo '<p class="tolog"><input type="submit" value="登録する"></p>';
    echo '</form>';
}
?>

<?php require 'footer.php'; ?>
