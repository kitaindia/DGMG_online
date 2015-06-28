<?php
session_start();
//セッションが破棄されている場合は、トップページへ遷移する
if(!isset($_SESSION["id"]))
	{header("Location: /index.php");exit;}
//交換するポイントと獲得する金貨枚数を取得
$point = $_POST['point'];
$coin = $point/100;
//DB接続
$pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト名', 'ユーザー名', 'パスワード');
$pdo->query('SET NAMES utf8');
//ID取得
$USER_ID = $_SESSION['id'];
//postで取得した値と残ポイント数を比較
//以上の場合にのみ実行
//所持ポイントを取得
$sql = "SELECT POINTS FROM TEST_GAME WHERE USER_ID = :USER_ID";
$getPoint = $pdo->prepare($sql);
$getPoint->bindValue(':USER_ID',$USER_ID, PDO::PARAM_STR);
$getPoint->execute();
$currentPoint = $getPoint->fetch(PDO::FETCH_NUM);
$r_point = $currentPoint[0];
if($r_point>=$point){
//所持ポイントを更新
$stmt = $pdo->prepare('UPDATE TEST_GAME SET POINTS = POINTS - :POINTS WHERE USER_ID = :USER_ID');
$stmt->bindValue(':USER_ID', $USER_ID, PDO::PARAM_STR);
$stmt->bindValue(':POINTS', $point, PDO::PARAM_INT);
$stmt->execute();
//所持金貨を更新
$stmt = $pdo->prepare('UPDATE db_user SET sirudoru = sirudoru + :coin WHERE id = :USER_ID');
$stmt->bindValue(':USER_ID', $USER_ID, PDO::PARAM_STR);
$stmt->bindValue(':coin', $coin, PDO::PARAM_INT);
$stmt->execute();
//所持金貨を取得
$sql = "SELECT sirudoru FROM db_user WHERE id = :USER_ID";
$getCoin = $pdo->prepare($sql);
$getCoin->bindValue(':USER_ID',$USER_ID, PDO::PARAM_STR);
$getCoin->execute();
$currentCoin = $getCoin->fetch(PDO::FETCH_NUM);
$r_coin = $currentCoin[0];
//計算
//ポイント
//元々
$p1 = $r_point;
//交換額
$p2 = $point;
//結果
$p3 = $r_point-$point; 
//金貨
//元々
$c1 = $r_coin-$coin;
//交換額
$c2 = $coin;
//結果
$c3 = $r_coin;
}else{
$error = strval($point)."ポイントを指定されましたが現在の所持ポイントは".strval($r_point)."ポイントしかなく<br>交換できませんでした。";
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ポイント換金所く</title>
<style type="text/css">
</style>
<link rel="stylesheet" type="text/css" href="css/html5reset.css"  />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script type="text/javascript">
	</script>
</head>
<body>
<div id="header">
<?php include( $_SERVER['DOCUMENT_ROOT'] . '/dropDownMenu.php'); ?>
</div>
<br>
<table>
	<tbody>
		<tr>
			<td></td>
			<td>ポイント</td>
			<td>金貨</td>
		</tr>
		<tr>
			<td>換金前</td>
			<td><?php echo $p1;?>pt</td>
			<td><?php echo $c1;?>枚</td>
		</tr>
		<tr>
			<td>換金量</td>
			<td><?php echo $p2;?>pt</td>
			<td><?php echo $c2;?>枚</td>
		</tr>
		<tr>
			<td><font color="red">換金後</font></td>
			<td><font color="red"><?php echo $p3?>pt</font></td>
			<td><font color="red"><?php echo $c3?>枚</font></td>
		</tr>
	</tbody>
</table>
<font color="red"><?php echo $error;?></font>
<br>
<a href="http://syldra.secret.jp/exchange/main.php">もう一度換金する。</a>
<br>
<a href="http://syldra.secret.jp/index.php">トップページに戻る。</a>
</body>
</html>