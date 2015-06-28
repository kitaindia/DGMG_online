<?php

session_start();

if(!isset($_SESSION["id"]))
{
$_SESSION['page'] = "photo";
header("Location: limited.php");
exit;
}
?>
<html>
<head>
<style type="text/css">
#comment {
	width: 300px;
	height: 7em;
}
</style>
<meta charset="UTF-8">
<title>スクリーンショット投稿ページ</title>
</head>
<body>
<form enctype="multipart/form-data" action="./imgupAction.php" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
    <input name="image" type="file" />
    <br>※１　15000キロバイトくらいまでで、出来るだけ軽いサイズでお願いします<（　　）>。
    <br>※２　利用可能な拡張子は jpg　jpeg gif png です。
<br><br>
スクリーンショットについてのコメント:<input id="comment" type="textarea" name="title"><br>
<input type="hidden" name="userName" value="<?php echo $_SESSION['name'];?>">
<p><input type="submit" name="save" value="投稿する" /><p>
</form>
<br>
<br>
<a href="ihttp://syldra.secret.jp/PhotoContest/imgView.php">スクリーンショット一覧に戻る</a>
<br>
<br>
<a href="http://syldra.secret.jp/index.html"><img src="http://syldra.secret.jp/image/back.png" alt="地図へ戻る" style="border:0;"></a>
</body>
</html>