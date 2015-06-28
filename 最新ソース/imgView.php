<?php
session_start();
if(!isset($_SESSION["id"]))
{
$_SESSION['page'] = "photo";
header("Location: http://syldra.secret.jp/limited.php");
exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>みんなの撮ったスクリーンショット一覧</title>
<style type="text/css">
table { 
	border: 1px #808080 ridge; 
	width:400px;
}
#imgTr {
	height:100px;
}
#imgTd {
	text-align: center;
}
.photoinfo {
    font-family: "メイリオ", sans-serif;
    font-size:14px;
}
</style>
<center>
<body>
<a href="http://syldra.secret.jp/PhotoContest/imgup.php">■ スクリーンショットを投稿する ■</a>
<br>
<br>
画像をクリックすると原寸大で表示されます。
<br>
<?php
$pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト', 'ユーザ名', 'パスワード');
$pdo->query('SET NAMES utf8');
$stmt = $pdo->query("SELECT * FROM posts order by ID DESC");
    while($row = $stmt->fetch()) {
        echo '<table id="table">';
        echo '<tr>';
        echo '<td><text class="photoinfo">';
        echo '<a href="./imgContents.php?id='.$row[0].'" target="_blank">"'.$row[3].'"</a>';
        echo '</td>';
        echo '</tr>';
//撮影した人
        echo '<tr>';
        echo '<td><text class="photoinfo">';
        echo '撮影した人<br>'.$row[4];
        echo '</text></td>';
        echo '</tr>';
        echo '</table><br>';
    }
?>
<br>
<a href="http://syldra.secret.jp/index.html"><img src="http://syldra.secret.jp/image/back.png" alt="地図へ戻る" style="border:0;"></a>
</body>
</center>
</html>