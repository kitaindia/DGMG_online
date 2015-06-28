<?php
//関数宣言
//DBに接続し、卵ポイント追加or現在ポイントの表示
function addEggPoint($updOrViewNowPoint){

try {
  $pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト名', 'ユーザー名', 'パスワード');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。' . $e->getMessage());
}

$stmt = $pdo->query('SET NAMES utf8');
if (!$stmt) {
  $info = $pdo->errorInfo();
  exit($info[2]);
}
if($updOrViewNowPoint ==="0"){
//卵のポイント更新
$pdo->query('UPDATE syldra_egg SET point = point+1 WHERE num = 1');
}
else{
//卵のポイント表示
$stmt = $pdo->query('SELECT point FROM syldra_egg WHERE num = 1');
if (!$stmt) {
  $info = $pdo->errorInfo();

  exit($info[2]);
}
while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $pointViewd = $data['point'];
}
return $pointViewd;
}
$pdo = null;
}

//シルドル追加
function addSirudoru($id){
try {
  $pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト名', 'ユーザー名', 'パスワード');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。' . $e->getMessage());
}
$stmt = $pdo->query('SET NAMES utf8');
if (!$stmt) {
  $info = $pdo->errorInfo();
  exit($info[2]);
}
$stmt = $pdo->prepare('UPDATE db_user SET sirudoru = sirudoru+1 WHERE id = :id');
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$stmt->execute();
}

