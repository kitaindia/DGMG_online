<?php
	//セッション開始
	session_start();
if(!isset($_SESSION["id"]))
{
header("Location: ../index.php");
exit;
}
    $userName = $_SESSION["name"];
//PDO生成
$pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト', 'ユーザ名', 'パスワード');
$pdo->query('SET NAMES utf8');
//各ステータス値の取得
//-INT
$pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
$stmt = $pdo->query(" SELECT WORD FROM SYLDRA_WORD;");
$stmt->execute();
$INT=$stmt->rowCount();
//-INT(教えた言葉数)ランキング
$intRank = $pdo->query(" SELECT USER_NAME, COUNT(USER_NAME) FROM SYLDRA_WORD GROUP BY USER_NAME LIMIT 1,10;");
$intRank->execute();
//ID、PASSの入力を促すfunction
function inputIdPass(){
print<<<EOF
<br>
<text>「メンバーの人はIDとパスワードを教えてね。」</text><br>
<form action="checkMember.php" method="post">
<p>
IDは<input type="text" name="id" size="10">で、パスワードは<input type="password" name="password" size="10">だよ。
</p>
<input type="submit" value="答える" size="20">
</form>
EOF;
}
?>
<!DOCTYPE html>
<html lang="ja">
<html>
<head>
<meta charset="UTF-8">
<titleみんなで育てるシルドラくん</title>
<style type="text/css">
</style>　
<script type="text/javascript">
<!--
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-55630755-1', 'auto');
  ga('send', 'pageview');
// -->
</script>
<style type="text/css">
table { 
	border: 1px #808080 ridge; 
	width:400px;
}
body text{
	font-family:"メイリオ", sans-serif;
}
#dolist{
	margin :10px;
}
#status {
	margin: 0px 0px 0px 10px;
}
body {  
    text-align: center;  
    background-color:#e9e5f9;
}  
</style>
</head>
<body>
	<div id="header">
<?php include( $_SERVER['DOCUMENT_ROOT'] . '/dropDownMenu.php'); ?>
</div>
	<image src="http://syldra.secret.jp/image/sirudoraBorned.png" width="500px" height="300px" id="eggborn" border="0" style="margin:30px;"/><br><br>
	<p style="text-align: center;  "><text><?php if(!isset($userName)){inputIdPass();}else{echo "「".$userName."さんこんにちは。」";}?></text></p>
<form action="doList.php" method="post">
<div style="background-color:#e9e5f9;">
<label for="do"><text>何する？</text><text style="font-size:8px;">※★はメンバー限定だよ。</text></label>
<br>
<select name="do" id="dolist" size="2">
<option value="adventure" disabled>シルドラと冒険に出かける</option>
<option value="kotoba" selected>★シルドラに言葉を覚えさせる</option>
<option value="question">シルドラに質問する。</option>
</select>
<br>
<br>
<input type="submit" name="doButton" value="けってい">
</form>
<br>
<br>
<text>シルドラくんのステータス</text>
<CENTER>
<table id="statusTable" style="background-color:#e5f3f9;">
	<tbody>
		<tr>
			<td><text>ＨＰ</text></td>
			<td><text>？</text></td>
			<td><text>ＡＴＫ</text></td>
			<td><text>？</text></td>
			<td><text>ＩＮＴ</text></td>
			<td><text><?php echo $INT; ?></text></td>
			<td><text>ＡＧＩ</text></td>
			<td><text>？</text></td>
		</tr>
		<tr>
			<td><text>ＭＰ</text></td>
			<td><text>？</text></td>
			<td><text>ＤＥＦ</text></td>
			<td><text>？</text></td>
			<td><text>ＭＤＥ</text></td>
			<td><text>？</text></td>
			<td><text>ＬＵＫ</text></td>
			<td><text>？</text></td>
		</tr>
	</tbody>
</table>
<text>ランキング</text><br>
<text style="font-size:12px;">INT</text><br>
<table style="background-color:#e5f3f9;">
	<tbody>
<?php
$rankNum =1;
while($row = $intRank->fetch()){
			echo "<tr>";
			echo "<td>".$rankNum."位</td>";
			echo "<td>".$row[0]."さん</td>";
			echo "<td>".$row[1]."</td>";
			echo "</tr>";
			$rankNum++;
}
?>
	</tbody>
</table>
</CENTER>
<br>
</div>
</body>
</html>