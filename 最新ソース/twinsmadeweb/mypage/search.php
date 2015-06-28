<html>
<head>
<meta charset="UTF-8">
<title>TWINS MADE　Web</title>
</head>
<script type="text/javascript" src="http://syldra.secret.jp/twinsmadeweb/common/js/jquery-1.11.2.min.js
"></script>
<script>

</script>
<body>
<form method="POST" action="view.php" target="_parent">
カテゴリー:
<select name="category" onchange="submit(this.form)">
<option value="all">全て</option>
<option value="hada">肌</option>
<option value="kao">顔</option>
<option value="kami">髪</option>
<option value="huku">服</option>
<option value="kutu">靴</option>
<option value="akuse">アクセサリー</option>
<option value="mochimono">持ち物</option>
</select><br>
アイテム名:
<input type="text" name="item_name" size="50" maxlength="128"><br>
表示順:
<select name="sort">
<option value="none">指定なし</option>
<option value="all">価格の安い順</option>
<option value="hada">価格の高い順</option>
<option value="kao">人気順</option>
</select>
</form>
</body>
</html>