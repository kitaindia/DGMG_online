<?php
session_start();
//セッションが破棄されている場合は、トップページへ遷移する
if(!isset($_SESSION["id"]))
	{header("Location: /index.php");exit;}
//DB接続しポイントを加算
$USER_ID= $_SESSION["id"];
    try {
$pdo = new PDO('mysql:host=mysql010.phy.lolipop.lan;dbname=LAA0535115-dbname;charset=utf8','ユーザー名','パスワード');
array(PDO::ATTR_EMULATE_PREPARES => false);
} catch (PDOException $e) {
 exit('データベース接続失敗。'.$e->getMessage());
}
$sql = 'UPDATE TEST_GAME SET POINTS = POINTS + :POINTS WHERE USER_ID = :USER_ID';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':USER_ID',$USER_ID, PDO::PARAM_STR);
$stmt->bindValue(':POINTS',(int)$_POST["point"],PDO::PARAM_INT);
$stmt->execute();
//総ポイント数を取得
$sql = 'SELECT POINTS FROM TEST_GAME WHERE USER_ID = :USER_ID';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':USER_ID',$USER_ID,PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$totalPoint = $row["POINTS"];
//コイン消費変数をクリア
$_SESSION["turnGameCOIN"] = 0;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>めくってシルドラくん-クリア-</title>
<link rel="stylesheet" type="text/css" href="css/html5reset.css"  />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
<div id="header">
<?php include( $_SERVER['DOCUMENT_ROOT'] . '/dropDownMenu.php'); ?>
</div>
<? echo $_POST["point"];?>ポイント獲得し、合計<?php echo $totalPoint;?>ポイントになりました。
<br>
<br>
<a href="http://syldra.secret.jp/turngame/confirm.php">もう一度遊ぶ。</a>
<br>
<a href="http://syldra.secret.jp/exchange/main.php">換金所に行く。</a>
<br>
<a href="http://syldra.secret.jp/index.php">トップページに戻る。</a>
</body>
</html>