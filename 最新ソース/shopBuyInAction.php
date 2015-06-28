<?php
//カテゴリー/アイテム名//読み/価格/入荷数の読み込み
$category = $_POST['category'];
$name = $_POST['name'];
$yomi = $_POST['yomi'];
$price =$_POST['price'];
$comment =$_POST['comment'];
$date = date("Ymd");

//画像データの読み込み
if($_FILES['imagefile']['error'])
{
	exit;
}

$mime = $_FILES['imagefile']['type'];//mime type
$path = $_FILES['imagefile']['tmp_name'];//uploaded file

if($mime=='image/pjpeg'){$mime='image/jpeg';}
if($mime=='image/x-png'){$mime='image/png';}

if(is_uploaded_file($path))
{
$mime = addslashes($mime);
$data = addslashes(file_get_contents($path));//一時ファイルの読み込み
//DB接続
$pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト', 'ユーザ名', 'パスワード');
$pdo->query('SET NAMES utf8');
$updItems = $pdo -> prepare("INSERT INTO MST_ITEMS (MINE,ITEM_IMG,ITEM_NAME,ITEM_COMMENT,ITEM_YOMI,ITEM_CATEGORY,ITEM_PRICE,ITEM_DATE) VALUES ('$mime','$data','$name','$comment',$yomi','$category','$price','$date')");
$updItems ->execute();
echo $comment;
echo $name;
echo $yomi;
echo $price;
echo $date;
echo $mime;
echo $path;
echo $data;
}
?>