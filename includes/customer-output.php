<?php session_start(); ?>
<?php
$page_title = '会員登録完了';
require 'header.php';
?>

<?php
$name = htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES, 'UTF-8');
$furigana = htmlspecialchars($_POST['furigana'] ?? '', ENT_QUOTES, 'UTF-8');
$postcode_a = htmlspecialchars($_POST['postcode_a'] ?? '', ENT_QUOTES, 'UTF-8');
$postcode_b = htmlspecialchars($_POST['postcode_b'] ?? '', ENT_QUOTES, 'UTF-8');
$address = htmlspecialchars($_POST['address'] ?? '', ENT_QUOTES, 'UTF-8');
$mail = htmlspecialchars($_POST['mail'] ?? '', ENT_QUOTES, 'UTF-8');
$password = htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES, 'UTF-8');

$pdo = new PDO(
    'mysql:host=localhost;dbname=ss566997_ccdonuts;charset=utf8',
    'ss566997_user',
    '4290abcd'    
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// 名前が既に登録されているか確認   
$sql = $pdo->prepare('SELECT * FROM customers WHERE name = ?');
$sql->execute([$name]);

?>

<nav class="pan">
  <ol>
    <li><a href="index.php">TOP</a> ＞</li>
    <li><a href="/ccdonuts/includes/login-input.php">ログイン</a> ＞</li>
    <li><a href="/ccdonuts/includes/customer-input.php">会員登録</a> ＞</li>
    <li><a href="/ccdonuts/includes/customer-confirm.php">入力確認</a> ＞</li>
    <li>会員登録完了</li>
  </ol>
</nav>

<?php
if (empty($sql->fetchAll())) {
    try {
        $insert = $pdo->prepare('INSERT INTO customers (name, furigana, postcode_a, postcode_b, address, mail, password) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $insert->execute([$name, $furigana, $postcode_a, $postcode_b, $address, $mail, $password]);

        $_SESSION['customer'] = [
            'id' => $pdo->lastInsertId(),
            'name' => $name
        ];

        echo '<p class="guest">ようこそ、', htmlspecialchars($_SESSION['customer']['name'], ENT_QUOTES, 'UTF-8'), '様</p>';
        echo '<div class="h2"><h2 class="h2">会員登録完了</h2></div>';
        echo '<div class="logform in">';
        echo '<p>会員登録が完了いたしました。</p>';
        echo '<p>ログインページへお進みください。</p>';
        echo '</div>';
    } catch (PDOException $e) {
        echo '<p class="error">エラー: ' . $e->getMessage() . '</p>';
    }
} else {
    echo '<p class="guest">ようこそ、', htmlspecialchars($_SESSION['customer']['name'], ENT_QUOTES, 'UTF-8'), '様</p>';
    echo '<div class="logform in">';
    echo '<p>既に存在するアカウントです。</p>';
    echo '</div>';
}
?>

<p class="toCus togo"><a href="/ccdonuts/includes/card-input.php">クレジットカード登録へすすむ</a></p>
<p class="toCus togo"><a href="">購入確認ページへすすむ</a></p>

<?php require 'footer.php'; ?>
