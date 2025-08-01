<?php
session_start();
$page_title = '購入完了';
require 'header.php';

$pdo = new PDO(
    'mysql:---------------',
        '-------------',
        '-------------'     
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// セッションのカート情報を取得
$cart_key = isset($_SESSION['customer']) ? 'product_' . $_SESSION['customer']['id'] : 'product';
$cart = $_SESSION[$cart_key] ?? [];

if (!empty($_SESSION['customer']) && !empty($cart)) {
    $customer_id = $_SESSION['customer']['id'];

    // 注文日時
    $order_date = date('Y-m-d H:i:s');

    // トランザクション開始
    $pdo->beginTransaction();

    try {
        // ordersテーブルに追加
        $stmt = $pdo->prepare('INSERT INTO orders (customer_id, order_date) VALUES (?, ?)');
        $stmt->execute([$customer_id, $order_date]);
        $order_id = $pdo->lastInsertId();

        // order_itemsテーブルに商品ごとの情報を追加
        $stmt = $pdo->prepare('INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)');
        foreach ($cart as $item) {
            $stmt->execute([
                $order_id,
                $item['id'],         
                $item['count'],      
                $item['price']       
            ]);
        }

        // コミット
        $pdo->commit();

        // カート削除
        unset($_SESSION[$cart_key]);

    } catch (Exception $e) {
        $pdo->rollBack();
        echo '<p class="error">購入処理中にエラーが発生しました: ' . htmlspecialchars($e->getMessage()) . '</p>';
    }

}
?>

<nav class="pan">
  <ol>
    <li><a href="index.php">TOP</a> ＞</li>
    <li><a href="/ccdonuts/includes/cart.php">カート</a> ＞</li>
    <li><a href="/ccdonuts/includes/cart-confirm.php">購入確認</a> ＞</li>
    <li>購入完了</li>
  </ol>
</nav>

<?php
if (isset($_SESSION['customer'])) {
    echo '<p class="guest">ようこそ、', htmlspecialchars($_SESSION['customer']['name'], ENT_QUOTES, 'UTF-8'), '様</p>';
} else {
    echo '<p class="guest">ようこそ、ゲスト様</p>';
}
?>

<div class="h2"><h2>ご購入完了</h2></div>

<div class="logform in">
    <p>ご購入いただきありがとうございます。</p>
    <p>今後ともご愛顧のほど、よろしくお願いいたします。</p>
</div>

<p class="toCus togo"><a href="index.php">TOPページへすすむ</a></p>



<?php require 'footer.php'; ?>
