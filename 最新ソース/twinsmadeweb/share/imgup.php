<?php

session_start();

if($_SESSION['guildmember']==0)
{
header("Location: ../index.php");
exit;
}
?>
<html>
<head>
<style type="text/css">
</style>
<meta charset="UTF-8">
<title>スクリーンショット投稿ページ</title>
</head>
<body>
<div id="header">
<?php include( $_SERVER['DOCUMENT_ROOT'] . '/dropDownMenu.php'); ?>
</div>
<form enctype="multipart/form-data" action="./imgupAction.php" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
    <input name="image" type="file" />
    <br>※１　15000キロバイトくらいまでで、出来るだけ軽いサイズでお願いします<（　　）>。
    <br>※２　利用可能な拡張子は jpg　jpeg gif png です。
<br><br>
スクリーンショットについてのコメント<br><textarea rows=6 cols=30 id="comment" name="title">
</textarea><br>
<input type="hidden" name="userName" value="<?php echo $_SESSION['name'];?>">
<p><input type="submit" name="save" value="投稿する" /><p>
</form>
<br>
<br>
<a href="ihttp://syldra.secret.jp/PhotoContest/imgView.php">スクリーンショット一覧に戻る</a>
<br>
</body>
</html>