<?php
session_start();

// カートキーを定義
$cart_key = isset($_SESSION['customer']) ? 'product_' . $_SESSION['customer']['id'] : 'product';
$cart = &$_SESSION[$cart_key];

// 再計算処理
if (isset($_POST['update'])) {
    $id = $_POST['update'];
    if (isset($_POST['counts'][$id])) {
        $newCount = (int)$_POST['counts'][$id];
        if ($newCount > 0) {
            $cart[$id]['count'] = $newCount;
        }
    }
}

// 削除処理
if (isset($_POST['delete'])) {
    $id = $_POST['delete'];
    unset($cart[$id]);
}

// 処理後に元のカートページへリダイレクト
header("Location: cart.php"); // ← 相対パス調整
exit;
