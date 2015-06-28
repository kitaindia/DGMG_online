<?php
//各ユーザーの情報のリストを取得
$pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト名', 'ユーザー名', 'パスワード');
$pdo->query('SET NAMES utf8');
$memberVisuals = $pdo->query('SELECT * FROM AVATAR_USER_VISUAL INNER JOIN db_user ON AVATAR_USER_VISUAL.USER_ID = db_user.id ORDER BY FIELD(shokui, "ギルドマスター","サブマスター","メンバー","マネージャー"),FIELD(job, "メイジ","プリースト","ナイト","不明"),FIELD(seibetu, "♂","♀")');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>メンバー紹介</title>
<link rel="stylesheet" type="text/css" href="css/html5reset.css"  />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<style TYPE="text/css">
<!--
#submit_button{
float: left;
    background: -moz-linear-gradient(top, #fff, #e1e1e1 1%, #e1e1e1 50%, #cfcfcf 99%, #ccc);  
    background: -webkit-gradient(linear, left top, left bottom, from(#fff), color-stop(0.01, #e1e1e1), color-stop(0.5, #e1e1e1), color-stop(0.99, #cfcfcf), to(#ccc)); 
}
.base {
    position: relative;
    width: 173px;
    height: 307px;
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
#level{
	position: absolute;
    width: 45px;
    height: 45px;
}
#infoDisp {
	background-color: white;
	filter:alpha(opacity=50);
	-moz-opacity: 0.5;
	opacity: 0.5;
	width: 326px;
    height: 287px;
}
#avatarBackImg{
	background-image : url(../image/avatarBackImg.png);
	width: 519px;
    height: 307px;
}
#infoTable{
	background-color: white;
	filter:alpha(opacity=50);
	-moz-opacity: 0.5;
	opacity: 0.5;
	width: 326px;
    height: 287px;
}
-->
</style>
</head>
<body>
<div id="header">
<?php include( $_SERVER['DOCUMENT_ROOT'] . '/dropDownMenu.php'); ?>
</div>
<?php
while($row = $memberVisuals->fetch(PDO::FETCH_ASSOC)){
//値の取り出し
$name = $row["name"];
$job = $row["job"];
$comment = $row["comment"];
$seibetu = $row["seibetu"];
$shokui = $row["shokui"];
$sirudoru = $row["sirudoru"];
$kao = $row["KAO"];
$kami =$row["KAMI"];
$huku =$row["HUKU"];
$akuse =$row["ACCESSORY"];
$kutu =$row["KUTU"];
$mochimono =$row["MOCHIMONO"];
$hada =$row["HADA"];
echo "<center>";
echo "<br><br>";
echo "<div id=\"avatarBackImg\">";
echo "<table>";
echo "<tbody>";
echo "<tr>";
echo "<td>";
echo "<div class=\"base\"><img id=\"hadaImg\" src=\"http://syldra.secret.jp/avatar/visual/hada/";
echo $hada;
echo ".png\">";
echo "<img id=\"kaoImg\" src=\"http://syldra.secret.jp/avatar/visual/kao/";
echo $kao;
echo ".png\">";
echo "<img id=\"kamiImg\" src=\"http://syldra.secret.jp/avatar/visual/kami/";
echo $kami;
echo ".png\">";
echo "<img id=\"akuseImg\" src=\"http://syldra.secret.jp/avatar/visual/akuse/";
echo $akuse;
echo ".png\">";
echo "<img id=\"kutuImg\" src=\"http://syldra.secret.jp/avatar/visual/kutu/";
echo $kutu;
echo ".png\">";
echo "<img id=\"hukuImg\" src=\"http://syldra.secret.jp/avatar/visual/huku/";
echo $huku;
echo ".png\">";
echo "<img id=\"mochimonoImg\" src=\"http://syldra.secret.jp/avatar/visual/mochimono/";
echo $mochimono;
echo ".png\">";
echo "<div id=\"level\">レベル<br>９９</div>";
echo "</div>";
echo "<td/>";
echo "<td>";
// echo "<div id=\"infoDisp\">";
//メンバーの情報表示
echo "<table id=\"infoTable\">";
echo	"<tbody>";
echo		"<tr>";
echo			"<td>職位</td>";
echo			"<td>".$shokui."</td>";
echo		"</tr>";
echo		"<tr>";
echo			"<td>なまえ</td>";
echo			"<td>".$name."</td>";
echo		"</tr>";
echo		"<tr>";
echo			"<td>性別</td>";
echo			"<td>".$seibetu."</td>";
echo		"</tr>";
echo		"<tr>";
echo			"<td>職業</td>";
echo			"<td>".$job."</td>";
echo		"</tr>";
echo		"<tr>";
echo			"<td>金貨</td>";
echo			"<td>".$sirudoru."枚</td>";
echo		"</tr>";
echo		"<tr>";
echo		"<td colspan=\"2\">自己紹介</td>";
echo		"</tr>";
echo		"<tr>";
echo		"<td colspan=\"2\">".$comment."</td>";
echo		"</tr>";
echo	"</tbody>";
echo "</table>";
echo "</div>";
//  "<td/>";
echo "</tr>";
echo "</tbody>";
echo "</table>";
echo "</div>";
echo "</center>";
}
?>
</body>
</html>