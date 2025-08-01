<?php
session_start();

$cart_key = isset($_SESSION['customer']) ? 'product_' . $_SESSION['customer']['id'] : 'product';
$fav_key = isset($_SESSION['customer']) ? 'favorite_' . $_SESSION['customer']['id'] : 'favorite'; 

if (isset($_POST['products']) && is_array($_POST['products'])) {
    // お気に入りページなどの「複数商品一括追加」
    foreach ($_POST['products'] as $product) {
        $id = $product['id'] ?? null;
        $name = $product['name'] ?? null;
        $price = $product['price'] ?? null;
        $count = (int)($product['count'] ?? 1);
        if (!$id || !$name || !$price) continue;

        $current_count = $_SESSION[$cart_key][$id]['count'] ?? 0;

        $_SESSION[$cart_key][$id] = [
            'id' => $id,
            'name' => $name,
            'price' => $price,
            'count' => $current_count + $count
        ];
    }

    unset($_SESSION[$fav_key]);

} elseif (isset($_POST['id'], $_POST['name'], $_POST['price'])) {
    // 商品詳細ページなどの「単品追加」
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $count = (int)($_POST['count'] ?? 1);

    $current_count = $_SESSION[$cart_key][$id]['count'] ?? 0;

    $_SESSION[$cart_key][$id] = [
        'id' => $id,
        'name' => $name,
        'price' => $price,
        'count' => $current_count + $count
    ];
} else {
    // データがないとき（不正なアクセスなど）
    header('Location: cart.php?error=1');
    exit;
}

header('Location: cart.php?added=1');
exit;
