<?php
session_start();
$id =$_POST["id"];
	$pass = $_POST["password"];
$link = mysql_connect('mysql010.phy.lolipop.lan', 'ユーザ名','パスワード');
if (!$link) {
    die('接続失敗です。'.mysql_error());
}
$db_selected = mysql_select_db('LAA0535115-dbname', $link);
if (!$db_selected){
    die('データベース選択失敗です。'.mysql_error());
}
mysql_set_charset('utf8');
$result = mysql_query('SELECT * FROM db_user');
if (!$result) {
    die('クエリーが失敗しました。'.mysql_error());
}
while ($row = mysql_fetch_assoc($result)) {
  if($id == $row['id'] && $pass == $row['pass']){
  	$_SESSION["name"] = $row['name'];
  	$_SESSION["id"] = $row['id'];
  	header("Location: http://syldra.secret.jp/BringUpSyldra/main.php");
}
}
header("Location: http://syldra.secret.jp/BringUpSyldra/main.php");
?>