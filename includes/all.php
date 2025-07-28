<?php session_start(); ?>
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
?>

<?php
$page_title = '商品一覧';
require 'header.php';
?>

<nav class="pan">
  <ol>
    <li><a href="../index.php">TOP</a>＞</li>
    <li>商品一覧</li>
  </ol>
</nav>

<?php
if (isset($_SESSION['customer']['name'])) {
    echo '<p class="guest">ようこそ、', htmlspecialchars($_SESSION['customer']['name'], ENT_QUOTES, 'UTF-8'), '様</p>';
} else {
    echo '<p class="guest">ようこそ、　ゲスト様。</p>';
}
?>

<div class="h2"><h2>商品一覧</h2></div>
<h3>メインメニュー</h3>

<?php
$mainOrder = [
    'CCドーナツ 当店オリジナル（5個入り）',
    'チョコレートデライト（5個入り）',
    'キャラメルクリーム（5個入り）',
    'プレーンクラシック（5個入り）',
    'サマーシトラス（5個入り）',
    'ストロベリークラッシュ（5個入り）'
];

$imageMap = [
    'CCドーナツ 当店オリジナル（5個入り）' => 'images/donuts/cc.png',
    'チョコレートデライト（5個入り）' => 'images/donuts/choco.png',
    'キャラメルクリーム（5個入り）' => 'images/donuts/caramel.png',
    'プレーンクラシック（5個入り）' => 'images/donuts/plene.png',
    'サマーシトラス（5個入り）' => 'images/donuts/summer.png',
    'ストロベリークラッシュ（5個入り）' => 'images/donuts/strawberry.png'
];

$sql = 'SELECT * FROM products';
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$productMap = [];
foreach ($products as $product) {
    $productMap[$product['name']] = $product;
}
?>

<div class="mainMenu">
    <?php
    $num = 1;
    foreach ($mainOrder as $name) {
        $product = $productMap[$name] ?? null;
        if (!$product) continue;
        $image = $imageMap[$name] ?? 'images/donuts/default.png';
        ?>
        <form action="/ccdonuts/includes/cart-insert.php" method="post">
            <div class="r<?php echo $num; ?> num">
            <a href="/ccdonuts/includes/detail.php?id=<?php echo $num; ?>">
                    <img src="<?php echo $image; ?>" alt="<?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?>">
                </a>
                <p class="dname"><?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="red">税込み ￥<?php echo number_format($product['price']); ?></p>

                <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="name" value="<?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="price" value="<?php echo htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="count" value="1">    

                <p class="toCart"><input type="submit" value="カートに入れる"></p>
            </div>
        </form>
        <?php
        $num++;
    }
    ?>
</div>

<h3>バラエティセット</h3>

<?php
$varietyOrder = [
    'フルーツドーナツセット（12個入り）',
    'フルーツドーナツセット（14個入り）',
    'ベストセレクションボックス（4個入り）',
    'チョコクラッシュボックス（7個入り）',
    'クリームボックス（4個入り）',
    'クリームボックス（9個入り）'
];

$imageMap = [
    'フルーツドーナツセット（12個入り）' => 'images/donuts/donuts_family1.png',
    'フルーツドーナツセット（14個入り）' => 'images/donuts/donuts_family2.png',
    'ベストセレクションボックス（4個入り）' => 'images/donuts/besties.png',
    'チョコクラッシュボックス（7個入り）' => 'images/donuts/crush.png',
    'クリームボックス（4個入り）' => 'images/donuts/cream4.png',
    'クリームボックス（9個入り）' => 'images/donuts/cream9.png'
];

$sql = 'SELECT * FROM products';
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$productMap = [];
foreach ($products as $product) {
    $productMap[$product['name']] = $product;
}
?>

<div class="mainMenu">
    <?php
    $num = 7;
    foreach ($varietyOrder as $name) {
        $product = $productMap[$name] ?? null;
        if (!$product) continue;
        $image = $imageMap[$name] ?? 'images/donuts/default.png';
        ?>
        <form action="/ccdonuts/includes/cart-insert.php" method="post">
            <div class="r<?php echo $num; ?> num">
            <a href="/ccdonuts/includes/detail.php?id=<?php echo $num; ?>">
                    <img src="<?php echo $image; ?>" alt="<?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?>">
                </a>
                <p class="dname"><?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="red">税込み ￥<?php echo number_format($product['price']); ?></p>

                <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="name" value="<?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="price" value="<?php echo htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="count" value="1">    
                
                <p class="toCart"><input type="submit" value="カートに入れる"></p>
            </div>
        </form>
        <?php
        $num++;
    }
    ?>
</div>


<?php require 'footer.php'; ?>
