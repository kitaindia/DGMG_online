<?php
session_start();
if(!isset($_SESSION["id"]))
//Case セッション破棄
{header("Location: /index.php");exit;}
	//DB接続
	$pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト名', 'ユーザー名', 'パスワード');
	$pdo->query('SET NAMES utf8');
	//ID取得
	$USER_ID = $_SESSION['id'];
	//現在所持ポイントを取得
	$stmt = $pdo->prepare("SELECT POINTS FROM TEST_GAME where USER_ID = ?");
	$stmt -> execute(array($USER_ID));
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$newPoint = $row["POINTS"];
		break;
	}
	?>
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
	.gameBody{
		float:left;
	}
	.gameBodyLeft{
		position: relative;
		float:right;
		background-color: #99ffee;
		width:300px;
		height:300px;
	}
	.panels{
		position: absolute;
		width:220px;
		height:220px;
		margin-top:20px;
		margin-left:35px;
	}
	.panel{
		float:left;
		width:44px;
		height:44px;
		background-color: #99aaff;
		
	}
	#panelFront{
		width:0px;
		height:0px;
		clear:both;
	}
	.messageArea{
		position: absolute;
		width:220px;
		height:50px;
		top:240px;
		left:35px;
		background-color: #ddff99;
		z-index: 0;
	}
	.gameBodyRight{
		position: relative;
		float:right;
		background-color: #aaff99;
		width:185px;
		height:300px;
	}
	.tumitatePoint{
		background-color: #ddff99;
		position: absolute;
		width:145px;
		height:50px;
		top:20px;
		left:20px;
	}
	.possessPoint{
		background-color: #ddff99;
		position: absolute;
		width:145px;
		height:50px;
		top:90px;
		left:20px;
	}
	.dropOutButton{
		background-color: #ddff99;
		position: absolute;
		width:105px;
		height:50px;
		top:190px;
		left:40px;
		font-size: 15px;
		text-align: center;
	}
	body {
		font-size: 12px;
		font-family: "メイリオ", sans-serif;
	}
	body input {
		width:120px;
		text-align: center;
	}
	#dropOutButton {
		text-align: center;
	}
	.dropOutFont{
		padding:10px 40px;
	}
	/** MSGs **/
	#MSG_GO_over10{
		position: absolute;
		width:220px;
		height:50px;
		top:240px;
		left:35px;
		background-color: #ddff99;
		z-index: -1;
	}
	#MSG_GO_under10{
		position: absolute;
		width:220px;
		height:50px;
		top:240px;
		left:35px;
		background-color: #ddff99;
		z-index: -1;
	}
	#MSG_RC_25_under10{
		position: absolute;
		width:220px;
		height:50px;
		top:240px;
		left:35px;
		background-color: #ddff99;
		z-index: -1;
	}
	#MSG_RC_25_over10{
		position: absolute;
		width:220px;
		height:50px;
		top:240px;
		left:35px;
		background-color: #ddff99;
		z-index: -1;
	}
	#MSG_starting{
		position: absolute;
		width:220px;
		height:50px;
		top:240px;
		left:35px;
		background-color: #ddff99;
		z-index: -1;
	}
	#MSG_dropDown_under10{
		position: absolute;
		width:220px;
		height:50px;
		top:240px;
		left:35px;
		background-color: #ddff99;
		z-index: -1;
	}
	#MSG_dropDown_over10{
		position: absolute;
		width:220px;
		height:50px;
		top:240px;
		left:35px;
		background-color: #ddff99;
		z-index: -1;
	}
	</style>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script type="text/javascript">
	<!--
	//####初期設定用変数####
	//==GAMEOVERフラグ
	var gameOver = 0;
	//==プレイ回数
	var playCount = 0;
	//==ひっくり返したパネル数
	var returnedCount = 0;
	//####各メソッド宣言####
	//==プレイ回数取得
	function getCount(){
		//ajax処理
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: 'getPlayCount.php',
			success: function(data){
				playCount = data;
			}
		});
	        //初回の場合は、初回MSGを表示
	        dispMSG(5);
	    }
	//==ポイントクリア
	function clearPoint(){
		jQuery('.tumitatePointVal').val(0);
	}
	//==ポイントプラス
	function addPoint(){
		point = jQuery('.tumitatePointVal').val();
		point = parseInt(point);
		jQuery('.tumitatePointVal').val(point+10);
	}
	//==パネルカラーチェンジ
	function changePanel(outOrSafe,panelNum){
		if(outOrSafe!=1){
			$('#panel'+panelNum).css('background-color', '#dd99ff');
			$('#panel'+panelNum).css('background-image', 'url(/tilegameimg/syldra.png)');
			$('#panel'+panelNum).css('background-repeat', 'no-repeat');
		}else{
			gameOver = 1;
			$('#panel'+panelNum).css('background-color', '#ffaa99');
		}
	}
	//==パネルクリック処理
	function turnPanel(panelNum){
		$(function(){
			if(gameOver==0&&returnedCount!=25){
		//クリックしたパネルのHiddenを参照し、パネルのアウトorセーフを判別
		var outOrSafe = $(':hidden[name='+panelNum+']').val();
		//outOrSafe==1ならアウト
		if(outOrSafe == 1){
			//積み立てポイントをクリア
			alert("a");
			clearPoint();
			changePanel(outOrSafe,panelNum);
			switch(playCount){
			//playCountが１０
			case 10:
			dispMSG(1);
			break;
			//playCountが１０未満
			default:
			dispMSG(2);
			break;
		}
	}
}
		//outOrSafe==1以外ならセーフ
		else{
			var returnedFlg = $(':hidden[name='+panelNum+']').val();
			//クリック済みで無ければ積み立てポイントにプラス
			if(returnedFlg!="returned"){
				addPoint();
				changePanel(outOrSafe,panelNum);
			//返した回数をプラス１
			returnedCount++;
			//パネルをクリック済みに変更
			$(':hidden[name='+panelNum+']').val("returned");
			if(returnedCount==25){
				switch(playCount){
			//返した回数が２５で１０回プレイした場合
			case 10:
			dispMSG(4);
			break;
			//返した回数が２５で１０回未満の場合
			default:
			dispMSG(3);
			break;
		}
	}
}
}
});
	}
	//==カーソルオンパネル処理
	function onPanel(panelNum){
		$(function(){
			if(gameOver==0){
				if($($('#panel'+panelNum)).css('background-color')!=="rgb(255, 170, 153)"){
					$('#panel'+panelNum).css('background-color', '#aa99ff');
				}
			}
		});
	}
	//==カーソルアウトパネル処理
	function outPanel(panelNum){
		$(function(){
			if(gameOver==0){
				if($('#panel'+panelNum).css('background-color')!=="rgb(255, 170, 153)"){
					if($('#panel'+panelNum).css('background-color')!=='#dd99ff'){
						$('#panel'+panelNum).css('background-color', '#99aaff');
					}
				}
			}
		});	
	}
	//==ドロップアウト処理
	function dropOut(){
		point = jQuery('.tumitatePointVal').val();
		point = parseInt(point);
		//ajax処理
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: 'dropOut.php',
			data:{
				totalPoint:point
			},
			success: function(data){
				var getPoint = data;
			}
		});
		switch(playCount){
	    //playCountが１０回
	    case 10:
	    dispMSG(7);
	    break;
	    //playCountが１０回未満
	    default:
	    dispMSG(6);
	    break;
	}
}
	//==メッセージ表示関数
	function dispMSG(msg){
		switch (msg){
			case 1:
			$('.MSG_GO_over10').css('z-index', '1');
			$('.MSG_GO_under10').css('z-index', '-1');
			$('.MSG_RC_25_under10').css('z-index', '-1');
			$('.MSG_RC_25_over10').css('z-index', '-1');
			$('.MSG_starting').css('z-index', '-1');
			$('.MSG_dropDown_under10').css('z-index', '-1');
			$('.MSG_dropDown_over10').css('z-index', '-1');
			break;
			case 2:
			$('.MSG_GO_over10').css('z-index', '-1');
			$('.MSG_GO_under10').css('z-index', '1');
			$('.MSG_RC_25_under10').css('z-index', '-1');
			$('.MSG_RC_25_over10').css('z-index', '-1');
			$('.MSG_starting').css('z-index', '-1');
			$('.MSG_dropDown_under10').css('z-index', '-1');
			$('.MSG_dropDown_over10').css('z-index', '-1');
			break;
			case 3:
			$('.MSG_GO_over10').css('z-index', '-1');
			$('.MSG_GO_under10').css('z-index', '-1');
			$('.MSG_RC_25_under10').css('z-index', '1');
			$('.MSG_RC_25_over10').css('z-index', '-1');
			$('.MSG_starting').css('z-index', '-1');
			$('.MSG_dropDown_under10').css('z-index', '-1');
			$('.MSG_dropDown_over10').css('z-index', '-1');
			break;
			case 4:
			$('.MSG_GO_over10').css('z-index', '-1');
			$('.MSG_GO_under10').css('z-index', '-1');
			$('.MSG_RC_25_under10').css('z-index', '-1');
			$('.MSG_RC_25_over10').css('z-index', '1');
			$('.MSG_starting').css('z-index', '-1');
			$('.MSG_dropDown_under10').css('z-index', '-1');
			$('.MSG_dropDown_over10').css('z-index', '-1');
			break;
			case 5:
			$('.MSG_GO_over10').css('z-index', '-1');
			$('.MSG_GO_under10').css('z-index', '-1');
			$('.MSG_RC_25_under10').css('z-index', '-1');
			$('.MSG_RC_25_over10').css('z-index', '-1');
			$('.MSG_starting').css('z-index', '1');
			$('.MSG_dropDown_under10').css('z-index', '-1');
			$('.MSG_dropDown_over10').css('z-index', '-1');
			break;
			case 6:
			$('.MSG_GO_over10').css('z-index', '-1');
			$('.MSG_GO_under10').css('z-index', '-1');
			$('.MSG_RC_25_under10').css('z-index', '-1');
			$('.MSG_RC_25_over10').css('z-index', '-1');
			$('.MSG_starting').css('z-index', '-1');
			$('.MSG_dropDown_under10').css('z-index', '1');
			$('.MSG_dropDown_over10').css('z-index', '-1');
			break;
			case 7:
			$('.MSG_GO_over10').css('z-index', '-1');
			$('.MSG_GO_under10').css('z-index', '-1');
			$('.MSG_RC_25_under10').css('z-index', '-1');
			$('.MSG_RC_25_over10').css('z-index', '-1');
			$('.MSG_starting').css('z-index', '-1');
			$('.MSG_dropDown_under10').css('z-index', '-1');
			$('.MSG_dropDown_over10').css('z-index', '1');
			break;
		}
	}
	// -->
	</script>
