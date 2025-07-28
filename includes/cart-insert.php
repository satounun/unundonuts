<?php
session_start();

$cart_key = isset($_SESSION['customer']) ? 'product_' . $_SESSION['customer']['id'] : 'product';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=ccdonuts;charset=utf8', 'ccStaff', 'ccDonuts');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit('DB接続失敗: ' . $e->getMessage());
}

$id = $_REQUEST['id'] ?? null;
$name = $_REQUEST['name'] ?? null;
$price = $_REQUEST['price'] ?? null;
$count_input = $_REQUEST['count'] ?? null;

// 必須項目が未入力ならカートページにエラー付きで戻す
if (!$id || !$name || !$price || !$count_input) {
    header('Location: cart.php?error=1');
    exit;
}

// カートセッション初期化
if (!isset($_SESSION['product'])) {
    $_SESSION['product'] = [];
}

// すでにカートにある商品か確認
$count = 0;
if (isset($_SESSION['product'][$id])) {
    $count = $_SESSION['product'][$id]['count'];
}

// カートに追加
$_SESSION[$cart_key][$id] = [
    'id' => $id,
    'name' => $name,
    'price' => $price,
    'count' => $count + $count_input
];

// 成功したらカートページへリダイレクト
header('Location: cart.php?added=1');
exit;


