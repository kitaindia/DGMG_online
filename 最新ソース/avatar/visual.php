<?php
//セッション開始
//セッションが無い場合は、limited.phpへ
//USER_IDの取得
//AVATAR_VISUALからUSER_IDを使って、各部位の情報を取得
//顔
$kao = 1;
//肌
$hada = 1;
//髪
$kami = 1;
//服
$huku = 2;
//アクセサリー
$akuse = 1;
//靴
$kutu = 2;
//持ち物
$mochimono = 0;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>シルドラチャット</title>
<link rel="stylesheet" type="text/css" href="css/html5reset.css"  />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<style type="text/css">
/* アバター表示 */
.base {
    position: relative;
    width: 173px;
    height: 307px;
}
.base #hada {
    position: absolute;
    width: 173px;
    height: 307px;
}
.base #kao {
    position: absolute;
    width: 173px;
    height: 307px;
}
.base #kami {
    position: absolute;
    width: 173px;
    height: 307px;
}
.base #accessory {
    position: absolute;
    width: 173px;
    height: 307px;
}
.base #kutu {
    position: absolute;
    width: 173px;
    height: 307px;
}
.base #huku {
    position: absolute;
    width: 173px;
    height: 307px;
}
.base #mochimono {
    position: absolute;
    width: 173px;
    height: 307px;
}
/* 着せ替えセレクトボックス */
body select {
  width:200px;
}
</style>
<script type="text/javascript">
<!--
function test(){
    var a = 1;
        document.getElementById('test').value=a;
}
/* function changeVisual(){

    //変更後の数字を取得
    var selects = document.getElementById('huku');
    var option = document.getElementById('huku').options;
    var index = option[selects.selectedIndex].value;
     //変更後の数字をsrcのvalueに埋め込む
    switch(part){
        case hada:
        document.getElementById('hada').src="http://syldra.secret.jp/avatar/visual/hada/"+index+".png";
        ;
        break;
        case kao:
        document.getElementById('kao').src="http://syldra.secret.jp/avatar/visual/kao/"+index+".png";
        ;
        break;
        case kami;
        document.getElementById('kami').src="http://syldra.secret.jp/avatar/visual/kami/"+index+".png";
        ;
        break;
        case akuse:
        document.getElementById('akuse').src="http://syldra.secret.jp/avatar/visual/akuse/"+index+".png";
        ;
        break;
        case huku;
        document.getElementById('huku').src="http://syldra.secret.jp/avatar/visual/huku/"+index+".png";
        ;
        break;
        case kutu;
        document.getElementById('kutu').src="http://syldra.secret.jp/avatar/visual/kutu/"+index+".png";
        ;
        break;
        case mochimono;
        document.getElementById('mochimono').src="http://syldra.secret.jp/avatar/visual/mochimono/"+index+".png";
        ;
        break;
    }

}*/
// -->
</script>
</head>
<body>
<!-- 画像表示領域 -->
<div class="base">
<img id="hada" src="http://syldra.secret.jp/avatar/visual/hada/<?php echo $hada?>.png">
<img id="kao" src="http://syldra.secret.jp/avatar/visual/kao/<?php echo $kao?>.png">
<img id="kami" src="http://syldra.secret.jp/avatar/visual/kami/<?php echo $kami?>.png">
<img id="accessory" src="http://syldra.secret.jp/avatar/visual/akuse/<?php echo $akuse?>.png">
<img id="kutu" src="http://syldra.secret.jp/avatar/visual/kutu/<?php echo $kutu?>.png">
<img id="huku" src="http://syldra.secret.jp/avatar/visual/huku/<?php echo $huku?>.png">
<img id="mochimono" src="http://syldra.secret.jp/avatar/visual/mochimono/<?php echo $mochimono?>.png">
</div>
<!-- 着替え用セレクトボックス -->
<form action="changeVisual.php" method="post" name="parts">
<p>
<label for="hada">肌色：</label>
<select id="hada" name="hada" onChange="changeVisual('hada');">
<option value="1"<?php if($hada == "1"){print "selected";}?>>肌色1</option>
<option value="2"<?php if($hada == "2"){print "selected";}?>>肌色2</option>
<option value="3"<?php if($hada == "3"){print "selected";}?>>肌色3</option>
</select>
</p>
<p>
<label for="kao">顔：</label>
<select id="kao" name="kao" onchange="changeVisual('kao');">
<option value="1"<?php if($kao == "1"){print "selected";}?>>顔1</option>
<option value="2"<?php if($kao == "2"){print "selected";}?>>顔2</option>
<option value="3"<?php if($kao == "3"){print "selected";}?>>顔3</option>
</select>
</p>
<p>
<label for="kami">髪型：</label>
<select id="kami" name="kami" onchange="changeVisual(kami)">
<option value="1"<?php if($kami == "1"){print "selected";}?>>髪型1</option>
<option value="2"<?php if($kami == "2"){print "selected";}?>>髪型2</option>
<option value="3"<?php if($kami == "3"){print "selected";}?>>髪型3</option>
</select>
</p>
<p>
<label for="huku">服：</label>
<select id="huku" name="huku" onchange="changeVisual(huku)">
<option value="1"<?php if($huku == "1"){print "selected";}?>>服1</option>
<option value="2"<?php if($huku == "2"){print "selected";}?>>服2</option>
<option value="3"<?php if($huku == "3"){print "selected";}?>>服3</option>
</select>
</p>
<p>
<label for="akuse">アクセサリー：</label>
<select id="akuse" name="akuse" onchange="changeVisual(akuse)">
<option value="1"<?php if($akuse == "1"){print "selected";}?>>アクセサリー1</option>
<option value="2"<?php if($akuse == "2"){print "selected";}?>>アクセサリー2</option>
<option value="3"<?php if($akuse == "3"){print "selected";}?>>アクセサリー3</option>
</select>
</p>
<p>
<label for="kutu">靴：</label>
<select id="kutu" name="kutu" onchange="changeVisual(kutu)">
<option value="1"<?php if($huku == "1"){print "selected";}?>>靴1</option>
<option value="2"<?php if($huku == "2"){print "selected";}?>>靴2</option>
<option value="3"<?php if($huku == "3"){print "selected";}?>>靴3</option>
</select>
</p>
<p>
<label for="mochimono">持ち物：</label>
<select id="mochimono" name="mochimono" onchange="changeVisual(mochimono)">
<option value="1"<?php if($mochimono == "1"){print "selected";}?>>持ち物1</option>
<option value="2"<?php if($mochimono == "2"){print "selected";}?>>持ち物2</option>
<option value="3"<?php if($mochimono == "3"){print "selected";}?>>持ち物3</option>
</select>
</p>
<input type="submit" value="着替える">
<input type="text" value="" id="test" name="testtext"> 
<input type="button" value="テストボタン" id="test2" onClick="test()">
</form>
</body>
</html>

