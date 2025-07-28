<?php session_start(); ?>
<?php
$page_title = '検索結果';
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

// 検索ワード取得
$keyword = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';

if ($keyword !== '') {
    $sql = $pdo->prepare("SELECT * FROM products WHERE name LIKE ? OR introduction LIKE ?");
    $searchWord = '%' . $keyword . '%';
    $sql->execute([$searchWord, $searchWord]);
    $products = $sql->fetchAll();
} else {
    $products = [];
}
?>

<nav class="pan">
  <ol>
    <li><a href="index.php">TOP</a> ＞</li>
    <li>検索結果</li>
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

?>

<div class="h2"><h2>検索結果</h2></div>

<?php if (count($products) > 0): ?>
    <div class="search-result-list">
        <?php foreach ($products as $product): ?>
            <?php
                $imagePath = isset($imageMap[$product['name']]) ? $imageMap[$product['name']] : 'images/donuts/noimage.png';
            ?>
            <div class="detailWrap">
                <div class="dimg">
                    <a href="detail.php?id=<?= $product['id'] ?>">
                        <img src="<?= htmlspecialchars($imagePath) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="product-image">
                    </a>
                </div>
                <div class="detail">
                    <form action="includes/cart-insert.php" method="post" class="dform">
                        <h2><?= htmlspecialchars($product['name']) ?></h2>
                        <div class="intr"><p><?= nl2br(htmlspecialchars($product['introduction'])) ?></p></div>
                        <p class="red">税込 ￥<?= number_format($product['price']) ?></p>
                        <div class="fav">
                            <input type="number" name="count" min="1"><span>個</span>

                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8'); ?>">
                            <input type="hidden" name="name" value="<?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?>">
                            <input type="hidden" name="price" value="<?php echo htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8'); ?>">
                            <input type="hidden" name="count" value="1">   
                             
                            <p class="toCart"><input type="submit" value="カートに入れる"></p>
                            <a href="favorite-insert.php?id=<?= $product['id'] ?>"><img src="images/donuts/favorite.svg" alt=""></a>
                        </div>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>該当する商品は見つかりませんでした。</p>
<?php endif; ?>

<?php require 'footer.php'; ?>
