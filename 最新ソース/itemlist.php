<?php
//DB接続
//データベース接続
$id = intval($_GET['id']);
$pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト名', 'ユーザー名', 'パスワード');
$pdo->query('SET NAMES utf8');
$stmt = $pdo->prepare("SELECT id,MINE, ITEM_IMG, ITEM_NAME, ITEM_YOMI, ITEM_COMMENT, ITEM_CATEGORY, ITEM_PRICE, ITEM_DATE
FROM MST_ITEMS WHERE  id=:id");
$stmt->bindParam(':id', $id);
$stmt->execute();
/* $contents_type = array(
     'jpg'  => 'image/jpeg',
     'jpeg' => 'image/jpeg',
     'png'  => 'image/png',
     'gif'  => 'image/gif',
     'bmp'  => 'image/bmp',
 );*/
$img = $stmt->fetchObject();
	//header("Content-type: ".$item->MINE);
	header("Content-type: image/png");
	echo $img->ITEM_IMG;
?>