</head>
<body　onload="getCount()">

	<!-- ゲームメインのDIV -->
	<div class="gameBody">
		<!-- ゲームメイン右側のDIV -->
		<div class="gameBodyRight">
			<!-- \現在の積み立て額のDIV -->
			<div class="tumitatePoint"><font>現在の積み立てポイント</font><br><input class="tumitatePointVal" name="point" type="text" value="0" readonly></div>
			<!-- 現在の所持ポイントのDIV -->
			<div class="possessPoint"><font>現在の所持ポイント</font><br><input class="possessPointVal" type="text" name="newPoint" value="<?php echo $newPoint; ?>"readonly></div>
			<!-- ドロップアウトボタンのDIV -->
			<div class="dropOutButton" onclick="dropOut();"><font id="dropOutFont">ドロップアウト</font></div>
		</div>
		<!-- ゲームメイン左側のDIV -->
		<div class="gameBodyLeft">
			<!-- パネル（５＊５）のDIV -->
			<div class="panels">
				<!-- 各パネルのDIV -->
				<div class="panel" id="panel1" onclick="turnPanel(1)" onmouseover="onPanel(1)" onmouseout="outPanel(1)"><input type="hidden" name="1" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel2" onclick="turnPanel(2)" onmouseover="onPanel(2)" onmouseout="outPanel(2)"><input type="hidden" name="2" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel3" onclick="turnPanel(3)" onmouseover="onPanel(3)" onmouseout="outPanel(3)"><input type="hidden" name="3" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel4" onclick="turnPanel(4)" onmouseover="onPanel(4)" onmouseout="outPanel(4)"><input type="hidden" name="4" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel5" onclick="turnPanel(5)" onmouseover="onPanel(5)" onmouseout="outPanel(5)"><input type="hidden" name="5" value="<?php echo rand(1, 6); ?>"></div>
				<div id="panelFront"></div>
				<div class="panel" id="panel6" onclick="turnPanel(6)" onmouseover="onPanel(6)" onmouseout="outPanel(6)"><input type="hidden" name="6" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel7" onclick="turnPanel(7)" onmouseover="onPanel(7)" onmouseout="outPanel(7)"><input type="hidden" name="7" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel8" onclick="turnPanel(8)" onmouseover="onPanel(8)" onmouseout="outPanel(8)"><input type="hidden" name="8" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel9" onclick="turnPanel(9)" onmouseover="onPanel(9)" onmouseout="outPanel(9)"><input type="hidden" name="9" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel10" onclick="turnPanel(10)" onmouseover="onPanel(10)" onmouseout="outPanel(10)"><input type="hidden" name="10" value="<?php echo rand(1, 6); ?>"></div>
				<div id="panelFront"></div>
				<div class="panel" id="panel11" onclick="turnPanel(11)" onmouseover="onPanel(11)" onmouseout="outPanel(11)"><input type="hidden" name="11" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel12" onclick="turnPanel(12)" onmouseover="onPanel(12)" onmouseout="outPanel(12)"><input type="hidden" name="12" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel13" onclick="turnPanel(13)" onmouseover="onPanel(13)" onmouseout="outPanel(13)"><input type="hidden" name="13" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel14" onclick="turnPanel(14)" onmouseover="onPanel(14)" onmouseout="outPanel(14)"><input type="hidden" name="14" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel15" onclick="turnPanel(15)" onmouseover="onPanel(15)" onmouseout="outPanel(15)"><input type="hidden" name="15" value="<?php echo rand(1, 6); ?>"></div>
				<div id="panelFront"></div>
				<div class="panel" id="panel16" onclick="turnPanel(16)" onmouseover="onPanel(16)" onmouseout="outPanel(16)"><input type="hidden" name="16" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel17" onclick="turnPanel(17)" onmouseover="onPanel(17)" onmouseout="outPanel(17)"><input type="hidden" name="17" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel18" onclick="turnPanel(18)" onmouseover="onPanel(18)" onmouseout="outPanel(18)"><input type="hidden" name="18" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel19" onclick="turnPanel(19)" onmouseover="onPanel(19)" onmouseout="outPanel(19)"><input type="hidden" name="19" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel20" onclick="turnPanel(20)" onmouseover="onPanel(20)" onmouseout="outPanel(20)"><input type="hidden" name="20" value="<?php echo rand(1, 6); ?>"></div>
				<div id="panelFront"></div>
				<div class="panel" id="panel21" onclick="turnPanel(21)" onmouseover="onPanel(21)" onmouseout="outPanel(21)"><input type="hidden" name="21" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel22" onclick="turnPanel(22)" onmouseover="onPanel(22)" onmouseout="outPanel(22)"><input type="hidden" name="22" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel23" onclick="turnPanel(23)" onmouseover="onPanel(23)" onmouseout="outPanel(23)"><input type="hidden" name="23" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel24" onclick="turnPanel(24)" onmouseover="onPanel(24)" onmouseout="outPanel(24)"><input type="hidden" name="23" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel25" onclick="turnPanel(25)" onmouseover="onPanel(25)" onmouseout="outPanel(25)"><input type="hidden" name="25" value="<?php echo rand(1, 6); ?>"></div>
			</div>
			<!-- メッセージ表示エリアのDIV -->
			<div class="messageArea"></div>
			<!-- １-->
			<div id="MSG_GO_over10">
				GAME OVER<br>
				１コインを消費してもう一度遊びますか？<br>
				<input type="button" value="はい" oclick="retry()">
				<input type="button" value="いいえ" oclick="retry()">
			</div>

			<!-- ２-->
			<div id="MSG_GO_under10">
				GAME OVER<br>
				引き続き遊びますか？（残り<script>document.write(playCount);</script>回）<br>
				<input type="button" value="はい" oclick="retry()">
				<input type="button" value="いいえ" oclick="retry()">
			</div>

			<!-- ３-->
			<div id="MSG_RC_25_under10">
				なにぃ！？全てひっくり返しただとぉ！？<br>
				・・・引き続き遊びますか？（残り<script>document.write(playCount);</script>回）<br>
				<input type="button" value="はい" oclick="retry()">
				<input type="button" value="いいえ" oclick="retry()">
			</div>

			<!-- ４-->
			<div id="MSG_RC_25_over10">
				なにぃ！？全てひっくり返したとぉ！？<br>
				・・・１コインを消費してもっぺん遊ぶ？<br>
				<input type="button" value="はい" oclick="retry()">
				<input type="button" value="いいえ" oclick="retry()">
			</div>

			<!-- ５-->
			<div id="MSG_starting">
				１コインを使って１０回プレイできるよ。<br>
				遊ぶ？<br>
				<input type="button" value="はい" oclick="retry()">
				<input type="button" value="いいえ" oclick="retry()">
			</div>

			<!-- ６-->
			<div id="MSG_dropDown_under10">
				賢明にもドロップアウトし○○ポイントを獲得しました。<br>
				引き続き遊ぶ？（残り<script>document.write(playCount);</script>回）<br>
				<input type="button" value="はい" oclick="retry()">
				<input type="button" value="いいえ" oclick="retry()">
			</div>

			<!-- ７-->
			<div id="MSG_dropDown_over10">
				賢明にもドロップアウトし<script>document.write(getPoint);</script>ポイントを獲得しました。<br>
				１コインを消費してもう一度遊びますか？<br>
				<input type="button" value="はい" oclick="retry()">
				<input type="button" value="いいえ" oclick="retry()">
			</div>
		</div>
	</div>
</body>
</html>