$actionx =$_POST["action"];
if(isset($actionx)){
	$first = 1;
if($actionx==="wara"){
	if(!isset($_COOKIE["wara"])){
$ok = "1";
setcookie("wara", "warawara", time()+60*60*12);
	}else{
		$ok = "0";
	}
}
if($actionx==="lang"){
$ok = "2";
}
}
//行動選択
function doSomething($memberOrNot){
	if($memberOrNot==1){
		$eggId =$_POST["eggId"];
print<<<EOF
<form action="#" method="post">
<p>なにをする？<br>
<select name="action" size="10">
<option value="wara">ワラをかけて暖める</option>
<option value="lang">言葉を覚えさせる</option>
</select></p>
<input type="hidden" name="disFlg" value="true">
<input type="hidden" name="hid" value="
EOF;
print $eggId;
print<<<EOF
">
<input class="egganswer" type="submit" value="送信"><input class="egganswer" type="reset" value="リセット">
</form>
EOF;
}else{
		print<<<EOF
<br>
<form action="#" method="post">
<p>なにをする？<br>
<select name="action" size="10">
<option value="wara">ワラをかけて暖める</option>
</select></p>
<input type="hidden" name="disFlg" value="true">
<input class="egganswer" type="submit" value="送信"><input class="egganswer" type="reset" value="リセット">
</form>
EOF;
}
}
function moveto(){
	$move = 1;
	header("Location: main.php");
}
//メンバーか否かを訊ねる関数
function questionMemberOrNot(){
	if($_POST["nockEgg"]=="yes"){
print<<<EOF
<br>
卵「・・・。(やあ。君はシルドラのメンバーかい？)」<br>
<form action="#" method="post">
<label><input class="eggradio" type="radio" name="isMember" value="yes" size="10"/>そうだよ。</label>
<label><input class="eggradio" type="radio" name="isMember" value="no"/>ちがうよ。</label>
<input class="egganswer" type="submit" value="答える" size="20">
</form>
EOF;
}elseif($_POST["nockEgg"]=="no")
print<<<EOF
<br>
卵「・・・。(さようなら。)」
EOF;
}
//メンバーの場合にidとpassの入力を促す関数
function questionIdAndPass(){
print<<<EOF
<br>
卵「・・・。(メンバーなんだね。それじゃあ、IDとパスワードを教えてくれるかい？)」<br>
<form action="#" method="post">
<p>
IDは<input class="eggform" type="text" name="eggId">で、パスワードは<input class="eggform" type="password" name="eggPassword">だよ。
</p>
<input class="egganswer" type="submit" value="答える" size="20">
</form>
EOF;
}
//ノックするかどうかを訊ねる関数
function questionDoNock(){
	print<<<EOF
<br>
<form action="#" method="post">
	シルドラの卵がある。叩いてみますか？それともこのまま帰りますか？<br>
<input class="eggradio" type="radio" name="nockEgg" value="yes"/>叩く
<input class="eggradio" type="radio" name="nockEgg" value="no"/>帰る
<input class="egganswer" type="submit" value="実行" style=”width: 20px;”>
</form>
EOF;
}
//IDとPASSのチェック関数
function checkIdPass(){
	$id =$_POST["eggId"];
	$pass = $_POST["eggPassword"];
$link = mysql_connect('mysql010.phy.lolipop.lan', 'ユーザー名','パスワード');
if (!$link) {
    die('接続失敗です。'.mysql_error());
}
$db_selected = mysql_select_db('LAA0535115-dbname', $link);
if (!$db_selected){
    die('データベース選択失敗です。'.mysql_error());
}
mysql_set_charset('utf8');
$result = mysql_query('SELECT * FROM db_user');
if (!$result) {
    die('クエリーが失敗しました。'.mysql_error());
}
while ($row = mysql_fetch_assoc($result)) {
  if($id == $row['id'] && $pass == $row['pass']){
  	$name = $row['name'];
	print"<br>「・・・。（こんにちは、";
	print $name;
	print"さん。)」";
doSomething(1);
}
}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="ja">
<head>
<link rel="shortcut icon" href="image/favolite.ico"><!-- ////////// ファビコン ////////// -->
<link rel="stylesheet" type="text/css" href="style.css"><!-- ////////// スタイルシート ////////// -->
<meta http-equiv="Content-Language" content="ja">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="content-language" content="ja">
<title>SITENAME &gt; CONTACT</title><!-- ////////// サイト名 ////////// -->
<style TYPE="text/css">
.eggform{
width:70px
}
.egganswer{
width:45px
}
.eggradio{
width:10px
}
#koko{
	color:red;
}
#count{
	font-size:40;
}
.shopimg{
vertical-align: top;
}
--> 
</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
<!--
function bornSirudora(){
	var eggborn = document.getElementById('eggborn');
	eggborn.src = "image/sirudoraBorned.png";
}
function dispSerihu(){
	var serihu = document.getElementById('serihu');
	serihu.style.visibility = "visible";
}
function cursorOutIcon(){
	serihu.style.visibility = "hidden";
}
$(function(){
	var opt2 = {
		text : [
				"おや・・。",
				"シルドラのたまごの様子が・・・",
				"たまごに触れてみよう。"
				],
		delay : 80,
		speed : 100,
		order : "linear",
		transition : "normal"
	}
	$.fn.textFadeIn = function(opt){
		
		var self = this;
		var textNum = 0;
		
		textAppear();
		
		function textAppear(){
			var currentNum = 0;
			var text = opt.text[textNum];
			var num = text.length;
			var newText = "";
			var j;
			var randomNum = new Array();
		
			for(var i = 0; i < num; i++){
				newText += "<span>";
				newText += text.charAt(i);
				newText += "</span>";
				
				randomNum.push(i);
			}
			
			randomNum = shuffle(randomNum);
			
			$(self).html(newText);
			$(self).find("span").css({
				opacity : 0
			});
			if(opt.transition == "fall"){
				$(self).find("span").css({
					position : "relative",
					top : "-20px"
				});
			}
		
			for(var i = 0; i < num; i++){
				if(opt.order == "linear"){
					j = i;
				}else{
					j = randomNum[i];
				}
				$(self).find("span").eq(j).delay(i * opt.delay).animate({
					opacity : 1,
					top : 0
				}, opt.speed, "linear", function(){
					currentNum ++;
					
					if(currentNum == num){
						if(textNum < (opt.text.length-1)){
							textNum ++;
						}else{
							textNum = 0;
						}
						
						setTimeout(textAppear,1000);
					}
					
				});
			}
		}
		
		function shuffle(list) {
			var i = list.length;
			
			while (--i) {
				var j = Math.floor(Math.random() * (i + 1));
				if (i == j) continue;
				var k = list[i];
				list[i] = list[j];
				list[j] = k;
			}
			
			return list;
		}
	}
	$("p.txt2").textFadeIn(opt2);
})

