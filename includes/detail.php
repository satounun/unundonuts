<?php session_start(); ?>
<?php
$page_title = '商品詳細';
require 'header.php';
?>

<?php
try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=ss566997_ccdonuts;charset=utf8',
        'ss566997_user',
        '4290abcd'    
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit('DB接続失敗: ' . $e->getMessage());
}
$sql = $pdo->prepare('select * from products where id=?');
$sql->execute([$_REQUEST['id']]);
$product = $sql->fetch();
?>

<nav class="pan">
  <ol>
    <li><a href="ccdonuts/index.php">TOP</a>＞</span></li>
    <li><a href="/ccdonuts/includes/all.php">商品一覧</a>＞</span></li>
    <li><?= htmlspecialchars($product['name']) ?></li>
  </ol>
</nav>

<?php
if (isset($_SESSION['customer']['name'])) {
    echo '<p class="guest">ようこそ、', htmlspecialchars($_SESSION['customer']['name'], ENT_QUOTES, 'UTF-8'), '様</p>';
} else {
    echo '<p class="guest">ようこそ、　ゲスト様。</p>';
}

$imageMap = [
    'CCドーナツ 当店オリジナル（5個入り）' => 'images/donuts/cc.png',
    'チョコレートデライト（5個入り）' => 'images/donuts/choco.png',
    'キャラメルクリーム（5個入り）' => 'images/donuts/caramel.png',
    'プレーンクラシック（5個入り）' => 'images/donuts/plene.png',
    'サマーシトラス（5個入り）' => 'images/donuts/summer.png',
    'ストロベリークラッシュ（5個入り）' => 'images/donuts/strawberry.png',
    'フルーツドーナツセット（12個入り）' => 'images/donuts/donuts_family1.png',
    'フルーツドーナツセット（14個入り）' => 'images/donuts/donuts_family2.png',
    'ベストセレクションボックス（4個入り）' => 'images/donuts/besties.png',
    'チョコクラッシュボックス（7個入り）' => 'images/donuts/crush.png',
    'クリームボックス（4個入り）' => 'images/donuts/cream4.png',
    'クリームボックス（9個入り）' => 'images/donuts/cream9.png'
];

$imagePath = isset($imageMap[$product['name']]) ? $imageMap[$product['name']] : 'images/donuts/noimage.png';
echo '<div class="detailWrap">';
echo '<div class="dimg"><img src="' . htmlspecialchars($imagePath) . '" alt="' . htmlspecialchars($product['name']) . '" class="product-image"></div>';
echo '<div class="detail">';
echo '<form action="includes/cart-insert.php" method="post" class="dform">';
echo '<h2>' . htmlspecialchars($product['name']) . '</h2>';
echo '<div class="intr"><p>' . nl2br(htmlspecialchars($product['introduction'])) . '</p></div>';
echo '<p class="red">税込 ￥' . number_format($product['price']) . '</p>'; 
echo '<div class="fav"><input type="number" name="count"><span>個</span>';
echo '<p class="toCart"><input type="submit" value="カートに入れる"></p>';
echo '<a href="favorite-insert.php?id=', $product['id'], '"><img src="images/donuts/favorite.svg" alt=""></a>';
echo '</div>';
echo '</form>';
echo '</div>';
echo '</div>';

echo '<input type="hidden" name="id", value="', $product['id'], '">';
echo '<input type="hidden" name="name", value="', $product['name'], '">';
echo '<input type="hidden" name="price", value="', $product['price'], '">';
?>

<?php require 'footer.php'; ?>
