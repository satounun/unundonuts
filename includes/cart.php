<?php session_start(); ?>
<?php
$page_title = 'カート';
require 'header.php';
?>

<?php
$cart_key = isset($_SESSION['customer']) ? 'product_' . $_SESSION['customer']['id'] : 'product';
?>

<nav class="pan">
  <ol>
    <li><a href="index.php">TOP</a> ＞</li>
    <li>カート</li>
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
$imageMap = [
    'フルーツドーナツセット（12個入り）' => 'images/donuts/donuts_family1.png',
    'フルーツドーナツセット（14個入り）' => 'images/donuts/donuts_family2.png',
    'ベストセレクションボックス（4個入り）' => 'images/donuts/besties.png',
    'チョコクラッシュボックス（7個入り）' => 'images/donuts/crush.png',
    'クリームボックス（4個入り）' => 'images/donuts/cream4.png',
    'クリームボックス（9個入り）' => 'images/donuts/cream9.png',
    'CCドーナツ 当店オリジナル（5個入り）' => 'images/donuts/cc.png',
    'チョコレートデライト（5個入り）' => 'images/donuts/choco.png',
    'キャラメルクリーム（5個入り）' => 'images/donuts/caramel.png',
    'プレーンクラシック（5個入り）' => 'images/donuts/plene.png',
    'サマーシトラス（5個入り）' => 'images/donuts/summer.png',
    'ストロベリークラッシュ（5個入り）' => 'images/donuts/strawberry.png'
];
?>

<?php if (!empty($_SESSION[$cart_key])): ?>
    <?php
    $total = 0;
    foreach ($_SESSION[$cart_key] as $item) {
        $total += $item['price'] * $item['count'];
    }
    ?>

<!-- 購入用フォーム -->
<div class="cform">
<form action="includes/cart-confirm.php" method="post">
    <div class="total"> 
        <p>現在　商品 <?= count($_SESSION[$cart_key]) ?> 点</p>
        <p>ご注文小計：税込 <span class="totalred">￥<?= number_format($total) ?></span></p>
        <input type="submit" value="購入確認に進む">
    </div>
</form>

<hr>

<?php foreach ($_SESSION[$cart_key] as $id => $item):
    $name = $item['name'];
    $price = $item['price'];
    $count = $item['count'];
    $subtotal = $price * $count;
    $image_path = isset($imageMap[$name]) ? $imageMap[$name] : 'images/noimage.png';
?>
<div class="cart_product">
    <div class="product_img">
        <img src="<?= htmlspecialchars($image_path) ?>">
    </div>
    <div class="product_detail">
        <p class="name_product"><?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?></p>
        <div class="price">
            <div>
                <p class="totalred">税込　¥<?= number_format($price) ?></p>
            </div>

            <!-- 再計算・削除用フォーム（独立） -->
            <form action="includes/cart-recalculation.php" method="post" class="calculation">
                <p class="product_count">
                    数量
                    <input type="number" name="counts[<?= htmlspecialchars($id) ?>]" value="<?= htmlspecialchars($count) ?>" min="1">個
                </p>
                <p class="recalculation">
                    <button type="submit" name="update" value="<?= $id ?>">再計算</button>
                </p>
                <p class="delete">
                    <button type="submit" name="delete" value="<?= $id ?>" onclick="return confirm('本当に削除しますか？');">削除する</button>
                </p>
            </form>
        </div>
    </div>
</div>
<hr>
<?php endforeach; ?>

<!-- 購入用フォームの合計再表示 -->
<form action="includes/cart-confirm.php" method="post">
    <div class="total">
        <p>合計：¥<?= number_format($total) ?></p>
        <input type="submit" value="購入確認に進む">
    </div>
</form>
</div>

<?php else: ?>
<div class="h2"><h2>カート</h2></div>
<div class="logform in out">
    <p>カートは空です</p>
</div>
<?php endif; ?>

<?php require 'footer.php'; ?>
