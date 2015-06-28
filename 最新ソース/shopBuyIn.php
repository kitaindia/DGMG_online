<?php
header("Content-Type: text/html; charset=UTF-8");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>商品アップページ</title>
</head>
<body>
<form method='post' enctype='multipart/form-data' action='shopBuyInAction.php' accept-charset="UTF-8">
<input type='hidden' name='MAX_FILE_SIZE' value='最大バイト数'>
<input type='file' name='imagefile'>
<br>
カテゴリー<select name='category'>
	<option value='インテリア'>インテリア</option>
	<option value='冒険アイテム'>冒険アイテム</option>
	<option value='ペット'>ペット</option>
	<option value='クレヨン'>クレヨン</option>
	<option value='その他'>その他</option>
</select><br>
アイテム名:<input type="text" name="name"><br>
読み方（半角カナ）：<input type="text" name="yomi"><br>
コメント:<textarea name="comment"></textarea><br>
価格<input type="text" name="price">（シル$）<br>
<input type='submit' name='upload' value='アップロード'>
</form>
</body>
</html>