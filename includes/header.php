<?php
$page_title = isset($page_title) ? $page_title : '';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
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
            <div class="favorite"><a href="/ccdonuts/includes/favorite.php">
                <svg width="29" height="30" viewBox="0 0 29 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.5166 4.64223L13.0199 2.9242C12.3184 2.10811 11.4831 1.45937 10.5623 1.01532C9.64143 0.571265 8.65315 0.340682 7.65434 0.336841C6.65554 0.333 5.66594 0.555978 4.74252 0.992937C3.8191 1.4299 2.9801 2.0722 2.27383 2.88288C1.56757 3.69355 1.00799 4.65658 0.627303 5.71651C0.246621 6.77644 0.0523604 7.91233 0.0557066 9.05879C0.0590527 10.2053 0.259939 11.3396 0.6468 12.3966C1.03366 13.4536 1.59885 14.4123 2.30984 15.2175L14.4808 29.1877L14.4836 29.1846L14.5194 29.2257L26.6904 15.2554C27.4014 14.4502 27.9666 13.4915 28.3534 12.4345C28.7403 11.3776 28.9412 10.2432 28.9445 9.09672C28.9479 7.95026 28.7536 6.81437 28.3729 5.75444C27.9922 4.69451 27.4326 3.73148 26.7264 2.92081C26.0201 2.11013 25.1811 1.46783 24.2577 1.03087C23.3343 0.593911 22.3447 0.370932 21.3459 0.374773C20.3471 0.378614 19.3588 0.609198 18.4379 1.05325C17.5171 1.4973 16.6819 2.14604 15.9803 2.96213L14.5166 4.64223ZM14.4836 24.7149L21.2803 16.9118L23.2769 14.6991H23.2796L24.7434 13.0206C25.6472 11.9831 26.155 10.576 26.155 9.10879C26.155 7.64158 25.6472 6.23446 24.7434 5.19699C23.8395 4.15952 22.6136 3.57667 21.3354 3.57667C20.0571 3.57667 18.8312 4.15952 17.9274 5.19699L14.518 9.11195L14.5084 9.10088L11.0728 5.16064C10.169 4.12317 8.9431 3.54032 7.66485 3.54032C6.38661 3.54032 5.16072 4.12317 4.25686 5.16064C3.35301 6.19811 2.84523 7.60523 2.84523 9.07243C2.84523 10.5396 3.35301 11.9468 4.25686 12.9842L7.75436 16.9988L7.75573 16.994L14.4836 24.7165V24.7149Z" fill="#7F5539"/>
                </svg>
                <p>お気に入り</p>
            </a></div>
            <div class="cart"><a href="/ccdonuts/includes/cart.php"><img src="/ccdonuts/images/header_footer/cart.svg" alt=""></a></div>
        </div>
        <form action="includes/search-output.php" method="post" class="headerSub">
            <!-- 検索ボタン -->
            <div>
                <input type="image" src="images/header_footer/search.svg" alt="検索">
                <input type="text" name="keyword" placeholder="キーワード検索">

                <!-- トリガーボタン -->
                <button type="button" class="accordion-btn" id="openCondition"></button>

                <!-- 最初の選択（価格 or 系統） -->
                <div class="condition-sub" id="conditionMenu">
                    <label>
                        <input type="radio" name="condition" value="price" onclick="showDetail('price')"> お値段
                    </label>
                    <label>
                        <input type="radio" name="condition" value="type" onclick="showDetail('type')"> ドーナツ系統
                    </label>
                </div>

                <!-- 価格帯選択 -->
                <div class="condition-detail" id="priceMenu">
                    <select name="price" id="price" onchange="this.form.submit()">
                        <option value="">価格で絞り込む</option>
                        <option value="~1500">〜1,500円</option>
                        <option value="1501~2000">1,501〜2,000円</option>
                        <option value="2001~2500">2,001〜2,500円</option>
                        <option value="2501~3000">2,501〜3,000円</option>
                        <option value="3001~3500">3,001〜3,500円</option>
                        <option value="3501~4000">3,501〜4,000円</option>
                    </select>
                </div>

                <!-- 系統選択 -->
                <div class="condition-detail" id="typeMenu">
                     <select name="genre" id="genre" onchange="this.form.submit()">
                        <option value="">系統で絞り込む</option>
                        <option value="1">プレーン</option>
                        <option value="2">チョコ</option>
                        <option value="3">フルーツ</option>
                        <option value="4">その他</option>
                    </select>
                    </div>
            </div>
        </form>    
    </header>
