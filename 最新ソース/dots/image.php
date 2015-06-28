<?php
$SUBJECT_ID = $_GET['SUBJECT_ID'];
try {
	$pdo = new PDO('mysql:host=mysql010.phy.lolipop.lan;dbname=LAA0535115-dbname;charset=utf8','ユーザー名','パスワード');
	array(PDO::ATTR_EMULATE_PREPARES => false);
} catch (PDOException $e) {
	exit('データベース接続失敗。'.$e->getMessage());
}
//画像の取得
$sql = 'SELECT IMAGE_DAT,MINETYPE FROM DOT_IMAGE WHERE SUBJECT_ID = :SUBJECT_ID';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':SUBJECT_ID',$SUBJECT_ID, PDO::PARAM_INT);
$stmt->execute();

if( $stmt ){
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		header( "Content-Type: ".$row['MINETYPE'] );
		echo $row['IMAGE_DAT'];
	}
}
?>