<?php
session_start();
if(!isset($_SESSION["id"]))
//Case セッション破棄
{
header("Location: /index.php");
exit;
}
//DB接続
$pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト', 'ユーザ名', 'パスワード');
$pdo->query('SET NAMES utf8');
//ID取得
$USER_ID = $_SESSION['id'];
//現在所持ポイントを取得
$stmt = $pdo->prepare("SELECT COIN FROM TEST_GAME where USER_ID = ?");
$stmt -> execute(array($USER_ID));
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	$nowPoint = $row["COIN"];
	break;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>めくってシルドラくん</title>
<link rel="stylesheet" type="text/css" href="css/html5reset.css"  />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<style type="text/css">
.tile{
	width:24px;
	height:24px;
	background-color: #b0c4de;
	float:left;
}
body {
	font-family: "メイリオ", sans-serif;
	width:65%;
	margin-left:auto;
	margin-right:auto
}
#tblBody{
	float : left; 
	width:120px;
	height:120px;
}
.tileFront{
	width:0px;
	height:0px;
	clear:both;
}
.hide {
	visibility:hidden;
}
#wrapper{
	position:relative;
	z-index:-2;
	clear:both;
	width:200px;
	height:80px;
}
#gameover {
	position:absolute;
	z-index:0;
	clear:both;
	width:200px;
	height:80px;
	background-color: #b3badd;
}
#go {
	visibility:hidden;
	font-family: Impact,Charcoal; 
	font-size:20px;
}
#msgGetPoint {
	z-index:0;
	position:absolute;
	clear:both;
	width:200px;
	height:80px;
	background-color: #b3badd;
}
#mgp {
	visibility:hidden;
	font-family: Impact,Charcoal; 
	font-size:20px;
}
#forms {
	display:block;
}
#point{
	width:60px;
	height:30px;
	text-align: center;
	font-size:20px;
}
.nowPoint{
	font-family: Impact,Charcoal; 
	font-size:20px;
}
/** ポイントのテーブル **/
table , td{
	border: 1px solid #595959;
	border-collapse: collapse;
}
td{
	padding: 3px;
	width: 20px;
	height: 20px;
}
</style>
<?php //<script type='text/javascript' src='js\jquery-1.3.2.min.js'></script> ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript">
<!--
//####現在所持ポイント取得#####
function getNowPoint(){
$(function(){
	//ajax処理開始
	$.ajax({
        	type: 'POST',
        	dataType: 'json',
        	url: 'returnNowPoint.php',
        	success: function(data){
        		$("p.nowPoint").text(data);
        	}
        });
	//ajax処理終了
});
}
//####ポイント追加処理#####
function addPoint(point){
$(function(){
	//ajax処理開始
	$.ajax({
        	type: 'POST',
        	dataType: 'json',
        	url: 'getCoin.php',
        	data:{
        		addPoint:point
        	},
        	success: function(data){
        		//alert(data+"ポイント獲得");
        		$('#mgp').html(data+'ポイント獲得！');
        		$('#mgp').css('visibility', 'visible');
        		$('#gameover').css('z-index', '-1');
        	}
        });
	//ajax処理終了
});
}
//####ポイント減少処理#####
function losePoint(point){
$(function(){
	//ajax処理開始
        $.ajax({
        	type: 'POST',
        	dataType: 'json',
        	url: 'loseCoin.php',
        	data:{
        		lostCoin:point
        	},
        	success: function(data){
        		//処理
        		$('#go').html('GAME　OVER<br>'+data+'ポイント失いました・・・。');
        		$('#gameover').css('z-index', '1');
        		getNowPoint();
        	}
        });
	//ajax処理終了
});
}
//####クリックによるポイント処理####
var tblCount = 0;
var gameOverFlg = 0;
function tileClick(tileId){
$(function(){
	if(gameOverFlg==0){
	var txt = $('#'+tileId+"txt").text();
	if(txt=="1"){
		point = jQuery('#point').val();
		point = parseInt(point);
        $('#'+tileId).css('background-color', '#dd425c');
        gameOverFlg = 1;
        $('#go').css('visibility', 'visible');
        //$('#forms').css('display', 'none');
        //ajax処理
        losePoint(point);
        //ajax処理終了
        
    }else{
    	if($('#'+tileId).css('background-color')!=="rgb(170, 221, 66)"){
    	$('#'+tileId).css('background-color', '#aadd42');
    	$('#'+tileId).css('background-image', 'url(/tilegameimg/syldra.png)');
    	$('#'+tileId).css('background-repeat', 'no-repeat');
    		point = jQuery('#point').val();
			point = parseInt(point);
			switch(tblCount){
			case 4:$('#point').val(500);break;
			case 9:$('#point').val(1000);break;
			case 14:$('#point').val(2000);break;
			case 19:$('#point').val(4000);break;
		}
			point = jQuery('#point').val();
			point = parseInt(point);
			tblCount = tblCount+1;
			switch(tblCount){
				case 5:addPoint(10);getNowPoint();break;
				case 10:addPoint(50);getNowPoint();break;
				case 15:addPoint(100);getNowPoint();break;
				case 20:addPoint(200);getNowPoint();break;
				case 25:addPoint(400);getNowPoint();break;
			}
			$('#'+tblCount+'tbl').css('background-color', '#ffff63');
		}
	}
	}
});
}
//####オンカーソル処理####
function tileOnMouse(tileId){
$(function(){
	if(gameOverFlg==0){
	if($('#'+tileId).css('background-color')!=="rgb(170, 221, 66)"){
	$('#'+tileId).css('background-color', '#4682b4');
}
}
});
}
//####カーソルアウト処理####
function tileOnMouseOut(tileId){
$(function(){
	if(gameOverFlg==0){
	if($('#'+tileId).css('background-color')!=="rgb(170, 221, 66)"){
	$('#'+tileId).css('background-color', '#b0c4de');
}
}
});
}
// -->
</script>
</head>
<div id="header">
<?php include( $_SERVER['DOCUMENT_ROOT'] . '/dropDownMenu.php'); ?>
</div>
<body>
<br>
<div id="gameBody">
<div id="tblBody">
<div class="tileFront"></div>
<div id="tile1" class="tile" onclick="tileClick('tile1')" onmouseover="tileOnMouse('tile1')" onmouseout="tileOnMouseOut('tile1')"><span class="hide"><text id="tile1txt" class="txt"><?php echo rand(1, 6); ?></span></text></div>
<div id="tile2" class="tile" onclick="tileClick('tile2')" onmouseover="tileOnMouse('tile2')" onmouseout="tileOnMouseOut('tile2')"><span class="hide"><text id="tile2txt" class="txt"><?php echo rand(1, 6); ?></span></text></div>
<div id="tile3" class="tile" onclick="tileClick('tile3')" onmouseover="tileOnMouse('tile3')" onmouseout="tileOnMouseOut('tile3')"><span class="hide"><text id="tile3txt" class="txt"><?php echo rand(1, 6); ?></span></text></div>
<div id="tile4" class="tile" onclick="tileClick('tile4')" onmouseover="tileOnMouse('tile4')" onmouseout="tileOnMouseOut('tile4')"><span class="hide"><text id="tile4txt" class="txt"><?php echo rand(1, 6); ?></span></text></div>
<div id="tile5" class="tile" onclick="tileClick('tile5')" onmouseover="tileOnMouse('tile5')" onmouseout="tileOnMouseOut('tile5')"><span class="hide"><text id="tile5txt" class="txt"><?php echo rand(1, 6); ?></span></text></div>
<div class="tileFront"></div>
<div id="tile6" class="tile" onclick="tileClick('tile6')" onmouseover="tileOnMouse('tile6')" onmouseout="tileOnMouseOut('tile6')"><span class="hide"><text id="tile6txt" class="txt"><?php echo rand(1, 6); ?></span></text></div>
<div id="tile7" class="tile" onclick="tileClick('tile7')" onmouseover="tileOnMouse('tile7')" onmouseout="tileOnMouseOut('tile7')"><span class="hide"><text id="tile7txt" class="txt"><?php echo rand(1, 6); ?></span></text></div>
<div id="tile8" class="tile" onclick="tileClick('tile8')" onmouseover="tileOnMouse('tile8')" onmouseout="tileOnMouseOut('tile8')"><span class="hide"><text id="tile8txt" class="txt"><?php echo rand(1, 6); ?></span></text></div>
<div id="tile9" class="tile" onclick="tileClick('tile9')" onmouseover="tileOnMouse('tile9')" onmouseout="tileOnMouseOut('tile9')"><span class="hide"><text id="tile9txt" class="txt"><?php echo rand(1, 6); ?></span></text></div>
<div id="tile10" class="tile" onclick="tileClick('tile10')" onmouseover="tileOnMouse('tile10')" onmouseout="tileOnMouseOut('tile10')"><span class="hide"><text id="tile10txt" class="txt"><?php echo rand(1, 6); ?></span></text></div>
<div class="tileFront"></div>
<div id="tile11" class="tile" onclick="tileClick('tile11')" onmouseover="tileOnMouse('tile11')" onmouseout="tileOnMouseOut('tile11')"><span class="hide"><text id="tile11txt" class="txt"><?php echo rand(1, 6); ?></span></text></div>
<div id="tile12" class="tile" onclick="tileClick('tile12')" onmouseover="tileOnMouse('tile12')" onmouseout="tileOnMouseOut('tile12')"><span class="hide"><text id="tile12txt" class="txt"><?php echo rand(1, 6); ?></span></text></div>
<div id="tile13" class="tile" onclick="tileClick('tile13')" onmouseover="tileOnMouse('tile13')" onmouseout="tileOnMouseOut('tile13')"><span class="hide"><text id="tile13txt" class="txt"><?php echo rand(1, 6); ?></span></text></div>
<div id="tile14" class="tile" onclick="tileClick('tile14')" onmouseover="tileOnMouse('tile14')" onmouseout="tileOnMouseOut('tile14')"><span class="hide"><text id="tile14txt" class="txt"><?php echo rand(1, 6); ?></span></text></div>
<div id="tile15" class="tile" onclick="tileClick('tile15')" onmouseover="tileOnMouse('tile15')" onmouseout="tileOnMouseOut('tile15')"><span class="hide"><text id="tile15txt" class="txt"><?php echo rand(1, 6); ?></span></text></div>
<div class="tileFront"></div>
<div id="tile16" class="tile" onclick="tileClick('tile16')" onmouseover="tileOnMouse('tile16')" onmouseout="tileOnMouseOut('tile16')"><span class="hide"><text id="tile16txt" class="txt"><?php echo rand(1, 6); ?></span></text></div>
<div id="tile17" class="tile" onclick="tileClick('tile17')" onmouseover="tileOnMouse('tile17')" onmouseout="tileOnMouseOut('tile17')"><span class="hide"><text id="tile17txt" class="txt"><?php echo rand(1, 6); ?></span></text></div>
<div id="tile18" class="tile" onclick="tileClick('tile18')" onmouseover="tileOnMouse('tile18')" onmouseout="tileOnMouseOut('tile18')"><span class="hide"><text id="tile18txt" class="txt"><?php echo rand(1, 6); ?></span></text></div>
<div id="tile19" class="tile" onclick="tileClick('tile19')" onmouseover="tileOnMouse('tile19')" onmouseout="tileOnMouseOut('tile19')"><span class="hide"><text id="tile19txt" class="txt"><?php echo rand(1, 6); ?></span></text></div>
<div id="tile20" class="tile" onclick="tileClick('tile20')" onmouseover="tileOnMouse('tile20')" onmouseout="tileOnMouseOut('tile20')"><span class="hide"><text id="tile20txt" class="txt"><?php echo rand(1, 6); ?></span></text></div>
<div class="tileFront"></div>
<div id="tile21" class="tile" onclick="tileClick('tile21')" onmouseover="tileOnMouse('tile21')" onmouseout="tileOnMouseOut('tile21')"><span class="hide"><text id="tile21txt" class="txt"><?php echo rand(1, 6); ?></span></text></div>
<div id="tile22" class="tile" onclick="tileClick('tile22')" onmouseover="tileOnMouse('tile22')" onmouseout="tileOnMouseOut('tile22')"><span class="hide"><text id="tile22txt" class="txt"><?php echo rand(1, 6); ?></span></text></div>
<div id="tile23" class="tile" onclick="tileClick('tile23')" onmouseover="tileOnMouse('tile23')" onmouseout="tileOnMouseOut('tile23')"><span class="hide"><text id="tile23txt" class="txt"><?php echo rand(1, 6); ?></span></text></div>
<div id="tile24" class="tile" onclick="tileClick('tile24')" onmouseover="tileOnMouse('tile24')" onmouseout="tileOnMouseOut('tile24')"><span class="hide"><text id="tile24txt" class="txt"><?php echo rand(1, 6); ?></span></text></div>
<div id="tile25" class="tile" onclick="tileClick('tile25')" onmouseover="tileOnMouse('tile25')" onmouseout="tileOnMouseOut('tile25')"><span class="hide"><text id="tile25txt" class="txt"><?php echo rand(1, 6); ?></span></text></div>
<div class="tileFront"></div>
</div>
<div id="wrapper">
<div id="msgGetPoint"><font id="mgp"></font></div>
<div id="gameover"><font id="go"></font></div>
</div>
<br><br>
<div id="forms">
<form id="form_exchange" method="post" action="getCoin.php" >
いま地雷を踏むと<input type="text" readonly value="100" id="point" name="lostCoin">ポイント失います。<br>
</form>
</div>
</div>
<br><br>
<?php
echo '<table>';
echo '<tbody>';
echo '<tr>';
for($i = 1;$i<26;$i++){
echo '<td id="'.$i.'tbl">';
switch($i){
	case 5:echo '<font style="font-size:4px; color:red;">１0</font>';break;
	case 10:echo '<font style="font-size:4px; color:red;">50</font>';break;
	case 15:echo '<font style="font-size:4px; color:red;">100</font>';break;
	case 20:echo '<font style="font-size:4px; color:red;">200</font>';break;
	case 25:echo '<font style="font-size:4px; color:red;">400</font>';break;
}
echo '</td>';
}
echo '</tr>';
echo '</tbody>';
echo '</table>';
?>
<?php echo $_SESSION['name']."さんの" ?>現在の所持ポイント<p class="nowPoint"><?php echo $nowPoint;?></p>
<br><a href="/tilegame.php">ドロップアウトする<a>
<br><a href="index.php">トップにもどる<a>
</body>
</html>