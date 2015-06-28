<?php
session_start();
if(!isset($_SESSION["id"]))
//Case セッション破棄
{header("Location: /index.php");exit;}
	//DB接続
	$pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト', 'ユーザ名', 'パスワード');
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

	</style>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	<script type="text/javascript">
	<!--
	//　======================================================================
	//　###変数###
	//　GAME_OVER_FLG
	var gameOver = 0;
	// プレイ回数
	var play = 0;
	// クリックしたパネル数
	var click = 0;

	// ###関数###
	// プレイ回数の取得
	function getPlayCount(){
		return play;
	}//--------------------------------------------

	// プレイ回数の加算
	function addPlayCount(){
		play++;
	}//--------------------------------------------

	// プレイ回数のクリア
	function clearPlayCount(){
		play = 0;
	}//--------------------------------------------

	// パネルのアウトセーフ判別
	function judgePanel(panelNum){
		var judge = $(':hidden[name='+panelNum+']').val();
		if(judge=1){
			return true;
		}else{
			return false;
		}

	}//--------------------------------------------
	// 積み立てポイントのクリア
	function clearTumitatePoint(){
		jQuery('.tumitatePointVal').val(0);
	}//-----------------------------------------------------
	//　積み立てポイントを加算
	function addTumitatePoint(){
		point = jQuery('.tumitatePointVal').val();
		point = parseInt(point);
		jQuery('.tumitatePointVal').val(point+10);

	}
	//　クリックしたパネルの色を変更(セーフ)
	function changeClickedSafePanelColor(){
			$('#panel'+panelNum).css('background-color', '#dd99ff');
			$('#panel'+panelNum).css('background-image', 'url(/tilegameimg/syldra.png)');
			$('#panel'+panelNum).css('background-repeat', 'no-repeat');
	}

	// クリックしたパネルの色を変更(アウト)
	function changeClickedOutPanelColor(){
		$('#panel'+panelNum).css('background-color', '#ffaa99');
	}

	//　ゲームオーバー判定
	function judgeGameover(gameOver){
		if(gameOver==1){
			return true;
		}else{
			return false;
		}
	}

	// ゲームオーバーに変更
	function changeGameOver(){
		gameOver = 1;
	}

	//　パネルをクリック済みに変更
	function changePanelStatus(panelNum){
		$(':hidden[name='+panelNum+']').val("returned");
	}

	// パネルのクリック済み判定
	function judgePanelStatus(panelNum){
		var　returnFlg　= $(':hidden[name='+panelNum+']').val();
		if(returnFlg=="returned"){
			return true;
		}else{
			return false;
		}
	}

	//　クリックしたパネル数の取得
	function getClickCount(click){
		return click;
	}
	//　クリックしたパネル数を加算
	function addClickCount(){
		click++;
	}
	// カーソルがパネルに乗った時の色変更
	function onPanel(panelNum){
		alert(panelNum);
				if($($('#panel'+panelNum)).css('background-color')!=="rgb(255, 170, 153)"){
					$('#panel'+panelNum).css('background-color', '#aa99ff');
					alert(panelNum);
				}
	}
	//　カーソルがパネルを外れた時の色変更
	function outPanel(panelNum){
				if($('#panel'+panelNum).css('background-color')!=="rgb(255, 170, 153)"){
					if($('#panel'+panelNum).css('background-color')!=='#dd99ff'){
						$('#panel'+panelNum).css('background-color', '#99aaff');
					}
				}
	}
	// 積み立てポイントを総ポイントに加算し最新の総ポイントを返す
	function addTumitatePointToTotalPoint(){
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
				alert(data);
			}
		});
	}

	//　メッセージの表示
	function displayMessage(msg){
				switch (msg){
			//play=0
			case 1:
			alert("start...");
			break;
			//play=10 +
			case 2:
			alert("re-try?need_a_coin");
			break;
			//play=1~9 +
			case 3:
			alert("re-try?");
			break;
			//play=1~9 and click = 25 +
			case 4:
			alert("turnALLpanels...continue?");
			break;
			//play=10 or go = 1 and click = 25 +
			case 5:
			alert("turnALLpanels...end");
			break;
			//play = 10 dropped
			case 6:
			alert("you dropped");
			break;
			//play = 1~9 dropped
			case 7:
			alert("you dropped.continue?")
			break;
		}
	}
	//パネルクリック処理
		function clickPanel(panelNum){
			//============================GO判定
			if(judgeGameover(gameOver)){
			//-------------------ゲームオーバー時の処理

			}else{
			//-------------------ゲームオーバーではない時の処理
			addPlayCount();
			//==================クリック済み判定
			if(judgePanelStatus(panelNum)){
				//===========クリック済みの処理
			}else{
				//===========未クリックの処理
				if(judgePanel(panelNum)){
					//アウト
					changeClickedOutPanelColor();
					changeGameOver();
					clearTumitatePoint();
					//MSG分岐
					switch(getPlayCount()){
						case 10:
						displayMessage(2);
						break;
						default:
						displayMessage(3);
						break;

					}

				}else{
					//セーフ
					changePanelStatus(panelNum);
					addClickCount();
					addTumitatePoint();
					//MSG分岐
					switch(getPlayCount()){
						case 10:
						if(getClickCount==25){
							displayMessage(5);
						};
						break;
						default:
						if(getClickCount==25){
							displayMessage(4);
						};
						break;
			}

			}
		}

	//　ドロップアウト処理
	function dropOut(){
		addTumitatePointToTotalPoint();
		if(getPlayCount==10){
			displayMessage(6);
		}else{
			displayMessage(7);
		}
	}

	// -->
	</script>
</head>
<body>
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
				<div class="panel" id="panel1" onclick="clickPanel(1)" onmouseover="onPanel(1)" onmouseout="outPanel(1)"><input type="hidden" name="1" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel2" onclick="clickPanel(2)" onmouseover="onPanel(2)" onmouseout="outPanel(2)"><input type="hidden" name="2" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel3" onclick="clickPanel(3)" onmouseover="onPanel(3)" onmouseout="outPanel(3)"><input type="hidden" name="3" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel4" onclick="clickPanel(4)" onmouseover="onPanel(4)" onmouseout="outPanel(4)"><input type="hidden" name="4" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel5" onclick="clickPanel(5)" onmouseover="onPanel(5)" onmouseout="outPanel(5)"><input type="hidden" name="5" value="<?php echo rand(1, 6); ?>"></div>
				<div id="panelFront"></div>
				<div class="panel" id="panel6" onclick="clickPanel(6)" onmouseover="onPanel(6)" onmouseout="outPanel(6)"><input type="hidden" name="6" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel7" onclick="clickPanel(7)" onmouseover="onPanel(7)" onmouseout="outPanel(7)"><input type="hidden" name="7" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel8" onclick="clickPanel(8)" onmouseover="onPanel(8)" onmouseout="outPanel(8)"><input type="hidden" name="8" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel9" onclick="clickPanel(9)" onmouseover="onPanel(9)" onmouseout="outPanel(9)"><input type="hidden" name="9" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel10" onclick="clickPanel(10)" onmouseover="onPanel(10)" onmouseout="outPanel(10)"><input type="hidden" name="10" value="<?php echo rand(1, 6); ?>"></div>
				<div id="panelFront"></div>
				<div class="panel" id="panel11" onclick="clickPanel(11)" onmouseover="onPanel(11)" onmouseout="outPanel(11)"><input type="hidden" name="11" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel12" onclick="clickPanel(12)" onmouseover="onPanel(12)" onmouseout="outPanel(12)"><input type="hidden" name="12" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel13" onclick="clickPanel(13)" onmouseover="onPanel(13)" onmouseout="outPanel(13)"><input type="hidden" name="13" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel14" onclick="clickPanel(14)" onmouseover="onPanel(14)" onmouseout="outPanel(14)"><input type="hidden" name="14" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel15" onclick="clickPanel(15)" onmouseover="onPanel(15)" onmouseout="outPanel(15)"><input type="hidden" name="15" value="<?php echo rand(1, 6); ?>"></div>
				<div id="panelFront"></div>
				<div class="panel" id="panel16" onclick="clickPanel(16)" onmouseover="onPanel(16)" onmouseout="outPanel(16)"><input type="hidden" name="16" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel17" onclick="clickPanel(17)" onmouseover="onPanel(17)" onmouseout="outPanel(17)"><input type="hidden" name="17" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel18" onclick="clickPanel(18)" onmouseover="onPanel(18)" onmouseout="outPanel(18)"><input type="hidden" name="18" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel19" onclick="clickPanel(19)" onmouseover="onPanel(19)" onmouseout="outPanel(19)"><input type="hidden" name="19" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel20" onclick="clickPanel(20)" onmouseover="onPanel(20)" onmouseout="outPanel(20)"><input type="hidden" name="20" value="<?php echo rand(1, 6); ?>"></div>
				<div id="panelFront"></div>
				<div class="panel" id="panel21" onclick="clickPanel(21)" onmouseover="onPanel(21)" onmouseout="outPanel(21)"><input type="hidden" name="21" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel22" onclick="clickPanel(22)" onmouseover="onPanel(22)" onmouseout="outPanel(22)"><input type="hidden" name="22" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel23" onclick="clickPanel(23)" onmouseover="onPanel(23)" onmouseout="outPanel(23)"><input type="hidden" name="23" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel24" onclick="clickPanel(24)" onmouseover="onPanel(24)" onmouseout="outPanel(24)"><input type="hidden" name="23" value="<?php echo rand(1, 6); ?>"></div>
				<div class="panel" id="panel25" onclick="clickPanel(25)" onmouseover="onPanel(25)" onmouseout="outPanel(25)"><input type="hidden" name="25" value="<?php echo rand(1, 6); ?>"></div>
			</div>
			<!-- メッセージ表示エリアのDIV -->
			<div class="messageArea">
			</div>
		</div>
	</div>
</body>
</html>