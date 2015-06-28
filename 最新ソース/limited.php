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
if($_SESSION['page']=="bbs"){
header("Location: bbs.php");
}
if($_SESSION['page']=="members"){
header("Location: contact.php");
}
if($_SESSION['page'] == "gallery"){
header("Location: sample.php");
}
if($_SESSION['page'] == "photo"){
header("Location: PhotoContest/imgView.php");
}
if($_SESSION['page'] == "avatar"){
header("Location: http://syldra.secret.jp/avatar/main.php");
}
}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="ja">
<head>
<link rel="shortcut icon" href="image/favolite.ico"><!-- ////////// ƒtƒ@ƒrƒRƒ“ ////////// -->
<link rel="stylesheet" type="text/css" href="style.css"><!-- ////////// ƒXƒ^ƒCƒ‹ƒV[ƒg ////////// -->
<meta http-equiv="Content-Language" content="ja">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="ja">
<head>
<link rel="shortcut icon" href="image/favolite.ico"><!-- ////////// ƒtƒ@ƒrƒRƒ“ ////////// -->
<link rel="stylesheet" type="text/css" href="style.css"><!-- ////////// ƒXƒ^ƒCƒ‹ƒV[ƒg ////////// -->
<meta http-equiv="Content-Language" content="ja">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="content-language" content="ja">
<title>シルドラmenber'sWebSite&gt; MAIN</title><!-- ////////// ƒTƒCƒg–¼ ////////// -->
</head>
<body id="PAGETOP">
	<div id="header">
<?php include( $_SERVER['DOCUMENT_ROOT'] . '/dropDownMenu.php'); ?>
</div>
<center>
			<div style="text-align:center;"><img src="image/syldra.png"></div><br>
<form action="limited.php" method="post">
	<div style="text-align:center;">
ID<br>
<input type="text" name="id" style="width:100px;"><br>
PASSWORD<br><input type="password" name="password" style="width:100px;"><br>
<br>
<input type="submit" value="ENTER" style="width:100px;">
</form>
<br>
<p>閲覧を希望する方は<a href="confirm.php"><text style="color:red;">こちら</text></a>でアカウントを作成してください。</p>
</div><br>
<a href="index.html"><img src="image/back.png" alt="地図へ戻る" style="border:0;"></a>
		<ul class="PAGETOP">
			<li><a href="#PAGETOP" title="ƒy[ƒWƒgƒbƒv‚Ö–ß‚é">PAGETOP</a></li>
		</ul>
<div id="FOOTER">

		SITENAME | <a href="http://YOURSITE.URL/" target="_top">http://syldra.secret.jp/index.php</a>


</div><!-- #FOOTER /END -->

</div><!-- #CONTAINER /END -->
</center>
</body>
</html>