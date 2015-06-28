<?php
session_start();
//セッションアウトによるリダイレクト
if(!isset($_SESSION["USER_ID"]))
{
header("Location: http://syldra.secret.jp/twinsmadeweb/index.php");
exit;
}
//*******USER_DETAILより各情報を取得する
$USER_ID= $_SESSION["USER_ID"];
//データベース接続
$pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト', 'ユーザ名', 'パスワード');
$pdo->query('SET NAMES utf8');
//AVATAR_VISUALからUSER_IDで紐付け、各パーツ情報を取得
$sql = "SELECT * FROM AVATAR_USER_VISUAL WHERE USER_ID = :USER_ID";
$avatar_visual = $pdo->prepare($sql);
$avatar_visual->bindValue(':USER_ID',$USER_ID, PDO::PARAM_STR);
$avatar_visual->execute();
$avatar_visual_list = $avatar_visual->fetch(PDO::FETCH_NUM);
///顔
$kao = $avatar_visual_list[1];
///髪
$kami = $avatar_visual_list[2];
///服
$huku = $avatar_visual_list[3];
///アクセサリー
$akuse = $avatar_visual_list[4];
///靴
$kutu = $avatar_visual_list[5];
///持ち物
$mochimono = $avatar_visual_list[6];
///肌
$hada = $avatar_visual_list[7];
///背景
$backimg = $avatar_visual_list[8];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>TWINS MADE　Web</title>
<style TYPE="text/css">
.base {
    position: relative;
    width: 519px;
    height: 307px;
    float:left;
}
.base #hadaImg {
    position: absolute;
    width: 173px;
    height: 307px;
}
.base #kaoImg {
    position: absolute;
    width: 173px;
    height: 307px;
}
.base #kamiImg {
    position: absolute;
    width: 173px;
    height: 307px;
}
.base #akuseImg {
    position: absolute;
    width: 173px;
    height: 307px;
}
.base #kutuImg {
    position: absolute;
    width: 173px;
    height: 307px;
}
.base #hukuImg {
    position: absolute;
    width: 173px;
    height: 307px;
}
.base #mochimonoImg {
    position: absolute;
    width: 173px;
    height: 307px;
}
.base #backimgImg {
  position: absolute;
  width: 519px;
  height: 307px;
  z-index: -1;
}
</style>
<script type="text/javascript" src="http://syldra.secret.jp/twinsmadeweb/common/js/jquery-1.11.2.min.js
"></script>
<script>
$(function(){
  window.open('http://syldra.secret.jp/twinsmadeweb/mypage/view.php','width=500, height=500, location=no,menubar=no, toolbar=no, scrollbars=yes');
  });
</script>
</head>
<body>
<div class="base">
<img id="hadaImg" src="http://syldra.secret.jp/avatar/visual/hada/<?php echo $hada?>.png">
<img id="kaoImg" src="http://syldra.secret.jp/avatar/visual/kao/<?php echo $kao?>.png">
<img id="kamiImg" src="http://syldra.secret.jp/avatar/visual/kami/<?php echo $kami?>.png">
<img id="akuseImg" src="http://syldra.secret.jp/avatar/visual/akuse/<?php echo $akuse?>.png">
<img id="kutuImg" src="http://syldra.secret.jp/avatar/visual/kutu/<?php echo $kutu?>.png">
<img id="hukuImg" src="http://syldra.secret.jp/avatar/visual/huku/<?php echo $huku?>.png">
<img id="mochimonoImg" src="http://syldra.secret.jp/avatar/visual/mochimono/<?php echo $mochimono?>.png">
<img id="backimgImg" src="http://syldra.secret.jp/avatar/visual/backimg/<?php echo $backimg?>.png">
</div>
</body>
</html>