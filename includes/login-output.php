<?php session_start(); ?>
<?php require 'header.php'; ?>

<nav class="pan">
  <ol itemscope itemtype="">
    <li itemprop="itemListElement" itemscope itemtype="">
      <a itemprop="item" href="index.php"><span itemprop="name">TOP</span></a>
      <meta itemprop="position" content="1" /><span>＞</span>
    </li>
    <li itemprop="itemListElement" itemscope itemtype="">
      <a itemprop="item" href="includes/login-input.php"><span itemprop="name">ログイン</span></a>
      <meta itemprop="position" content="1" /><span>＞</span>
    </li>
    <li itemprop="itemListElement" itemscope itemtype="">
      <span itemprop="name">ログイン完了</span>
      <meta itemprop="position" content="2" />
    </li>
  </ol>
</nav>

<?php
echo '<p class="guest">ようこそ、', htmlspecialchars($_SESSION['customer']['name'], ENT_QUOTES, 'UTF-8'), '様</p>';
?>

<div class="h2"><h2>ログイン完了</h2></div>

<?php
unset($_SESSION['customer']);
$pdo = new PDO('mysql:host=localhost;dbname=ccdonuts;charset=utf8', 'ccStaff', 'ccDonuts');
$sql = $pdo->prepare('select * from customers where mail=? and password=?');
$sql->execute([$_REQUEST['mail'], $_REQUEST['password']]);
foreach ($sql as $row) {
    $_SESSION['customer']=[
        'id'=>$row['id'], 'name'=>$row['name'],
        'address'=>$row['address'], 'password'=>$row['password']
    ];
}
if (isset($_SESSION['customer'])) {
    echo '<div class="logform in">';
    echo '<p>ログインが完了しました。</p>';
    echo '<p>引き続きお楽しみください。</p>';
    echo'</div>';
} else {
    echo '<div class="logform in">';
    echo '<p>ログイン名またはパスワードが違います。</p>';
    echo'</div>';
}
?>

<p class="toCus togo"><a href="">購入確認ページへすすむ</a></p>
<p class="toCus togo"><a href="index.php">TOPページへもどる</a></p>

<?php require 'footer.php'; ?>
