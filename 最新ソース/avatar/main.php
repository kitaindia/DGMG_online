<?php
//IDセッション無し→一般向けリミテーション
session_start();

if(!isset($_SESSION["id"]))
{
header("Location: ../index.php");
exit;
}
//USER_IDの取得
$user_id = $_SESSION["id"];
//データベース接続
$pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=mysql010.phy.lolipop.lan', 'ユーザ名', 'パスワード');
$pdo->query('SET NAMES utf8');
//AVATAR_VISUALからUSER_IDで紐付け、各パーツ情報を取得
$sql = "SELECT * FROM AVATAR_USER_VISUAL WHERE USER_ID = :USER_ID";
$avatar_visual = $pdo->prepare($sql);
$avatar_visual->bindValue(':USER_ID',$user_id, PDO::PARAM_STR);
$avatar_visual->execute();
$count=$avatar_visual->rowCount();
$avatar_visual_list = $avatar_visual->fetch(PDO::FETCH_NUM);
if($count==0){
///顔
$kao = "hohoemi";
///髪
$kami = "short_darkbrown";
///服
$huku = "default_tshirt";
///アクセサリー
$akuse = "noimg";
///靴
$kutu = "default_kutu";
///持ち物
$mochimono = "default_map";
///肌
$hada = "hada_akarume";
///背景
$backimg = "default_backimg";
//デフォルトをAVATAR_USER_VISUALにセット
    $stmt0 = $pdo->prepare('INSERT INTO AVATAR_USER_VISUAL(USER_ID, KAO, KAMI, HUKU, ACCESSORY, KUTU, MOCHIMONO, HADA, BACKIMG) VALUES (:id,:kao,:kami,:huku,:akuse,:kutu,:mochimono,:hada,:backimg)');
    $stmt0->bindParam(':id', $user_id, PDO::PARAM_STR);
    $stmt0->bindParam(':kao', $kao, PDO::PARAM_STR);
    $stmt0->bindParam(':kami', $kami, PDO::PARAM_STR);
    $stmt0->bindParam(':hada', $hada, PDO::PARAM_STR);
    $stmt0->bindParam(':huku', $huku, PDO::PARAM_STR);
    $stmt0->bindParam(':kutu', $kutu, PDO::PARAM_STR);
    $stmt0->bindParam(':akuse', $akuse, PDO::PARAM_STR);
    $stmt0->bindParam(':mochimono', $mochimono, PDO::PARAM_STR);
    $stmt0->bindParam(':backimg', $backimg, PDO::PARAM_STR);
    $stmt0->execute();
//デフォルトをAVATAR_USER_BELONGINGSにセット
    $stmt1 = $pdo->prepare('INSERT INTO AVATAR_USER_BELONGINGS(USER_ID, VALUE, PARTS_NAME, PARTS_CATEGORY) VALUES (:id,:VALUE,:NAME,:CATE)');
    $stmt1->bindParam(':id', $user_id, PDO::PARAM_STR);
    $stmt1->bindParam(':VALUE', $hada, PDO::PARAM_STR);
    $n = "明るめの肌";
    $c = "hada";
    $stmt1->bindParam(':NAME', $n, PDO::PARAM_STR);
    $stmt1->bindParam(':CATE', $c, PDO::PARAM_STR);
    $stmt1->execute();

        $stmt2 = $pdo->prepare('INSERT INTO AVATAR_USER_BELONGINGS(USER_ID, VALUE, PARTS_NAME, PARTS_CATEGORY) VALUES (:id,:VALUE,:NAME,:CATE)');
    $stmt2->bindParam(':id', $user_id, PDO::PARAM_STR);
    $stmt2->bindParam(':VALUE', $kao, PDO::PARAM_STR);
        $n = "微笑んでる";
    $c = "kao";
    $stmt2->bindParam(':NAME', $n, PDO::PARAM_STR);
    $stmt2->bindParam(':CATE', $c, PDO::PARAM_STR);
    $stmt2->execute();

        $stmt3 = $pdo->prepare('INSERT INTO AVATAR_USER_BELONGINGS(USER_ID, VALUE, PARTS_NAME, PARTS_CATEGORY) VALUES (:id,:VALUE,:NAME,:CATE)');
    $stmt3->bindParam(':id', $user_id, PDO::PARAM_STR);
    $stmt3->bindParam(':VALUE', $huku, PDO::PARAM_STR);
        $n = "白いTシャツ";
    $c = "huku";
    $stmt3->bindParam(':NAME', $n, PDO::PARAM_STR);
    $stmt3->bindParam(':CATE', $c, PDO::PARAM_STR);
    $stmt3->execute();

        $stmt4 = $pdo->prepare('INSERT INTO AVATAR_USER_BELONGINGS(USER_ID, VALUE, PARTS_NAME, PARTS_CATEGORY) VALUES (:id,:VALUE,:NAME,:CATE)');
    $stmt4->bindParam(':id', $user_id, PDO::PARAM_STR);
    $stmt4->bindParam(':VALUE', $kutu, PDO::PARAM_STR);
        $n = "白い靴";
    $c = "kutu";
    $stmt4->bindParam(':NAME', $n, PDO::PARAM_STR);
    $stmt4->bindParam(':CATE', $c, PDO::PARAM_STR);
    $stmt4->execute();

        $stmt5 = $pdo->prepare('INSERT INTO AVATAR_USER_BELONGINGS(USER_ID, VALUE, PARTS_NAME, PARTS_CATEGORY) VALUES (:id,:VALUE,:NAME,:CATE)');
    $stmt5->bindParam(':id', $user_id, PDO::PARAM_STR);
    $stmt5->bindParam(':VALUE', $akuse, PDO::PARAM_STR);
        $n = "なし";
    $c = "akuse";
    $stmt5->bindParam(':NAME', $n, PDO::PARAM_STR);
    $stmt5->bindParam(':CATE', $c, PDO::PARAM_STR);
    $stmt5->execute();

            $stmt6 = $pdo->prepare('INSERT INTO AVATAR_USER_BELONGINGS(USER_ID, VALUE, PARTS_NAME, PARTS_CATEGORY) VALUES (:id,:VALUE,:NAME,:CATE)');
    $stmt6->bindParam(':id', $user_id, PDO::PARAM_STR);
    $stmt6->bindParam(':VALUE', $mochimono, PDO::PARAM_STR);
        $n = "丸めた地図";
    $c = "mochimono";
    $stmt6->bindParam(':NAME', $n, PDO::PARAM_STR);
    $stmt6->bindParam(':CATE', $c, PDO::PARAM_STR);
    $stmt6->execute();

                $stmt7 = $pdo->prepare('INSERT INTO AVATAR_USER_BELONGINGS(USER_ID, VALUE, PARTS_NAME, PARTS_CATEGORY) VALUES (:id,:VALUE,:NAME,:CATE)');
    $stmt7->bindParam(':id', $user_id, PDO::PARAM_STR);
    $stmt7->bindParam(':VALUE', $kami, PDO::PARAM_STR);
        $n = "セミショート(黒)";
    $c = "kami";
    $stmt7->bindParam(':NAME', $n, PDO::PARAM_STR);
    $stmt7->bindParam(':CATE', $c, PDO::PARAM_STR);
    $stmt7->execute();

                    $stmt7 = $pdo->prepare('INSERT INTO AVATAR_USER_BELONGINGS(USER_ID, VALUE, PARTS_NAME, PARTS_CATEGORY) VALUES (:id,:VALUE,:NAME,:CATE)');
    $stmt7->bindParam(':id', $user_id, PDO::PARAM_STR);
    $stmt7->bindParam(':VALUE', $backimg, PDO::PARAM_STR);
        $n = "背景（ノーマル）";
    $c = "backimg";
    $stmt7->bindParam(':NAME', $n, PDO::PARAM_STR);
    $stmt7->bindParam(':CATE', $c, PDO::PARAM_STR);
    $stmt7->execute();

}else{
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
//背景
$backimg = $avatar_visual_list[8];
}
//AVATAR_VISUAL_BELONGINGSからUSER_IDで紐付け、使用可能アバターパーツのリストを取得
$sql = "SELECT * FROM AVATAR_USER_BELONGINGS WHERE USER_ID = :USER_ID AND PARTS_CATEGORY = :PARTS_CATEGORY";
//顔
$avatar_user_belongings_kao = $pdo->prepare($sql);
$avatar_user_belongings_kao->bindValue(':USER_ID',$user_id, PDO::PARAM_STR);
$avatar_user_belongings_kao->bindValue(':PARTS_CATEGORY','kao', PDO::PARAM_STR);
$avatar_user_belongings_kao->execute();
//肌色
$avatar_user_belongings_hada = $pdo->prepare($sql);
$avatar_user_belongings_hada->bindValue(':USER_ID',$user_id, PDO::PARAM_STR);
$avatar_user_belongings_hada->bindValue(':PARTS_CATEGORY','hada', PDO::PARAM_STR);
$avatar_user_belongings_hada->execute();
//髪型
$avatar_user_belongings_kami = $pdo->prepare($sql);
$avatar_user_belongings_kami->bindValue(':USER_ID',$user_id, PDO::PARAM_STR);
$avatar_user_belongings_kami->bindValue(':PARTS_CATEGORY','kami', PDO::PARAM_STR);
$avatar_user_belongings_kami->execute();
//服
$avatar_user_belongings_huku = $pdo->prepare($sql);
$avatar_user_belongings_huku->bindValue(':USER_ID',$user_id, PDO::PARAM_STR);
$avatar_user_belongings_huku->bindValue(':PARTS_CATEGORY','huku', PDO::PARAM_STR);
$avatar_user_belongings_huku->execute();
//アクセサリー
$avatar_user_belongings_akuse = $pdo->prepare($sql);
$avatar_user_belongings_akuse->bindValue(':USER_ID',$user_id, PDO::PARAM_STR);
$avatar_user_belongings_akuse->bindValue(':PARTS_CATEGORY','akuse', PDO::PARAM_STR);
$avatar_user_belongings_akuse->execute();
//靴
$avatar_user_belongings_kutu = $pdo->prepare($sql);
$avatar_user_belongings_kutu->bindValue(':USER_ID',$user_id, PDO::PARAM_STR);
$avatar_user_belongings_kutu->bindValue(':PARTS_CATEGORY','kutu', PDO::PARAM_STR);
$avatar_user_belongings_kutu->execute();
//持ち物
$avatar_user_belongings_mochimono = $pdo->prepare($sql);
$avatar_user_belongings_mochimono->bindValue(':USER_ID',$user_id, PDO::PARAM_STR);
$avatar_user_belongings_mochimono->bindValue(':PARTS_CATEGORY','mochimono', PDO::PARAM_STR);
$avatar_user_belongings_mochimono->execute();
//背景
$avatar_user_belongings_backimg = $pdo->prepare($sql);
$avatar_user_belongings_backimg->bindValue(':USER_ID',$user_id, PDO::PARAM_STR);
$avatar_user_belongings_backimg->bindValue(':PARTS_CATEGORY','backimg', PDO::PARAM_STR);
$avatar_user_belongings_backimg->execute();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>アバター/メイン</title>
<link rel="stylesheet" type="text/css" href="css/html5reset.css"  />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<style type="text/css">
/* セレクトボックス */
select {
width: 200px;
display:inline;
vertical-align:middle;
}/* アバター表示 */
.base {
    position: relative;
    width: 519px;
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
.base #backimgImg {
    position: absolute;
    width: 519px;
    height: 307px;
    z-index: -1;
}
</style>
<script type="text/javascript" src="http://syldra.secret.jp/js/jquery-1.3.2.min.js"></script>
</head>
<body>
<script>
function change(part){
    num = $("select[name='"+part+"']").val();
    if(num=="noimg"){$("#"+part+"Img").attr('src','http://syldra.secret.jp/avatar/visual/noimg.png');}
    else{
    $("#"+part+"Img").attr('src','http://syldra.secret.jp/avatar/visual/'+part+'/'+num+'.png');
}
}
</script>
<div id="header">
<?php include( $_SERVER['DOCUMENT_ROOT'] . '/dropDownMenu.php'); ?>
</div>
<!-- 画像表示領域 -->
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
<br>
<!-- 着せ替え用セレクトボックス -->
<form action="changed.php" method="post" id="selectStyleId" name="selectStyleName">
<!--　肌色　-->
<p>
<label for="hada">肌色：</label>
<select id="hada" name="hada" onchange="change('hada');">
<?php while($avatar_user_belongings_hada_list = $avatar_user_belongings_hada->fetch(PDO::FETCH_NUM)){
    if($avatar_user_belongings_hada_list[3]=="hada"){
        echo "<option value=\"". $avatar_user_belongings_hada_list[1]."\"";
        if ($hada == $avatar_user_belongings_hada_list[1]){echo "selected";}
        echo ">".$avatar_user_belongings_hada_list[2]."</option>";
    }
}?>
</select>
</p>
<!--　顔　-->
<p>
<label for="kao">顔：</label>
<select id="kao" name="kao" onchange="change('kao');">
<?php while($avatar_user_belongings_kao_list = $avatar_user_belongings_kao->fetch(PDO::FETCH_NUM)){
         echo "<option value=\"".$avatar_user_belongings_kao_list[1]."\"";
        if ($kao==$avatar_user_belongings_kao_list[1]){echo "selected";}
        echo ">".$avatar_user_belongings_kao_list[2]."</option>";
}?>
</select>
</p>
<!--　髪型　-->
<p>
<label for="kami">髪型：</label>
<select id="kami" name="kami" onchange="change('kami');">
<?php while($avatar_user_belongings_kami_list = $avatar_user_belongings_kami->fetch(PDO::FETCH_NUM)){
         echo "<option value=\"". $avatar_user_belongings_kami_list[1]."\"";
        if ($kami == $avatar_user_belongings_kami_list[1]){echo "selected";}
        echo ">".$avatar_user_belongings_kami_list[2]."</option>";
}?>
</select>
</p>
<!--　服　-->
<p>
<label for="huku">服：</label>
<select id="huku" name="huku" onchange="change('huku');">
<?php while($avatar_user_belongings_huku_list = $avatar_user_belongings_huku->fetch(PDO::FETCH_NUM)){
        echo "<option value=\"". $avatar_user_belongings_huku_list[1]."\"";
        if ($huku == $avatar_user_belongings_huku_list[1]){echo "selected";}
        echo ">".$avatar_user_belongings_huku_list[2]."</option>";
}?>
</select>
</p>
<!--　アクセサリー　-->
<p>
<label for="akuse">アクセサリー：</label>
<select id="akuse" name="akuse" onchange="change('akuse');">
<option value="noimg" <?php if($akuse == "noimg"){echo "selected";}?>>なし</option>
<?php while($avatar_user_belongings_akuse_list = $avatar_user_belongings_akuse->fetch(PDO::FETCH_NUM)){
        echo "<option value=\"". $avatar_user_belongings_akuse_list[1]."\"";
        if ($akuse == $avatar_user_belongings_akuse_list[1]){echo "selected";}
        echo ">".$avatar_user_belongings_akuse_list[2]."</option>";
}?>
</select>
</p>
<!--　靴　-->
<p>
<label for="kutu">靴：</label>
<select id="kutu" name="kutu" onchange="change('kutu');">
<option value="noimg" <?php if($kutu == "noimg"){echo "selected";}?>>なし</option>
<?php while($avatar_user_belongings_kutu_list = $avatar_user_belongings_kutu->fetch(PDO::FETCH_NUM)){
    if($avatar_user_belongings_kutu_list[3]=="kutu"){
        echo "<option value=\"". $avatar_user_belongings_kutu_list[1]."\"";
        if ($kutu == $avatar_user_belongings_kutu_list[1]){echo "selected";}
        echo ">".$avatar_user_belongings_kutu_list[2]."</option>";
    }
}?>
</select>
</p>
<!--　持ち物　-->
<p>
<label for="mochimono">持ち物：</label>
<select id="mochimono" name="mochimono" onchange="change('mochimono');">
<option value="noimg" <?php if($mochimono == "noimg"){echo "selected";}?>>なし</option>
<?php while($avatar_user_belongings_mochimono_list = $avatar_user_belongings_mochimono->fetch(PDO::FETCH_NUM)){
    if($avatar_user_belongings_mochimono_list[3]=="mochimono"){
        echo "<option value=\"". $avatar_user_belongings_mochimono_list[1]."\"";
        if ($mochimono == $avatar_user_belongings_mochimono_list[1]){echo "selected";}
        echo ">".$avatar_user_belongings_mochimono_list[2]."</option>";
    }
}?>
</select>
</p>
<!--　背景　-->
<p>
<label for="backimg">持ち物：</label>
<select id="backimg" name="backimg" onchange="change('backimg');">
<option value="noimg" <?php if($backimg == "noimg"){echo "selected";}?>>なし</option>
<?php while($avatar_user_belongings_backimg_list = $avatar_user_belongings_backimg->fetch(PDO::FETCH_NUM)){
    if($avatar_user_belongings_backimg_list[3]=="backimg"){
        echo "<option value=\"". $avatar_user_belongings_backimg_list[1]."\"";
        if ($backimg == $avatar_user_belongings_backimg_list[1]){echo "selected";}
        echo ">".$avatar_user_belongings_backimg_list[2]."</option>";
    }
}?>
</select>
</p>
<input type="submit" name="button_change" value="着替える">
</form>
<a href="http://syldra.secret.jp/avatar/shop.php">ショップでアバターアイテムを購入する</a>
</body>
</html>

