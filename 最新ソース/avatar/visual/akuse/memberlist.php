<?php
session_start();
//各ユーザーの情報のリストを取得
$pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト名', 'ユーザー名', 'パスワード');
$pdo->query('SET NAMES utf8');
$memberVisuals = $pdo->query('SELECT * FROM AVATAR_USER_VISUAL INNER JOIN db_user ON AVATAR_USER_VISUAL.USER_ID = db_user.id ORDER BY FIELD(shokui, "ギルドマスター","サブマスター","メンバー","マネージャー"),FIELD(job, "メイジ","プリースト","ナイト","不明"),FIELD(seibetu, "♂","♀")');

$user_id_for_comment = $_SESSION["id"];
$sql = 'SELECT comment FROM db_user WHERE id = :USER_ID';
$stmt1 = $pdo->prepare($sql);
$stmt1->bindValue(':USER_ID',$user_id_for_comment,PDO::PARAM_STR);
$stmt1->execute();
$row = $stmt1->fetch(PDO::FETCH_ASSOC);
$commentForEdit = $row["comment"];
//====================================
$name = $row["name"];
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
body {
     margin:0px;          /* ページ全体のmargin */
     padding:0px;         /* ページ全体のpadding */
     text-align:center;   /* 下記のautoに未対応用のセンタリング */
    }
#main {
    margin-left: auto;   /* 左側マージンを自動的に空ける */
    margin-right: auto;  /* 右側マージンを自動的に空ける */
    text-align: left;    /* 中身を左側表示に戻す */
    width: 1060px; /* container の幅を530pxと見なしておく。そのため2列になる */
}

div.container { 
    position: relative;
    margin: 5px;
    width: 520px;
    height: 307px;
    float: left; /* 次のdivが右に来るように指定してる。#mainの幅とcontainerの幅で列数が決まる。溢れたら下に来る */
}
 /** div#info_right {  
    position:absolute;  
    right:0;  
    top:0;   
    margin:25px 25px 25px;
}  
**/
.infoTable{ 
    position:absolute;  
    right:0;  
    top:0;   
    margin:25px 25px 25px;
    width: 300px;
    height: 257px;
    background-color: white;
    filter:alpha(opacity=50);
    -moz-opacity: 0.5; /* Firefox 3.5以降では無効なので削除推奨 */
    opacity: 0.5;
}
#hadaImg {
    position: absolute;
    width: 173px;
    height: 307px;
}
#kaoImg {
    position: absolute;
    width: 173px;
    height: 307px;
}
#kamiImg {
    position: absolute;
    width: 173px;
    height: 307px;
}
#akuseImg {
    position: absolute;
    width: 173px;
    height: 307px;
}
#kutuImg {
    position: absolute;
    width: 173px;
    height: 307px;
}
#hukuImg {
    position: absolute;
    width: 173px;
    height: 307px;
}
#mochimonoImg {
    position: absolute;
    width: 173px;
    height: 307px;
}
#backimgImg {
    position: absolute;
    width: 519px;
    height: 307px;
    z-index: -1;
}

font{
    text-shadow: white 0 -2px;
    font-weight: bold; 
}  
-->
</style>
</head>
<body>
<div id="header">
<?php include( $_SERVER['DOCUMENT_ROOT'] . '/dropDownMenu.php'); ?>
</div>
<div id="main">
<?php
echo "<form action=\"editProf.php\" method=\"post\">";
echo "自己紹介文を編集できます。<br>";
echo "<textarea name=\"editedProf\" rows=\"4\" cols=\"40\" maxlength=\"100\">".$commentForEdit."</textarea><br>";
echo "<input type=\"submit\" value=\"編集する\"><br>";
echo "</form>";
while($row = $memberVisuals->fetch(PDO::FETCH_ASSOC)){
//値の取り出し
//====================================
//...その前にidでTEST_GAMEからポイントを取得しちゃう
$sql = 'SELECT POINTS FROM TEST_GAME WHERE USER_ID = :USER_ID';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':USER_ID',$row["id"],PDO::PARAM_STR);
$stmt->execute();
$pointrow = $stmt->fetch(PDO::FETCH_ASSOC);
$totalPoint = $pointrow["POINTS"];
//====================================
$name = $row["name"];
$job = $row["job"];
$comment = $row["comment"];
$seibetu = $row["seibetu"];
$shokui = $row["shokui"];
$sirudoru = $row["sirudoru"];
if($name==="サリサ"){
$sirudoru = 0;
}
$kao = $row["KAO"];
$kami =$row["KAMI"];
$huku =$row["HUKU"];
$akuse =$row["ACCESSORY"];
$kutu =$row["KUTU"];
$mochimono =$row["MOCHIMONO"];
$hada =$row["HADA"];
$backimg =$row["BACKIMG"];
//コンテナー
echo "<div class=\"container\">";
//画像データのDIV（左寄せ）
echo "<div class=\"imgs_left\">";
//画像データの配置
echo "<img id=\"hadaImg\" src=\"http://syldra.secret.jp/avatar/visual/hada/";
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
echo "<img id=\"backimgImg\" src=\"http://syldra.secret.jp/avatar/visual/backimg/";
echo $backimg;
echo ".png\">";
//画像データのDIVここまで
echo "</div>";
//ユーザー情報のDIV(右寄せ)
//echo "<div id=\"info_right\">";
echo "<table class=\"infoTable\">";
echo    "<tbody>";
echo        "<tr>";
echo            "<td><font>職位</font></td>";
echo            "<td><font>".$shokui."</font></td>";
echo        "</tr>";
echo        "<tr>";
echo            "<td><font>なまえ</font></td>";
echo            "<td><font>".$name."</font></td>";
echo        "</tr>";
echo        "<tr>";
echo            "<td><font>性別</font></td>";
echo            "<td><font>".$seibetu."</font></td>";
echo        "</tr>";
echo        "<tr>";
echo            "<td><font>職業</font></td>";
echo            "<td><font>".$job."</font></td>";
echo        "</tr>";
echo        "<tr>";
echo            "<td><font>金貨/ポイント</font></td>";
echo            "<td><font>".$sirudoru."枚/".$totalPoint."PT</font></td>";
echo        "</tr>";
echo        "<tr>";
echo        "<td colspan=\"2\"><font>自己紹介</font></td>";
echo        "</tr>";
echo        "<tr>";
echo        "<td colspan=\"2\"><font>".$comment."</font></td>";
echo        "</tr>";
echo    "</tbody>";
echo "</table>";
//ユーザー情報のDIVここまで
//echo "</div>";
//コンテナーDIVここまで
echo "</div>";
}
?>
</div>
</body>
</html>