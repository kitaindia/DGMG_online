<?php
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
//現在所持ポイントを取得
$stmt = $pdo->prepare("SELECT COIN FROM TEST_GAME where USER_ID = ?");
$stmt -> execute(array($USER_ID));
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	$nowPoint = $row["COIN"];
	break;
}
//返す
header('Content-Type: application/json');
echo json_encode( $nowPoint );
?>