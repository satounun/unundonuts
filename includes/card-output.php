<?php session_start(); ?>
<?php
$page_title = '登録完了';
require 'header.php';
?>

<?php
$name = htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES, 'UTF-8');
$card_number = htmlspecialchars($_POST['card_number'] ?? '', ENT_QUOTES, 'UTF-8');
$card_company = htmlspecialchars($_POST['card_company'] ?? '', ENT_QUOTES, 'UTF-8');
$card_m = htmlspecialchars($_POST['card_m'] ?? '', ENT_QUOTES, 'UTF-8');
$card_y = htmlspecialchars($_POST['card_y'] ?? '', ENT_QUOTES, 'UTF-8');
$card_cvv = htmlspecialchars($_POST['card_cvv'] ?? '', ENT_QUOTES, 'UTF-8');

$pdo = new PDO(
    'mysql:host=localhost;dbname=ss566997_ccdonuts;charset=utf8',
    'ss566997_user',
    '4290abcd'    
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

<nav class="pan">
  <ol>
    <li><a href="index.php">TOP</a> ＞</li>
    <li><a href="/ccdonuts/includes/.php">カート</a> ＞</li>
    <li><a href="/ccdonuts/includes/.php">購入確認</a> ＞</li>
    <li><a href="/ccdonuts/includes/card-input.php">カード情報</a> ＞</li>
    <li><a href="/ccdonuts/includes/card-confirm.php">情報確認</a> ＞</li>
    <li>登録完了</li>
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
if (isset($_SESSION['customer'])) {
    // ログイン済みなら「更新処理」
    $customer_id = $_SESSION['customer']['id'];

    $checkCard = $pdo->prepare('SELECT card_number FROM customers WHERE id = ?');
    $checkCard->execute([$customer_id]);
    $cardData = $checkCard->fetch();

    if (empty($cardData['card_number'])) {
        // カード未登録 → 登録（更新）
        $update = $pdo->prepare('UPDATE customers SET card_number=?, card_company=?, card_m=?, card_y=?, card_cvv=? WHERE id=?');
        $update->execute([$card_number, $card_company, $card_m, $card_y, $card_cvv, $customer_id]);

        echo '<div class="logform in">';
        echo '<p>支払い情報登録が完了いたしました。</p>';
        echo '<p>続けて購入確認ページへお進みください。</p>';
        echo '</div>';
    } else {
        echo '<div class="logform in">';
        echo '<p>カード情報はすでに登録されています。</p>';
        echo '</div>';
    }

} else {
    // 非ログイン → 新規登録処理
    $sql = $pdo->prepare('SELECT * FROM customers WHERE name = ?');
    $sql->execute([$name]);
    $existing = $sql->fetch();

    if ($existing === false) {
        try {
            $insert = $pdo->prepare('INSERT INTO customers (name, card_number, card_company, card_m, card_y, card_cvv) VALUES (?, ?, ?, ?, ?, ?)');
            $insert->execute([$name, $card_number, $card_company, $card_m, $card_y, $card_cvv]);

            // セッションにログイン情報登録（新規ユーザーとして）
            $_SESSION['customer'] = [
                'id' => $pdo->lastInsertId(),
                'name' => $name
            ];

            echo '<div class="logform in">';
            echo '<p>支払い情報登録が完了いたしました。</p>';
            echo '<p>続けて購入確認ページへお進みください。</p>';
            echo '</div>';
        } catch (PDOException $e) {
            echo '<p class="error">エラー: ' . $e->getMessage() . '</p>';
        }

    } elseif (is_null($existing['card_number']) || $existing['card_number'] === '') {
        // 名前あり・カード未登録
        $customer_id = $existing['id'];
        $update = $pdo->prepare('UPDATE customers SET card_number=?, card_company=?, card_m=?, card_y=?, card_cvv=? WHERE id=?');
        $update->execute([$card_number, $card_company, $card_m, $card_y, $card_cvv, $customer_id]);

        // セッションにログイン情報登録（既存ユーザーとして）
        $_SESSION['customer'] = [
            'id' => $customer_id,
            'name' => $existing['name']
        ];

        echo '<div class="logform in">';
        echo '<p>支払い情報登録が完了いたしました。</p>';
        echo '<p>続けて購入確認ページへお進みください。</p>';
        echo '</div>';

    } else {
        // 名前もカードも登録済み
        echo '<div class="logform in">';
        echo '<p>既に存在するアカウントです。</p>';
        echo '</div>';
    }
}
?>

<p class="toCus togo"><a href="includes/cart-confirm.php">購入確認ページへすすむ</a></p>

<?php require 'footer.php'; ?>
