<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>サイトのタイトル</title>
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
#gameBody{
}
body {
	font-family: "メイリオ", sans-serif;
}
.tileFront{
	width:0px;
	height:0px;
	clear:both;
}
.hide {
	visibility:hidden;
}
#gameover {
	display:none;
	clear:left;
}
#go {
	font-family: Impact,Charcoal; 
	font-size:20px;
}
#forms {
	display:block;
}
#point{
	width:30px;
	height:30px;
	text-align: center;
	font-size:20px;
}
/** ポイントのテーブル **/
table , td, th {
	border: 1px solid #595959;
	border-collapse: collapse;
}
td, th {
	padding: 3px;
	width: 30px;
	height: 25px;
}
</style>
<?php //<script type='text/javascript' src='js\jquery-1.3.2.min.js'></script> ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript">
<!--
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
        $('#gameover').css('display', 'block');
        $('#forms').css('display', 'none');
        //ajax処理
        $.ajax({
        	type: 'POST',
        	dataType: 'json',
        	url: 'loseCoin.php',
        	data:{
        		coin:point
        	},
        	success: function(data){
        		//処理
        		$('#go').html('GAME　OVER<br>金貨を'+data+'枚失いました・・・。');
        	}
        });
        //ajax処理終了
        
    }else{
    	if($('#'+tileId).css('background-color')!=="rgb(170, 221, 66)"){
    	$('#'+tileId).css('background-color', '#aadd42');
    	$('#'+tileId).css('background-image', 'url(/tilegameimg/syldra.png)');
    	$('#'+tileId).css('background-repeat', 'no-repeat');
    		point = jQuery('#point').val();
			point = parseInt(point);
			$('#point').val(1+point);
			$('#'+tileId+'tbl').css('background-color', '#ffff63');
		}
	}
	}
});
}function tileOnMouse(tileId){
$(function(){
	if(gameOverFlg==0){
	if($('#'+tileId).css('background-color')!=="rgb(170, 221, 66)"){
	$('#'+tileId).css('background-color', '#4682b4');
}
}
});
}
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
<body>
<div id="gameBody">
<div id="gameover"><font id="go"></font></div>
<div class="tileFront"></div>
<div id="tile1" class="tile" onclick="tileClick('tile1')" onmouseover="tileOnMouse('tile1')" onmouseout="tileOnMouseOut('tile1')"><span class="hide"><text id="tile1txt" class="txt"><?php echo rand(1, 5); ?></span></text></div>
<div id="tile2" class="tile" onclick="tileClick('tile2')" onmouseover="tileOnMouse('tile2')" onmouseout="tileOnMouseOut('tile2')"><span class="hide"><text id="tile2txt" class="txt"><?php echo rand(1, 5); ?></span></text></div>
<div id="tile3" class="tile" onclick="tileClick('tile3')" onmouseover="tileOnMouse('tile3')" onmouseout="tileOnMouseOut('tile3')"><span class="hide"><text id="tile3txt" class="txt"><?php echo rand(1, 5); ?></span></text></div>
<div id="tile4" class="tile" onclick="tileClick('tile4')" onmouseover="tileOnMouse('tile4')" onmouseout="tileOnMouseOut('tile4')"><span class="hide"><text id="tile4txt" class="txt"><?php echo rand(1, 5); ?></span></text></div>
<div id="tile5" class="tile" onclick="tileClick('tile5')" onmouseover="tileOnMouse('tile5')" onmouseout="tileOnMouseOut('tile5')"><span class="hide"><text id="tile5txt" class="txt"><?php echo rand(1, 5); ?></span></text></div>
<div class="tileFront"></div>
<div id="tile6" class="tile" onclick="tileClick('tile6')" onmouseover="tileOnMouse('tile6')" onmouseout="tileOnMouseOut('tile6')"><span class="hide"><text id="tile6txt" class="txt"><?php echo rand(1, 5); ?></span></text></div>
<div id="tile7" class="tile" onclick="tileClick('tile7')" onmouseover="tileOnMouse('tile7')" onmouseout="tileOnMouseOut('tile7')"><span class="hide"><text id="tile7txt" class="txt"><?php echo rand(1, 5); ?></span></text></div>
<div id="tile8" class="tile" onclick="tileClick('tile8')" onmouseover="tileOnMouse('tile8')" onmouseout="tileOnMouseOut('tile8')"><span class="hide"><text id="tile8txt" class="txt"><?php echo rand(1, 5); ?></span></text></div>
<div id="tile9" class="tile" onclick="tileClick('tile9')" onmouseover="tileOnMouse('tile9')" onmouseout="tileOnMouseOut('tile9')"><span class="hide"><text id="tile9txt" class="txt"><?php echo rand(1, 5); ?></span></text></div>
<div id="tile10" class="tile" onclick="tileClick('tile10')" onmouseover="tileOnMouse('tile10')" onmouseout="tileOnMouseOut('tile10')"><span class="hide"><text id="tile10txt" class="txt"><?php echo rand(1, 5); ?></span></text></div>
<div class="tileFront"></div>
<div id="tile11" class="tile" onclick="tileClick('tile11')" onmouseover="tileOnMouse('tile11')" onmouseout="tileOnMouseOut('tile11')"><span class="hide"><text id="tile11txt" class="txt"><?php echo rand(1, 5); ?></span></text></div>
<div id="tile12" class="tile" onclick="tileClick('tile12')" onmouseover="tileOnMouse('tile12')" onmouseout="tileOnMouseOut('tile12')"><span class="hide"><text id="tile12txt" class="txt"><?php echo rand(1, 5); ?></span></text></div>
<div id="tile13" class="tile" onclick="tileClick('tile13')" onmouseover="tileOnMouse('tile13')" onmouseout="tileOnMouseOut('tile13')"><span class="hide"><text id="tile13txt" class="txt"><?php echo rand(1, 5); ?></span></text></div>
<div id="tile14" class="tile" onclick="tileClick('tile14')" onmouseover="tileOnMouse('tile14')" onmouseout="tileOnMouseOut('tile14')"><span class="hide"><text id="tile14txt" class="txt"><?php echo rand(1, 5); ?></span></text></div>
<div id="tile15" class="tile" onclick="tileClick('tile15')" onmouseover="tileOnMouse('tile15')" onmouseout="tileOnMouseOut('tile15')"><span class="hide"><text id="tile15txt" class="txt"><?php echo rand(1, 5); ?></span></text></div>
<div class="tileFront"></div>
<div id="tile16" class="tile" onclick="tileClick('tile16')" onmouseover="tileOnMouse('tile16')" onmouseout="tileOnMouseOut('tile16')"><span class="hide"><text id="tile16txt" class="txt"><?php echo rand(1, 5); ?></span></text></div>
<div id="tile17" class="tile" onclick="tileClick('tile17')" onmouseover="tileOnMouse('tile17')" onmouseout="tileOnMouseOut('tile17')"><span class="hide"><text id="tile17txt" class="txt"><?php echo rand(1, 5); ?></span></text></div>
<div id="tile18" class="tile" onclick="tileClick('tile18')" onmouseover="tileOnMouse('tile18')" onmouseout="tileOnMouseOut('tile18')"><span class="hide"><text id="tile18txt" class="txt"><?php echo rand(1, 5); ?></span></text></div>
<div id="tile19" class="tile" onclick="tileClick('tile19')" onmouseover="tileOnMouse('tile19')" onmouseout="tileOnMouseOut('tile19')"><span class="hide"><text id="tile19txt" class="txt"><?php echo rand(1, 5); ?></span></text></div>
<div id="tile20" class="tile" onclick="tileClick('tile20')" onmouseover="tileOnMouse('tile20')" onmouseout="tileOnMouseOut('tile20')"><span class="hide"><text id="tile20txt" class="txt"><?php echo rand(1, 5); ?></span></text></div>
<div class="tileFront"></div>
<div id="tile21" class="tile" onclick="tileClick('tile21')" onmouseover="tileOnMouse('tile21')" onmouseout="tileOnMouseOut('tile21')"><span class="hide"><text id="tile21txt" class="txt"><?php echo rand(1, 5); ?></span></text></div>
<div id="tile22" class="tile" onclick="tileClick('tile22')" onmouseover="tileOnMouse('tile22')" onmouseout="tileOnMouseOut('tile22')"><span class="hide"><text id="tile22txt" class="txt"><?php echo rand(1, 5); ?></span></text></div>
<div id="tile23" class="tile" onclick="tileClick('tile23')" onmouseover="tileOnMouse('tile23')" onmouseout="tileOnMouseOut('tile23')"><span class="hide"><text id="tile23txt" class="txt"><?php echo rand(1, 5); ?></span></text></div>
<div id="tile24" class="tile" onclick="tileClick('tile24')" onmouseover="tileOnMouse('tile24')" onmouseout="tileOnMouseOut('tile24')"><span class="hide"><text id="tile24txt" class="txt"><?php echo rand(1, 5); ?></span></text></div>
<div id="tile25" class="tile" onclick="tileClick('tile25')" onmouseover="tileOnMouse('tile25')" onmouseout="tileOnMouseOut('tile25')"><span class="hide"><text id="tile25txt" class="txt"><?php echo rand(1, 5); ?></span></text></div>
<div class="tileFront"></div>
<br><br>
<div id="forms">
<form id="form_exchange" method="post" action="getCoin.php" >
ただ今<input type="text" readonly value="0" id="point" name="coin">ポイント
<br><br>
<?php
echo '<table>';
echo '<tbody>';
echo '<tr>';
for($i = 1;$i<26;$i++){
echo '<td id="tile'.$i.'tbl"></td>';
}
echo '</tr>';
echo '</tbody>';
echo '</table>';
?>
<input type="submit" value="金貨をゲットする" id="button_exchange">
</form>
</div>
</div>
<br><a href="/tilegame.php">戻る<a>
</body>
</html>