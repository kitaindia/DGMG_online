<?php
//IDセッション無し→一般向けリミテーション
session_start();

if(!isset($_SESSION["id"]))
{
header("Location: ../index.php");
exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<html>
<head>
<meta charset="UTF-8">
<titleみんなで育てるシルドラくん</title>
<style type="text/css">
body {  
    text-align: center;  
    background-color:#e9e5f9;
}  
body text{
	font-family:"メイリオ", sans-serif;
}
</style>　
<script type="text/javascript">
<!--
function blank_alert() {
	if(document.kotoba.textkotoba.value==""){
		alert("言葉は必ず入力してね。");
		return false;
	}
	var str = document.kotoba.textkotoba.value;
	if(str.length >= 15){
				alert("15文字以上の言葉は覚えらないんだ。ごめんね。");
				return false;
	}

}

// -->
</script>
</head>
<body>
	<div id="header">
<?php include( $_SERVER['DOCUMENT_ROOT'] . '/dropDownMenu.php'); ?>
</div>
	<image src="http://syldra.secret.jp/image/sirudoraBorned.png" width="500px" height="300px" id="eggborn" border="0" style="margin:30px;"/><br><br>
<form name="kotoba" action="insertkotoba.php" method="post" onsubmit="return blank_alert()">
<text>「どんな言葉を教えてくれるの？」</text>
<br>
<input type="text" name="textkotoba">
<br><br>
<label for="syurui"><text>「その言葉はどんな言葉？」</text></label>
<br>
<select id="syurui" name="syurui">
<option value="ikimono">生き物を表す言葉(ドラゴン,医者,ナポレオンなど)</option>
<option value="physic">生き物以外の存在で形あるものを表す言葉(椅子,アメリカ大陸,パソコンなど)</option>
<option value="nonphysic">生き物以外の存在で形ないものを表す言葉(愛,アメリカ合衆国,インターネットなど)</option>
<option value="ugoki">動きを表す言葉(食べる,笑う,闘う など)</option>
<option value="yousu">様子を表す言葉(小さい,眠そうな,ピカピカしている など)</option>
<option value="serihu">挨拶やセリフの言葉(こんばんちわ,GoodMornig, やっほー！など)</option>
<option value="humei">どれか分からない</option>
</select>
<br>
<br>
<input type="submit" name="kotobaButton" value="覚えさせる"><text style=" background-color: #f8dce0;">　※<image src="http://syldra.secret.jp/image/sirudoru.png"/>を１枚使うよ。</text>
</form>
<br>
<br>
<a href="http://syldra.secret.jp/BringUpSyldra/main.php" style="border:0;">シルドラくんトップに戻る</a>
<br>
<br>
</body>
</html>