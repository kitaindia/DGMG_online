<?php 
  session_start();
$updcom = $_POST['updcom'];
$id = $_SESSION["id"];
$link = mysql_connect('mysql010.phy.lolipop.lan','ユーザ名','パスワード');
if (!$link) {
    die('接続失敗です。'.mysql_error());
}
$db_selected = mysql_select_db('LAA0535115-dbname',$link);
if (!$db_selected){
    die('データベース選択失敗です。'.mysql_error());
}
mysql_set_charset('utf8');

$result = mysql_query("UPDATE db_user SET comment = '$updcom' WHERE id = '$id'");
if (!$result) {
    die('クエリーが失敗しました。'.mysql_error());
}
header("Location: contact.php");
exit();
?>