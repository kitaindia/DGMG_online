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
.error {
    font-family: "メイリオ", sans-serif;
    font-size:14px;
}
</style>
<center>
<body>
<text class="error">前回の投稿から12時間以上経過する必要があります。</text>
<br>
<br>
<a href="ihttp://syldra.secret.jp/PhotoContest/imgView.php">スクリーンショット一覧に戻る</a>
<br>
<br>
</body>
</center>
</html>