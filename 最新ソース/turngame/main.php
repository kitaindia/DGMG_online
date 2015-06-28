<?php
session_start();
//セッションが破棄されている場合は、トップページへ遷移する
if(!isset($_SESSION["id"]))
	{header("Location: /index.php");exit;}
//コインを未消費の場合はconfirm.phpへ戻る
if($_SESSION["turnGameCOIN"]!==1){
	{header("Location: http://syldra.secret.jp/turngame/confirm.php");exit;}
}
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
	<title>めくってシルドラくん-メイン-</title>
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
		margin-top:35px;
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
		background-color: #aaff99;
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
	.demo1 button, .demo1 input[type=button],  
.demo1 input[type=reset], .demo1 input[type=submit] {  
    background: -moz-linear-gradient(top, #fff, #F1F1F1 1%, #F1F1F1 50%, #DFDFDF 99%, #ccc);  
    background: -webkit-gradient(linear, left top, left bottom, from(#fff), color-stop(0.01, #F1F1F1), color-stop(0.5, #F1F1F1), color-stop(0.99, #DFDFDF), to(#ccc));  
    -moz-box-shadow: 1px 1px 2px #E7E7E7;  
    -webkit-box-shadow: 1px 1px 2px #E7E7E7;  
}  
.demo1 button:hover, .demo1 input[type=button]:hover,  
.demo1 input[type=reset]:hover, .demo1 input[type=submit]:hover {  
    background: -moz-linear-gradient(top, #fff, #e1e1e1 1%, #e1e1e1 50%, #cfcfcf 99%, #ccc);  
    background: -webkit-gradient(linear, left top, left bottom, from(#fff), color-stop(0.01, #e1e1e1), color-stop(0.5, #e1e1e1), color-stop(0.99, #cfcfcf), to(#ccc));  
}  
.demo1 button:active, .demo1 input[type=button]:active,  
.demo1 input[type=reset]:active, .demo1 input[type=submit]:active   {  
    background: #ccc;  
    padding: 6px 20px 4px;  
}  
	</style>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		//=======パネルクリックの処理=========
		$(".panel").click(function(){
			var judgeNum = $(this).attr("id");
			switch(judgeNum){
			//judgeNumが１(=アウトのパネル)
			case "1":
			//********ゲームオーバーの処理
			$(this).css('background-color', 'red');
			//続行or終了確認後遷移
			var retry = confirm('GAME OVER...\nもう一度遊びますか？')
			if(retry==true){
				//ポイントをクリアする
				$('.tumitatePointVal').val(0);
				//確認画面へ遷移
				window.location.replace("http://syldra.secret.jp/turngame/confirm.php");
			}else{
				//トップページへ遷移
				window.location.replace("http://syldra.secret.jp/index.php");
			}
			break;
			//judgeNumが７(=クリック済みのパネル)
			case "8":
			break;
			//judgeNumが１，７以外（＝未クリック且つセーフのパネル）
			default:
			//********ゲーム続行の処理
			//パネルの色を変更する
			$(this).css('background-color', 'blue');
			$(this).css('background-image', 'url(/turngame/syldra.png)');
			$(this).css('background-repeat', 'no-repeat');
			//パネルをクリック済みに変更する
			$(this).attr('id',"8");
			//フォームにポイントを加算する
			var tumitatePointNow = parseInt($('.tumitatePointVal').val());
			$('.tumitatePointVal').val(tumitatePointNow+10);
			break;
		}
	});
	//===========パネルクリックの処理ここまで===============
	});
	</script>
</head>
<body>
	<div id="header">
<?php include( $_SERVER['DOCUMENT_ROOT'] . '/dropDownMenu.php'); ?>
</div>
		<!-- ゲームメインのDIV -->
		<div class="gameBody">
			<!-- ゲームメイン右側のDIV -->
			<div class="gameBodyRight">
				<!-- \現在の積み立て額のDIV -->
				<div class="tumitatePoint">
					<font>現在の積み立てポイント</font>
					<br>
					<form action="success.php" method="POST">
					<input class="tumitatePointVal" name="point" type="text" value="0" readonly>
				</div>
				<!-- 現在の所持ポイントのDIV -->
				<div class="possessPoint"><font>現在の所持ポイント</font><br><input class="possessPointVal" type="text" name="newPoint" value="<?php echo $newPoint; ?>"readonly></div>
				<!-- ドロップアウトボタンのDIV -->
				<section class="demo1">  
				<div class="dropOutButton"><input type="submit" name="submit" value="ドロップアウト"></div>
				</section>
				</form>
			</div>
			<!-- ゲームメイン左側のDIV -->
			<div class="gameBodyLeft">
				<!-- パネル（５＊５）のDIV -->
				<div class="panels">
					<!-- 各パネルのDIV -->
					<div class="panel" id="<?php echo rand(1, 7); ?>"></div>
					<div class="panel" id="<?php echo rand(1, 7); ?>"></div>
					<div class="panel" id="<?php echo rand(1, 7); ?>"></div>
					<div class="panel" id="<?php echo rand(1, 7); ?>"></div>
					<div class="panel" id="<?php echo rand(1, 7); ?>"></div>
					<div id="panelFront"></div>
					<div class="panel" id="<?php echo rand(1, 7); ?>"></div>
					<div class="panel" id="<?php echo rand(1, 7); ?>"></div>
					<div class="panel" id="<?php echo rand(1, 7); ?>"></div>
					<div class="panel" id="<?php echo rand(1, 7); ?>"></div>
					<div class="panel" id="<?php echo rand(1, 7); ?>"></div>
					<div id="panelFront"></div>
					<div class="panel" id="<?php echo rand(1, 7); ?>"></div>
					<div class="panel" id="<?php echo rand(1, 7); ?>"></div>
					<div class="panel" id="<?php echo rand(1, 7); ?>"></div>
					<div class="panel" id="<?php echo rand(1, 7); ?>"></div>
					<div class="panel" id="<?php echo rand(1, 7); ?>"></div>
					<div id="panelFront"></div>
					<div class="panel" id="<?php echo rand(1, 7); ?>"></div>
					<div class="panel" id="<?php echo rand(1, 7); ?>"></div>
					<div class="panel" id="<?php echo rand(1, 7); ?>"></div>
					<div class="panel" id="<?php echo rand(1, 7); ?>"></div>
					<div class="panel" id="<?php echo rand(1, 7); ?>"></div>
					<div id="panelFront"></div>
					<div class="panel" id="<?php echo rand(1, 7); ?>"></div>
					<div class="panel" id="<?php echo rand(1, 7); ?>"></div>
					<div class="panel" id="<?php echo rand(1, 7); ?>"></div>
					<div class="panel" id="<?php echo rand(1, 7); ?>"></div>
					<div class="panel" id="<?php echo rand(1, 7); ?>"></div>
				</div>
			</div>
		</body>
		</html>