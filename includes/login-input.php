<?php require 'header.php'; ?>

<nav class="pan">
  <ol itemscope itemtype="">
    <li itemprop="itemListElement" itemscope itemtype="">
      <a itemprop="item" href="ccdonuts/index.php"><span itemprop="name">TOP</span></a>
      <meta itemprop="position" content="1" /><span>＞</span>
    </li>
    <li itemprop="itemListElement" itemscope itemtype="">
      <span itemprop="name">ログイン</span>
      <meta itemprop="position" content="2" />
    </li>
  </ol>
</nav>

<p class="guest">ようこそ　ゲスト様</p>

<div class="h2"><h2>ログイン</h2></div>
<form action="/ccdonuts/includes/login-output.php" method="post" class="logform">
    <p>メールアドレス</p>
    <p><input type="text" name="mail"></p>
    <p>パスワード</p>
    <p><input type="text" name="password"></p>
    <p class="tolog"><input type="submit" value="ログインする"></p>
</form>
<p class="toCus"><a href="/ccdonuts/includes/customer-input.php">会員登録はこちら</a></p>


<?php require 'footer.php'; ?>