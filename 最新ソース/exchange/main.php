<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ポイント換金所く</title>
<style type="text/css">
#execute{
	background-color:#adff2f;
	width:80px;
	height:40px;
	text-align:center;
	line-height:40px;
}
</style>
<link rel="stylesheet" type="text/css" href="css/html5reset.css"  />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script type="text/javascript">
$(document).ready(function(){
$('[name=point]').change(function() {
    // 選択されているポイントを取り出す
    var point = $('[name=point]').val();
    var coin = point/100;
    $("p#result").text(point+"ポイントで"+coin+"枚の金貨と交換できます。");
});
});
	</script>
</head>
<body>
<div id="header">
<?php include( $_SERVER['DOCUMENT_ROOT'] . '/dropDownMenu.php'); ?>
</div>
<br>
<form action="execute.php" method="POST">
<label for="point">両替するポイントを選択してください：</label>
<select id="point" name="point">
<option value="100" selected>100pt</option>
<option value="200">200pt</option>
<option value="300">300pt</option>
<option value="400">400pt</option>
<option value="500">500pt</option>
<option value="600">600pt</option>
<option value="700">700pt</option>
<option value="800">800pt</option>
<option value="900">900pt</option>
<option value="1000">1000pt</option>
</select>
<br>
<p id="result">100ポイントで1枚の金貨と交換できます。<p>
<input type="submit" value="交換する">
</form>
<br>
<a href="http://syldra.secret.jp/index.php">トップページに戻る。</a>
</body>
</html>