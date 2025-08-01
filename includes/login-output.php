<?php session_start(); ?>
<?php
$page_title = 'ログイン完了';
require 'header.php';
?>

<nav class="pan">
  <ol>
    <li><a href="index.php">TOP</a>＞ </li>
    <li>
      <a href="includes/login-input.php">ログイン</a>＞ </li>
    <li>ログイン完了</li>
  </ol>
</nav>


<?php
unset($_SESSION['customer']);
$pdo = new PDO(
    'mysql:---------------',
        '-------------',
        '-------------'      
);

$sql = $pdo->prepare('select * from customers where mail=? and password=?');
$sql->execute([$_REQUEST['mail'], $_REQUEST['password']]);
foreach ($sql as $row) {
    $_SESSION['customer']=[
        'id'=>$row['id'], 'name'=>$row['name'],
        'address'=>$row['address'], 'password'=>$row['password']
    ];
}

if (isset($_SESSION['customer'])) {
    echo '<p class="guest">ようこそ、', htmlspecialchars($_SESSION['customer']['name'], ENT_QUOTES, 'UTF-8'), '様</p>';
    echo '<div class="h2"><h2>ログイン完了</h2></div>';
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

<p class="toCus togo"><a href="/ccdonuts/includes/logout-input.php">ログアウトはこちら</a></p>
<p class="toCus togo"><a href="includes/cart-confirm.php">購入確認ページへすすむ</a></p>
<p class="toCus togo"><a href="index.php">TOPページへもどる</a></p>

<?php require 'footer.php'; ?>