// -->
</script>
</head>
<body id="PAGETOP">
<center>
<?php
print<<<EOF
<img src="gameimg/eggStop.png" width="500" height="300">
<br>
↑画像を両端に「みんなで育てる」「シルドラくん」という表記がある小さいサイズのものに差し替えました。
<br>
変更されていない人はキャッシュを削除すると表示されると思うので、お手数ですが試してみてください。
EOF;
if(!($_POST["disFlg"]==="true")){
	$aaaa=addEggPoint("1");
print '<br><br>皆が暖めた回数:<text id="count">'.$aaaa.'</text>回<br>';
print '１００回を超えるとシルドラが産まれるよ。<br>';
}
?>

<?php
if($ok === "2"){
	print<<<EOF
「・・・。（ありがとう。でも、産まれてから覚えるよ。）」
<br>
EOF;
}
if($ok === "1"){
	addEggPoint("0");
	$aaaa=addEggPoint("1");
	//--------------------------------------------------
	//データベース接続
$pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト名', 'ユーザー名', 'パスワード');
$pdo->query('SET NAMES utf8');
$query = $pdo->query("SELECT point FROM syldra_egg WHERE num = 1");
$eggPoint = $query->fetch();
	if($eggPoint>=87){
			print<<<EOF
<image src="image/eggStop.png" width="500px" height="300px" id="eggborn" usemap="#Egg" border="0"/>
<map name="Egg">
<area onmouseover="bornSirudora();" onfocus="this.blur();" class="icon" shape="poly" coords="264,84,278,97,290,118,293,147,293,155,269,177,213,171,204,145,205,134,224,99,250,84">
</map>
<div id="wrapper">
<br>
    <p class="txt2" style="font-size:24px; font-family: "メイリオ", sans-serif;"></p>
<br>
</div>
EOF;
		
exit;
	}
	//---------------------------------------------------
print '<br><br>皆が暖めた回数:<text id="count">'.$aaaa.'</text>回<br>';
print '１００回を超えるとシルドラが産まれるよ。<br>';
$hidden = $_POST["hid"];
addSirudoru($hidden);
	print<<<EOF
<br>
卵「・・・。（暖かいよ。ありがとう。・・・お礼に<img src="image/sirudoru.png">をあげるよ。）」
<br>
<br>
１シル＄を手に入れました。<br>
獲得したシル＄額は、<a href="/contact.php"><text id="koko">ここ</text></a>で確認できるよ。<br>
※シル＄が貰えるのはメンバー登録した方のみです。
EOF;
}elseif($ok === "0"){
	print<<<EOF
<br>
「・・・。（今はまだ暖かいからいいよ。ありがとう。あんまり熱いと、ゆで卵になっちゃうからね。）」
<br>
ワラをかける場合は、前回にワラをかけてから１２時間以上経過する必要があります。
EOF;
}
if(isset($_POST["eggId"]) and isset($_POST["eggPassword"])){
	$first = 1;
checkIdPass();
}
?>
<?php
//メンバーかどうか
if(isset($_POST["isMember"])){
	$first = 1;
	if($_POST["isMember"]=="yes"){
		questionIdAndPass();
	}
	elseif($_POST["isMember"]=="no"){
		print<<<EOF
<br>
「・・・。（初めまして。よかったら<a href="confirm.php"><text id="koko">ここ</text></a>でメンバー登録してね。）」
EOF;
doSomething(0);
	}
	
}
?>
<?php
//ノックするしない
if(isset($_POST["nockEgg"])){
	questionMemberOrNot();
	$first = 1;
}
?>
<?php
if(!isset($first)){
	questionDoNock();
	$first = 1;
}
?>
<p>
<a href="shop.html" onmouseover="dispSerihu();" onmouseout="cursorOutIcon();"><text style="color:black; font-size:16;">ショップでアイテムを購入</text></a>
<p>
<div id="serihu" style="visibility:hidden; top:100px; left:80px;"><text　style="font-size:16;">「開店準備中じゃ。入るのは構わんよ。<br>ワシ？ワシは店主じゃ。」</text></div>
<img src="image/moja.png" class="shopimg">
<br>
<a href="index.html"><text style="color:black;">地図へ戻る</text></a>
<div id="FOOTER">
</div><!-- #FOOTER /END -->
</div><!-- #CONTAINER /END -->
</center>
</body>
</html>