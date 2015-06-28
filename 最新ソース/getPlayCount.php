<?php
//セッション開始
session_start();
//初回プレイ（セッションがセットされてない）場合...
//あるいは10回目の場合...
if(!isset($_SESSION["playCount"])or$_SESSION["playCount"]==10)
{	//カウントを１に設定
	$_SESSION["playCount"]= 1;
}
//それ以外の場合...
else
{
	//カウントをプラス１する
	$_SESSION["playCount"]++;
}
$playCount = $_SESSION["playCount"];
//TurnTheSyldra.phpにカウント数を返す
header('Content-Type: application/json');
echo json_encode($playCount);
?>
