<?php
//SESSIONでUSER_IDを取得
$USER_ID = "TEST_ID";
//SUBJECT_IDの取得
$SUBJECT_ID = $_POST["SUBJECT_ID"];
//日時を取得
$DOTTED_DATE = date("Y/m/d");
//POSTでXY座標を取得
$POSITION_X = $_POST["POSITION_X"];
$POSITION_Y = $_POST["POSITION_Y"];
//XY座標をDOT_DOTS_POSITIONに登録
try {
	$pdo = new PDO('mysql:host=mysql010.phy.lolipop.lan;dbname=LAA0535115-dbname;charset=utf8','ユーザ名','パスワード');
	array(PDO::ATTR_EMULATE_PREPARES => false);
} catch (PDOException $e) {
	exit('データベース接続失敗。'.$e->getMessage());
}
$stmt = $pdo->prepare("INSERT INTO DOT_DOTS_POSITION (SUBJECT_ID,POSITION_X,POSITION_Y,USER_ID,DOTTED_DATE)
	VALUES (:SUBJECT_ID,:POSITION_X,:POSITION_Y,:USER_ID,:DOTTED_DATE)");
$stmt->bindValue(':SUBJECT_ID', $SUBJECT_ID, PDO::PARAM_INT);
$stmt->bindValue(':POSITION_X', $POSITION_X, PDO::PARAM_INT);
$stmt->bindValue(':POSITION_Y', $POSITION_Y, PDO::PARAM_INT);
$stmt->bindValue(':USER_ID', $USER_ID, PDO::PARAM_STR);
$stmt->bindValue(':DOTTED_DATE', $DOTTED_DATE, PDO::PARAM_STR);
$stmt->execute();
header('Content-Type: application/json; charset=utf-8');
echo json_encode($stmt);
?>