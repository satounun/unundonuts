<?php
session_start();

// お気に入りのキーを定義（ログインユーザーがいればIDを付ける）
$fav_key = isset($_SESSION['customer']) ? 'favorite_' . $_SESSION['customer']['id'] : 'favorite';

// POSTで受け取ったデータを取得
$id = $_POST['id'] ?? null;
$name = $_POST['name'] ?? null;
$price = $_POST['price'] ?? null;
$count = $_POST['count'] ?? 1;

// 必要な情報がそろっていれば、お気に入りに追加
if ($id && $name && $price) {
    $_SESSION[$fav_key][$id] = [
        'name' => $name,
        'price' => $price,
        'count' => $count
    ];
}

// お気に入り一覧ページにリダイレクト
header('Location: favorite.php');
exit();
