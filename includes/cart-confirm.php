<?php session_start(); ?>
<?php
$page_title = '購入確認';
require 'header.php';
?>

<?php
$cart_key = isset($_SESSION['customer']) ? 'product_' . $_SESSION['customer']['id'] : 'product';
$cart = $_SESSION[$cart_key] ?? [];
$total = 0;
$total_items = 0;

$customer_id = $_SESSION['customer']['id'] ?? null;
$customer = null;

if ($customer_id !== null) {
    try {
        $pdo = new PDO(
            'mysql:host=localhost;dbname=ss566997_ccdonuts;charset=utf8',
            'ss566997_user',
            '4290abcd'    
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare('SELECT * FROM customers WHERE id = ?');
        $stmt->execute([$customer_id]);
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        exit('DB接続失敗: ' . $e->getMessage());
    }
}
?>

<nav class="pan">
  <ol>
    <li><a href="index.php">TOP</a> ＞</li>
    <li><a href="includes/cart.php">カート</a> ＞</li>
    <li>購入確認</li>
  </ol>
</nav>

<?php
if (isset($_SESSION['customer'])) {
    echo '<p class="guest">ようこそ、', htmlspecialchars($_SESSION['customer']['name'], ENT_QUOTES, 'UTF-8'), '様</p>';
} else {
    echo '<p class="guest">ようこそ、ゲスト様</p>';
}
?>

<div class="h2"><h2>ご購入確認</h2></div>

<form action="includes/cart-output.php" method="post" class="finally">
    <h4>ご購入商品</h4>
    <?php 
    foreach ($cart as $item): 
        $subtotal = $item['price'] * $item['count'];
        $total += $subtotal;
        $total_items += $item['count'];
    ?>
    <div class="product_confirm">
        <div class="productP">
            <div class="productL">商品名</div><div class="productR"><?= htmlspecialchars($item['name']) ?></div>
        </div>
        <div class="productP">
            <div class="productL">数量</div><div class="productR"><?= $item['count'] ?> 個</div>
        </div>
        <div class="productP">
            <div class="productL">金額</div><div class="productR">税込　¥<?= number_format($subtotal) ?></div>
        </div>
    </div>
    <?php endforeach; ?>
    <div class="product_confirm product_bold">
        <div class="productP">
            <div class="productL">合計数量</div><div class="productR"><?= $total_items ?> 個</div>
        </div>
        <div class="productP">
            <div class="productL">合計金額</div><div class="productR">税込　¥<?= number_format($total) ?></div>
        </div>
    </div>
    <h4>お届け先</h4>
    <?php if ($customer): ?>
    <div class="product_confirm">
        <div class="productP">
            <div class="productL">お名前</div><div class="productR"><?= htmlspecialchars($customer['name']) ?></div>
        </div>
        <div class="productP">
            <div class="productL">郵便番号
                </div><div class="productR"><?= htmlspecialchars($customer['postcode_a'] ?? '') ?>-<?= htmlspecialchars($customer['postcode_b'] ?? '') ?>
            </div>
        </div>
        <div class="productP">
            <div class="productL">住所</div><div class="productR"><?= htmlspecialchars($customer['address'] ?? '') ?></div>
        </div>
    </div>
    <h4>お支払い先</h4>
    <div class="product_confirm">
        <div class="productP">
            <div class="productL">お支払い</div><div class="productR">クレジットカード</div>
        </div>
        <div class="productP">
            <div class="productL">ブランド</div><div class="productR"><?= htmlspecialchars($customer['card_company'] ?? '') ?></div>
        </div>
    </div>
    <p class="tolog"><input type="submit" value="購入を確定する"></p>
</form>
<?php else: ?>
    <p>顧客情報が見つかりません。ログインしてください。</p>
<?php endif; ?>

<?php require 'footer.php'; ?>

