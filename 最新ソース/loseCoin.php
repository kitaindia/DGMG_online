<?php
//セッション開始
session_start();
if(!isset($_SESSION["id"]))
//Case セッション破棄
{
header("Location: /index.php");
exit;
}
//DB接続
$pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト', 'ユーザ名', 'パスワード');
$pdo->query('SET NAMES utf8');
//ID取得
$USER_ID = $_SESSION['id'];
//獲得金貨枚数を取得
$COIN = $_POST['lostCoin'];
//金貨枚数をUPDAT
$stmt = $pdo->prepare('UPDATE TEST_GAME SET COIN = COIN - :COIN WHERE USER_ID = :USER_ID');
$stmt->bindValue(':USER_ID', $USER_ID, PDO::PARAM_STR);
$stmt->bindValue(':COIN', $COIN, PDO::PARAM_INT);
$stmt->execute();
//現在所持ポイントを取得
$stmt = $pdo->prepare("SELECT COIN FROM TEST_GAME where USER_ID = ?");
$stmt -> execute(array($USER_ID));
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	$nowPoint = $row["COIN"];
	break;
}
if($nowPoint<0){
$stmt = $pdo->prepare('UPDATE TEST_GAME SET COIN = 0 WHERE USER_ID = :USER_ID');
$stmt->bindValue(':USER_ID', $USER_ID, PDO::PARAM_STR);
$stmt->execute();
}

header('Content-Type: application/json');
echo json_encode( $COIN );

?>