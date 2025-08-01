<?php
session_start();

// お気に入りキーの定義
$fav_key = isset($_SESSION['customer']) ? 'favorite_' . $_SESSION['customer']['id'] : 'favorite';
$favorites = $_SESSION[$fav_key] ?? [];

// 再計算処理
if (isset($_POST['update'])) {
    $id = $_POST['update'];
    if (isset($_POST['counts'][$id])) {
        $newCount = (int)$_POST['counts'][$id];
        if ($newCount > 0) {
            $favorites[$id]['count'] = $newCount;
        }
    }
}

// 削除処理
if (isset($_POST['delete'])) {
    $id = $_POST['delete'];
    unset($favorites[$id]);
}

// ✅ セッションを更新！
$_SESSION[$fav_key] = $favorites;

// リダイレクト
header("Location: favorite.php");
exit;
