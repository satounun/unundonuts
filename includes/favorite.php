<?php session_start(); ?>
<?php
$page_title = 'お気に入り';
require 'header.php';
?>

<?php
$fav_key = isset($_SESSION['customer']) ? 'favorite_' . $_SESSION['customer']['id'] : 'favorite';
$favorites = $_SESSION[$fav_key] ?? [];

$total = 0;
$total_items = 0;

$id = $_REQUEST['id'] ?? null;
$name = $_REQUEST['name'] ?? null;
$price = $_REQUEST['price'] ?? null;
$count_input = $_REQUEST['count'] ?? null;

?>

<nav class="pan">
  <ol>
    <li><a href="index.php">TOP</a> ＞</li>
    <li><a href="includes/all.php">商品一覧</a> ＞</li>
    <li><a href="includes/detail.php">商品詳細</a> ＞</li>
    <li>お気に入り</li>
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

<div class="h2"><h2>お気に入り一覧</h2></div>

<div class="cform">
<?php if (!empty($favorites)): ?>
  <?php foreach ($favorites as $id => $item):
      $name = $item['name'];
      $price = (float)$item['price'];
      $count = (int)$item['count'];
      $subtotal = $price * $count;
      $total += $subtotal;
      $total_items += $count;

      $image_path = $imageMap[$name] ?? 'images/noimage.png';
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
            <form action="includes/favorite-recalculation.php" method="post" class="calculation">
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

<?php else: ?>
    <p class="nofav">お気に入りの商品はまだ登録されていません。</p>
<?php endif; ?>

</form>
<form action="includes/cart-insert.php" method="post">
    <div class="total">
        <p>合計：¥<?= number_format($total) ?></p>
        <?php foreach ($favorites as $id => $item): ?>
            <input type="hidden" name="products[<?= $id ?>][id]" value="<?= htmlspecialchars($id) ?>">
            <input type="hidden" name="products[<?= $id ?>][name]" value="<?= htmlspecialchars($item['name']) ?>">
            <input type="hidden" name="products[<?= $id ?>][price]" value="<?= htmlspecialchars($item['price']) ?>">
            <input type="hidden" name="products[<?= $id ?>][count]" value="<?= htmlspecialchars($item['count']) ?>">
        <?php endforeach; ?>
        <input type="submit" value="カートに追加する">
    </div>
</form>

</div>

<?php require 'footer.php'; ?>
