<?php
$page_title = isset($page_title) ? $page_title : '';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C.C.Donuts<?= $page_title ? ' | ' . htmlspecialchars($page_title) : '' ?></title>
    <base href="/ccdonuts/">
    <link rel="stylesheet" href="/ccdonuts/common/reset.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/ccdonuts/styles/style.css">
    <link rel="stylesheet" href="/ccdonuts/styles/toppage.css">
    <link rel="stylesheet" href="/ccdonuts/styles/all.css">
    <link rel="stylesheet" href="/ccdonuts/styles/detail.css">
    <link rel="stylesheet" href="/ccdonuts/styles/customer.css">
    <link rel="stylesheet" href="/ccdonuts/styles/cart.css">
</head>
<body>
    <header>
        <div id="top">
            <div class="three hamburger" id="open_nav"><img src="/ccdonuts/images/header_footer/threeLine.svg" alt=""></div>
            <a href="index.php"><h1><img src="/ccdonuts/images/header_footer/mainLogo.svg" alt=""></h1></a>
            <div class="login"><a href="/ccdonuts/includes/login-input.php"><img src="/ccdonuts/images/header_footer/login.svg" alt=""></a></div>
            <div class="cart"><a href="/ccdonuts/includes/cart.php"><img src="/ccdonuts/images/header_footer/cart.svg" alt=""></a></div>
        </div>
        <form action="includes/search-output.php" method="post" class="headerSub">
            <div>
                <input type="image" src="images/header_footer/search.svg">
                <input type="text" name="keyword">
            </div>
        </form>
    </header>
