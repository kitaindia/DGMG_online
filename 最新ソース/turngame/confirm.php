<?php
session_start();
//セッションが破棄されている場合は、トップページへ遷移する
if(!isset($_SESSION["id"]))
	{header("Location: /index.php");exit;}
$USER_ID = $_SESSION["id"];
//DB接続
    try {
$pdo = new PDO('mysql:host=mysql010.phy.lolipop.lan;dbname=LAA0535115-dbname;charset=utf8','ユーザ名','パスワード');
array(PDO::ATTR_EMULATE_PREPARES => false);
} catch (PDOException $e) {
 exit('データベース接続失敗。'.$e->getMessage());
}
switch($_POST["do"]){
	//＝＝＝＝＝＝＝＝YES＝＝＝＝＝＝＝＝
	case "yes":
	//金貨枚数を取得し、０枚の場合エラーメッセージを表示
	$sql = 'SELECT sirudoru FROM db_user WHERE id = :USER_ID';
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':USER_ID',$USER_ID,PDO::PARAM_STR);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$COIN = $row["sirudoru"];
	if($COIN == 0){
	header("Location: http://syldra.secret.jp/turngame/error.php");
	}else{
	//金貨を一枚消費する
	$sql = 'UPDATE db_user SET sirudoru = sirudoru-1 WHERE id = :USER_ID';
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':USER_ID',$USER_ID,PDO::PARAM_STR);
	$stmt->execute();
	$_SESSION["turnGameCOIN"] = 1;
	header("Location: http://syldra.secret.jp/turngame/main.php");
	}
	exit;
	;
	break;
	//＝＝＝＝＝＝＝＝NO＝＝＝＝＝＝＝＝
	case "no":
	header("Location: http://syldra.secret.jp/index.php");
	exit;
	;
	break;
	//＝＝＝＝＝＝＝NULL(初期表示)＝＝＝＝＝＝＝
	default:
	break;
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>めくってシルドラくん-確認-</title>
<style type="text/css">
	.demo1 button, .demo1 input[type=button],  
.demo1 input[type=reset], .demo1 input[type=submit] {  
    background: -moz-linear-gradient(top, #fff, #F1F1F1 1%, #F1F1F1 50%, #DFDFDF 99%, #ccc);  
    background: -webkit-gradient(linear, left top, left bottom, from(#fff), color-stop(0.01, #F1F1F1), color-stop(0.5, #F1F1F1), color-stop(0.99, #DFDFDF), to(#ccc));  
    -moz-box-shadow: 1px 1px 2px #E7E7E7;  
    -webkit-box-shadow: 1px 1px 2px #E7E7E7; 
    width:90px; 
}  
.demo1 button:hover, .demo1 input[type=button]:hover,  
.demo1 input[type=reset]:hover, .demo1 input[type=submit]:hover {  
    background: -moz-linear-gradient(top, #fff, #e1e1e1 1%, #e1e1e1 50%, #cfcfcf 99%, #ccc);  
    background: -webkit-gradient(linear, left top, left bottom, from(#fff), color-stop(0.01, #e1e1e1), color-stop(0.5, #e1e1e1), color-stop(0.99, #cfcfcf), to(#ccc));  
}  
.demo1 button:active, .demo1 input[type=button]:active,  
.demo1 input[type=reset]:active, .demo1 input[type=submit]:active   {  
    background: #ccc;  
    padding: 6px 20px 4px;  
}  
</style>
<link rel="stylesheet" type="text/css" href="css/html5reset.css"  />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
<div id="header">
<?php include( $_SERVER['DOCUMENT_ROOT'] . '/dropDownMenu.php'); ?>
</div>
利用料金は１回１金貨になります。<br>
「めくってシルドラくん」で遊びますか？<br>
<section class="demo1">
<form action="#" method="POST">
<input type="hidden" name="do" value="yes">
<input type="submit" value="遊ぶ">
</form>
<form action="#" method="POST">
<input type="hidden" name="do" value="no">
<input type="submit" value="遊ばない">
</form>
</section>
</body>
</html>