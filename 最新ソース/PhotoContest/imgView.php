<?php
session_start();

if($_SESSION['guildmember']==0)
{
header("Location: ../index.php");
exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>みんなの撮ったスクリーンショット一覧</title>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-55630755-1', 'auto');
  ga('send', 'pageview');

</script>
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
<body>
<div id="header">
<?php include( $_SERVER['DOCUMENT_ROOT'] . '/dropDownMenu.php'); ?>
</div>
<center>
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
        //リンク
        echo '<table id="table">';
        echo '<tr>';
        echo '<td><text class="photoinfo">';
        echo '<a href="./imgContents.php?id='.$row[0].'" target="_blank"><img src="http://syldra.secret.jp/image/photo.png"></a>';
        echo '</td>';
        echo '</tr>';
        //コメント
        echo '<tr>';
        echo '<td><text class="photoinfo">';
        echo $row[3];
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
</body>
</center>
</html>