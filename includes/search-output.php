<?php session_start(); ?>
<?php
$page_title = '検索結果';
require 'header.php';
?>

<?php
try {
    $pdo = new PDO(
        'mysql:---------------',
        '-------------',
        '-------------'      
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit('DB接続失敗: ' . $e->getMessage());
}

// 検索ワード取得
$keyword = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';
$price = isset($_POST['price']) ? (int)$_POST['price'] : 0;
$genre = isset($_POST['genre']) ? (int)$_POST['genre'] : 0;

$sql = "SELECT * FROM products WHERE 1";
$params = [];

// キーワード条件
if ($keyword !== '') {
    $sql .= " AND (name LIKE ? OR introduction LIKE ?)";
    $params[] = "%$keyword%";
    $params[] = "%$keyword%";
}

// 価格条件 金額の範囲指定
if (!empty($_POST['price'])) {
    $priceRange = explode('~', $_POST['price']); 
    if (count($priceRange) === 2) {
        $minPrice = (int)$priceRange[0];
        $maxPrice = (int)$priceRange[1];
        $sql .= " AND price BETWEEN ? AND ?";
        $params[] = $minPrice;
        $params[] = $maxPrice;
    }
}

if ($genre > 0) {
    $sql .= " AND genre = :genre";
    $params[':genre'] = $genre;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();

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
                    </form>
                    <form action="includes/favorite-insert.php" method="post" class="favorite-form">

                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8'); ?>">
                        <input type="hidden" name="name" value="<?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?>">
                        <input type="hidden" name="price" value="<?php echo htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8'); ?>">
                        <input type="hidden" name="count" value="1">  
                         
                        <input type="image" src="images/donuts/favorite.svg">
                    </div>
                    </form>
                        </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>該当する商品は見つかりませんでした。</p>
<?php endif; ?>

<?php require 'footer.php'; ?>
