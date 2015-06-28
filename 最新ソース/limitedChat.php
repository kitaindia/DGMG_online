<?php
session_start();
	$_SESSION["id"] = $_POST["id"];
	$_SESSION["password"] = $_POST["password"];
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
$_SESSION['name']=$row['name'];
if($_SESSION['page']=="chat"){
header("Location: ChatDisp.php");
}
}
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>チャットログイン画面</title>
<link rel="stylesheet" type="text/css" href="css/html5reset.css"  />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
<center>
<form action="limitedChat.php" method="post">
ID<br>
<input type="text" name="id" style="width:100px;"><br>
PASSWORD<br><input type="password" name="password" style="width:100px;"><br>
<br>
<input type="submit" value="ENTER" style="width:100px;">
</form>
</center>
</body>
</html>