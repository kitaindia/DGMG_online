<?php
session_start();
//セッションが破棄されている場合は、トップページへ遷移する
if(!isset($_SESSION["id"]))
	{header("Location: /index.php");exit;}
$_SESSION["turnGameCOIN"] = 0;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>めくってシルドラくん-エラー-</title>
<link rel="stylesheet" type="text/css" href="css/html5reset.css"  />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
<div id="header">
<?php include( $_SERVER['DOCUMENT_ROOT'] . '/dropDownMenu.php'); ?>
</div>
金貨が０枚です。
<br>
支払える金貨が無いので遊べないです。
<br>
換金所でポイントを金貨に交換できます。
<br>
<br>
<a href="#">換金所に行く。（準備中）</a>
<br>
<a href="http://syldra.secret.jp/index.php">トップページに戻る。</a>
</body>
</html>