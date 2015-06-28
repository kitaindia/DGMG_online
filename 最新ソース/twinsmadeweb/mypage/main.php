<?php
//セッション開始
session_start();
//セッションアウトによるリダイレクト
if(!isset($_SESSION["USER_ID"]))
{
header("Location: http://syldra.secret.jp/twinsmadeweb/index.php");
exit;
}
//*******USER_DETAILより各情報を取得する
$USER_ID= $_SESSION["USER_ID"];
    try {
$pdo = new PDO('mysql:host=mysql010.phy.lolipop.lan;dbname=LAA0535115-dbname;charset=utf8','ユーザ名','パスワード');
array(PDO::ATTR_EMULATE_PREPARES => false);
} catch (PDOException $e) {
 exit('データベース接続失敗。'.$e->getMessage());
}
$sql = 'SELECT * FROM USER_DETAIL WHERE USER_ID = :USER_ID';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':USER_ID',$USER_ID, PDO::PARAM_STR);
$stmt->execute();
while ($COLUMN = $stmt->fetch(PDO::FETCH_ASSOC)){
    $USER_NAME = $COLUMN["USER_NAME"];
    $USER_LEVEL = $COLUMN["USER_LEVEL"];
    $USER_COIN = $COLUMN["USER_COIN"];
    $USER_POINT = $COLUMN["USER_POINT"];
    $USER_COMMENT = $COLUMN["USER_COMMENT"];
    $USER_SEX = $COLUMN["USER_SEX"];
}
//*****AVATAR_USER_VISUALよりアバター情報を取得
$sql = 'SELECT * FROM AVATAR_USER_VISUAL WHERE USER_ID = :USER_ID';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':USER_ID',$USER_ID, PDO::PARAM_STR);
$stmt->execute();
while ($COLUMN = $stmt->fetch(PDO::FETCH_ASSOC)){
    $KAO = $COLUMN["KAO"];
    $HADA = $COLUMN["HADA"];
    $HUKU = $COLUMN["HUKU"];
    $KUTU = $COLUMN["KUTU"];
    $ACCESSORY = $COLUMN["ACCESSORY"];
    $KAMI= $COLUMN["KAMI"];
    $MOCHIMONO = $COLUMN["MOCHIMONO"];
    $BACKIMG = $COLUMN["BACKIMG"];
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>TWINS MADE　Web</title>
<link rel="stylesheet" type="text/css" href="mypage.css"  />
<link rel="stylesheet" type="text/css" href="http://syldra.secret.jp/twinsmadeweb/common/css/theme.css"  />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
<h1><?php echo $USER_NAME."のページ";?></h1>
<div id="main">
<div id="container">
<!-- 画像表示領域 -->
<div class="baseImg">
<img id="hadaImg" src="http://syldra.secret.jp/avatar/visual/hada/<?php echo $HADA?>.png">
<img id="kaoImg" src="http://syldra.secret.jp/avatar/visual/kao/<?php echo $KAO?>.png">
<img id="kamiImg" src="http://syldra.secret.jp/avatar/visual/kami/<?php echo $KAMI?>.png">
<img id="akuseImg" src="http://syldra.secret.jp/avatar/visual/akuse/<?php echo $ACCESSORY?>.png">
<img id="kutuImg" src="http://syldra.secret.jp/avatar/visual/kutu/<?php echo $KUTU?>.png">
<img id="hukuImg" src="http://syldra.secret.jp/avatar/visual/huku/<?php echo $HUKU?>.png">
<img id="mochimonoImg" src="http://syldra.secret.jp/avatar/visual/mochimono/<?php echo $MOCHIMONO?>.png">
<img id="backimgImg" src="http://syldra.secret.jp/avatar/visual/backimg/<?php echo $BACKIMG?>.png">
</div>
<!-- 画像表示領域ここまで -->
<!-- ユーザー情報表示領域 -->
<table id="infoTable">
<tbody>
<tr>
<td><font>なまえ</font></td>
<td><font><?php echo $USER_NAME?></font></td>
</tr>
<tr>
<td><font>性別</font></td>
<td><font>
<?php
if($USER_SEX==0){echo "おとこのこ";}
elseif($USER_SEX==1){echo "おんなのこ";}
elseif($USER_SEX==2){echo "ひみつ";}
else{echo "わからない";}
?>
</font></td>
</tr>
<tr>
<td><font>レベル</font></td>
<td><font>Lv<?php echo $USER_LEVEL?></font></td>
</tr>
<tr>
<td><font>持っている金貨</font></td>
<td><font><?php echo $USER_COIN?>枚</font></td>
</tr>
<tr>
<td><font>溜めたポイント</font></td>
<td><font><?php echo $USER_POINT?>ポイント</font></td>
</tr>
<tr>
<td><font>コメント</font></td>
<td><font><?php echo $USER_COMMENT?></font></td>
</tr>
</tbody>
</table>
<!-- ユーザー情報表示領域ここまで -->
</div>
<!-- コンテナーここまで -->
<!-- メニューボタン領域 -->
<div id="menuButton">
<section class="buttons"> 
<form method="post" action="editProf.php">
<input type="submit" name="editProfButton" value="プロフィール変更">
</form>
<form method="post" action="changeAvatar.php" target="_self">
<input type="submit" name="changeAvatarButton" value="着替える">
</form>
<form method="post" action="dressing.php">
<input type="submit" name="purchaseAvatarButton" value="アバターを購入">
</section> 
</div>
<!-- メニューボタン領域ここまで -->
</form>
</div>
</div>
</body>
</html>