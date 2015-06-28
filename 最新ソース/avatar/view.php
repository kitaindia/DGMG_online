<?php 
//URL生成用のSUBJECT_IDを取得
$SUBJECT_ID = $_GET['SUBJECT_ID'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title></title>
	<style type="text/css">
	</style>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('img#subject_image').click(function(e){
//クリックしたXY座標の取得
var x = e.pageX - $('img#subject_image').position().left;
var y = e.pageY - $('img#subject_image').position().top;
alert("X=" + x + " Y=" + y);
//【Ajax】クリックしたXY座標のDOT_DOTS_POSITIONへの登録
$.ajax({
	url: "dotting.php",
	type: "POST",
	cache: false,
	dataType: "json",
	data: {
		"POSITION_X": x,
		"POSITION_Y": y
	},
	success: function(o){
		alert(o);
	},
	error: function(xhr, textStatus, errorThrown){
		alert(o);
	}
});
});
//【ajax】ドット表示ボタンクリックで、phpから座標配列を受け取り
$("*[name=dispDots]").click(

	function() {
		$.ajax({
			url: "./gettingPosition.php",
			type: "POST",
					data: { val : 3 },	// 検索など引数を渡す必要があるときこれを使う
					dataType: 'json',			// サーバーなどの環境によってこのオプションが必要なときがある
					success: function(dots) {
   						// 自分の環境だと帰ってきた配列をパスしないとだめ。
   						// ローカルだとそのまま使えた。
   						var parseDots = JSON.parse( dots );	
   						drowDots(parseDots);
   					}
   				});
	}
	);
//=========================================
});
//【funciton】ドットの描写処理
	// テーブルを書き換える関数
	function drowDots( response )
	{
		// 取得したデータを行に入れる
		for (var i=0; i< response.length; i++) {
			alert("X:"+response[i]['POSITION_X']+"Y:"+response[i]['POSITION_Y']);
		}
	}
</script>
</head>
<body>
	<?php
	try {
		$pdo = new PDO('mysql:host=mysql010.phy.lolipop.lan;dbname=LAA0535115-dbname;charset=utf8','ユーザー名','パスワード');
		array(PDO::ATTR_EMULATE_PREPARES => false);
	} catch (PDOException $e) {
		exit('データベース接続失敗。'.$e->getMessage());
	}
//image.phpの埋め込み
	$sql = 'SELECT * FROM DOT_SUBJECT WHERE SUBJECT_ID = :SUBJECT_ID';
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':SUBJECT_ID',$SUBJECT_ID, PDO::PARAM_INT);
	$stmt->execute();
	if($stmt){
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$SUBJECT_TITLE = $row["SUBJECT_TITLE"];
		}
	}
	echo $SUBJECT_TITLE."<br>";
	echo '<img id="subject_image" src="./image.php?SUBJECT_ID='.$SUBJECT_ID.'" />';
	?>
	<!-- ドット表示ボタン -->
	<input type="button" id="dispDots" name="dispDots" value="ドットを表示する">
</body>
</html>