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

<?php require 'includes/header.php'; ?>
<div id="wrapper">
    <?php
    if (isset($_SESSION['customer']['name'])) {
        echo '<p class="guest">ようこそ、', htmlspecialchars($_SESSION['customer']['name'], ENT_QUOTES, 'UTF-8'), '様</p>';
    } else {
        echo '<p class="guest">ようこそ、　ゲスト様。</p>';
    }
    ?>

    <p class="hero"><img src="images/donuts/hero.png" alt=""></p>
    <div class="contents1">
        <div class="twoDonuts">
            <div class="d1"><img src="images/donuts/new_item.png" alt=""></div>
            <div class="d2"><img src="images/donuts/donuts_life.png" alt=""></div>
        </div>
        <div class="d3">
            <a href="includes/all.php"><img src="images/donuts/introduction.png" alt=""></a>
        </div>
    </div>
    <p class="policy"><img src="images/donuts/philosophy.png" alt=""></p>

    <div class="rank"><p>人気ランキング</p></div>

    <?php
    // ランキング順を指定
    $rankingOrder = [
        'CCドーナツ 当店オリジナル（5個入り）',
        'フルーツドーナツセット（12個入り）',
        'フルーツドーナツセット（14個入り）',
        'チョコレートデライト（5個入り）',
        'ベストセレクションボックス（4個入り）',
        'ストロベリークラッシュ（5個入り）'
    ];

    // 商品名と画像の対応表
    $imageMap = [
        'チョコレートデライト（5個入り）' => 'images/donuts/choco.png',
        'ストロベリークラッシュ（5個入り）' => 'images/donuts/strawberry.png',
        'CCドーナツ 当店オリジナル（5個入り）' => 'images/donuts/cc.png',
        'フルーツドーナツセット（12個入り）' => 'images/donuts/donuts_family1.png',
        'フルーツドーナツセット（14個入り）' => 'images/donuts/donuts_family2.png',
        'ベストセレクションボックス（4個入り）' => 'images/donuts/besties.png'
    ];

    // 商品データ取得
    $sql = 'SELECT * FROM products';
    $stmt = $pdo->query($sql);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 商品名で連想配列を作る
    $productMap = [];
    foreach ($products as $product) {
        $productMap[$product['name']] = $product;
    }
    ?>

    <div class="ranking">
        <?php
        $rank = 1;
        foreach ($rankingOrder as $name) {
            $product = $productMap[$name] ?? null;
            if (!$product) continue;
            $image = $imageMap[$name] ?? 'images/donuts/default.png';
            ?>
            <form action="/ccdonuts/includes/cart-insert.php" method="post">
                <div class="r<?php echo $rank; ?> num">
                    <p class="rk"><?php echo $rank; ?></p>
                    <a href="/ccdonuts/includes/detail.php?id=<?php echo $rank; ?>">
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
            $rank++;
        }
        ?>
    </div>
</div>

<?php require 'includes/footer.php'; ?>
