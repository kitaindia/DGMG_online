<?php
//セッション開始
session_start();
if(!isset($_SESSION["id"]))
//Case セッション破棄
{
header("Location: /index.php");
exit;
}
//積み立てポイントを取得
$totalPoint = $_POST['totalPoint'];
//DB接続
$pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト名', 'ユーザー名', 'パスワード');
$pdo->query('SET NAMES utf8');
//ID取得
$USER_ID = $_SESSION['id'];
//所持ポイントを更新
$stmt = $pdo->prepare('UPDATE TEST_GAME SET POINTS = POINTS + :POINTS WHERE USER_ID = :USER_ID');
$stmt->bindValue(':USER_ID', $USER_ID, PDO::PARAM_STR);
$stmt->bindValue(':POINTS', $totalPoint, PDO::PARAM_INT);
$stmt->execute();
//所持ポイントを取得
$sql = "SELECT POINTS FROM TEST_GAME WHERE USER_ID = :USER_ID";
$point = $pdo->prepare($sql);
$point->bindValue(':USER_ID',$USER_ID, PDO::PARAM_STR);
$point->execute();
$currentPoint = $point->fetch(PDO::FETCH_NUM);
$possePoint = $currentPoint[0];
//JSON形式で出力する
header('Content-Type: application/json');
echo json_encode($possePoint);
?>