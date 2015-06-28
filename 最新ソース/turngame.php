<?php
session_start();
//セッションが破棄されている場合は、トップページへ遷移する
if(!isset($_SESSION["id"]))
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
	</style>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script type="text/javascript">
	</script>
</head>
<body>
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
					<div class="panel" id="panel1"><input type="hidden" name="1" value="<?php echo rand(1, 6); ?>"></div>
					<div class="panel" id="panel2"><input type="hidden" name="2" value="<?php echo rand(1, 6); ?>"></div>
					<div class="panel" id="panel3"><input type="hidden" name="3" value="<?php echo rand(1, 6); ?>"></div>
					<div class="panel" id="panel4"><input type="hidden" name="4" value="<?php echo rand(1, 6); ?>"></div>
					<div class="panel" id="panel5"><input type="hidden" name="5" value="<?php echo rand(1, 6); ?>"></div>
					<div id="panelFront"></div>
					<div class="panel" id="panel6"><input type="hidden" name="6" value="<?php echo rand(1, 6); ?>"></div>
					<div class="panel" id="panel7"><input type="hidden" name="7" value="<?php echo rand(1, 6); ?>"></div>
					<div class="panel" id="panel8"><input type="hidden" name="8" value="<?php echo rand(1, 6); ?>"></div>
					<div class="panel" id="panel9" ><input type="hidden" name="9" value="<?php echo rand(1, 6); ?>"></div>
					<div class="panel" id="panel10"><input type="hidden" name="10" value="<?php echo rand(1, 6); ?>"></div>
					<div id="panelFront"></div>
					<div class="panel" id="panel11"><input type="hidden" name="11" value="<?php echo rand(1, 6); ?>"></div>
					<div class="panel" id="panel12"><input type="hidden" name="12" value="<?php echo rand(1, 6); ?>"></div>
					<div class="panel" id="panel13"><input type="hidden" name="13" value="<?php echo rand(1, 6); ?>"></div>
					<div class="panel" id="panel14"><input type="hidden" name="14" value="<?php echo rand(1, 6); ?>"></div>
					<div class="panel" id="panel15"><input type="hidden" name="15" value="<?php echo rand(1, 6); ?>"></div>
					<div id="panelFront"></div>
					<div class="panel" id="panel16"><input type="hidden" name="16" value="<?php echo rand(1, 6); ?>"></div>
					<div class="panel" id="panel17"><input type="hidden" name="17" value="<?php echo rand(1, 6); ?>"></div>
					<div class="panel" id="panel18"><input type="hidden" name="18" value="<?php echo rand(1, 6); ?>"></div>
					<div class="panel" id="panel19"><input type="hidden" name="19" value="<?php echo rand(1, 6); ?>"></div>
					<div class="panel" id="panel20"><input type="hidden" name="20" value="<?php echo rand(1, 6); ?>"></div>
					<div id="panelFront"></div>
					<div class="panel" id="panel21"><input type="hidden" name="21" value="<?php echo rand(1, 6); ?>"></div>
					<div class="panel" id="panel22"><input type="hidden" name="22" value="<?php echo rand(1, 6); ?>"></div>
					<div class="panel" id="panel23"><input type="hidden" name="23" value="<?php echo rand(1, 6); ?>"></div>
					<div class="panel" id="panel24"><input type="hidden" name="23" value="<?php echo rand(1, 6); ?>"></div>
					<div class="panel" id="panel25" ><input type="hidden" name="25" value="<?php echo rand(1, 6); ?>"></div>
				</div>
			</div>
		</body>
		</html>