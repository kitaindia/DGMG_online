<?php
//IDセッション無し→一般向けリミテーション
session_start();

if(!isset($_SESSION["id"]))
{
header("Location: ../top.php");
exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<html>
<head>
<meta charset="UTF-8">
<titleみんなで育てるシルドラくん</title>
<style type="text/css">
body {  
    text-align: center;  
    background-color:#e9e5f9;
}  
body text{
	font-family:"メイリオ", sans-serif;
}
</style>　
<script type="text/javascript">
<!--
// -->
</script>
</head>
<body>
	<image src="http://syldra.secret.jp/image/sirudoraBorned.png" width="500px" height="300px" id="eggborn" border="0" style="margin:30px;"/><br><br>
<form action="selectQuestion.php" method="post">
<label for="syurui"><text>「何が聞きたいの？」</text></label>
<br>
<select id="syurui" name="syurui">
<option value="chosi">最近の調子はどう？</option>
<option value="want1">いま何が欲しい？</option>
<option value="want2">いま何がしたい？</option>
<option value="yume">将来の夢は？</option>
<option value="silent">黙って様子をうかがう</option>
</select>
<br>
<br>
<input type="submit" name="kotobaButton" value="たずねる">
</form>
<br>
<br>
<a href="http://syldra.secret.jp/BringUpSyldra/main.php" style="border:0;">シルドラくんトップに戻る</a>
<br>
<br>
</body>
</html>