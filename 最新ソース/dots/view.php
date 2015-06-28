<?php 
//URL生成用のSUBJECT_IDを取得
$SUBJECT_ID = $_GET['SUBJECT_ID'];
//
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title></title>
	<style type="text/css">
	</style>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script src="js/jquery.balloon.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
//■■■■■■■■■■■■■■■■■■■■■■■■■■■題目タイトルの取得■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
    <?php
    try {
    	$pdo = new PDO('mysql:host=mysql010.phy.lolipop.lan;dbname=LAA0535115-dbname;charset=utf8','ユーザー名','パスワード');
    	array(PDO::ATTR_EMULATE_PREPARES => false);
    } catch (PDOException $e) {
    	exit('データベース接続失敗。'.$e->getMessage());
    }
    $sql = 'SELECT * FROM DOT_SUBJECT WHERE SUBJECT_ID = :SUBJECT_ID';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':SUBJECT_ID',$SUBJECT_ID, PDO::PARAM_INT);
    $stmt->execute();
    if($stmt){
    	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    		$SUBJECT_TITLE = $row["SUBJECT_TITLE"];
    	}
    }
    ?>
//■■■■■■■■■■■■■■■■■■■■■■■■■■■題目画像クリック時のドット登録処理■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
		$('canvas#subject_image_canvas').click(function(e){
//クリックしたXY座標の取得
var rect = e.target.getBoundingClientRect();
var x =  Math.round(e.clientX - rect.left);
var y =  Math.round(e.clientY - rect.top);
//【Ajax】クリックしたXY座標のDOT_DOTS_POSITIONへの登録
$.ajax({
	url: "dotting.php",
	type: "POST",
	cache: false,
	dataType: "json",
	data: {
		"POSITION_X": x,
		"POSITION_Y": y,
		"SUBJECT_ID": <?php echo $SUBJECT_ID ?>

	},
	success: function(o){
		drowDotAjax(1);
	},
	error: function(xhr, textStatus, errorThrown){
	}
});
});
//■■■■■■■■■■■■■■■■■■■■■■■■■■■みんなの答えを見るボタン処理■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
$("*[name=dispDots]").click(function(e){
	drowDotAjax(0);
});
//■■■■■■■■■■■■■■■■■■■■■■■■■■■【ajax】ドット表示ボタンクリックで、phpから座標配列を受け取り■■■■■■■■■■■■■■■■■■■■■■■■■■■
//$("*[name=dispDots]").click(

	function drowDotAjax(redDotFlg) {
		$.ajax({
			url: "./gettingPosition.php",
			type: "POST",
					data: { val : <?php echo $SUBJECT_ID ?> },	// 検索など引数を渡す必要があるときこれを使う
					dataType: 'json',			// サーバーなどの環境によってこのオプションが必要なときがある
					success: function(dots) {
   						// 自分の環境だと帰ってきた配列をパスしないとだめ。
   						// ローカルだとそのまま使えた。
   						var dotsStringify = JSON.stringify(dots);
   						var parseDots = JSON.parse( dotsStringify );	
   						drowDots(parseDots,redDotFlg);
   					}
   				});
	}
//	);
//■■■■■■■■■■■■■■■■■■■■■■■■■■■題目画像クリック時のドット描写処理■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
});
//【funciton】ドットの描写処理
	function drowDots( response ,redDotFlg)
	{
		// 取得したデータを行に入れる
		for (var i=0; i< response.length; i++) {
    // ドットの描画
    ctx.beginPath();
    switch (redDotFlg){
    	case 1:
    if(i == response.length-1){
    ctx.fillStyle = 'rgb(255,0,0) ';
    
}else{
	ctx.fillStyle = 'black';
};
break;
case 0:
ctx.fillStyle = 'black';
break;
}
    ctx.arc(response[i]['POSITION_X'], response[i]['POSITION_Y'], 3, 0, Math.PI*2, false);   
    ctx.fill();
}
}

</script>
</head>
<body>
	<?php
	////■■■■■■■■■■■■■■■■■■■■■■■■■■■題目画像縦横サイズ取得処理■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
	$url = "http://syldra.secret.jp/dots/image.php?SUBJECT_ID=".$SUBJECT_ID;
	list($width,$height) = getimagesize($url);
	?>
	<canvas id="subject_image_canvas" width="<?php echo $width ?>" height="<?php echo $height ?>"></canvas>
	<script>
	//■■■■■■■■■■■■■■■■■■■■■■■■■■■題目画像表示処理■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
	// 初期設定
	var img = new Image();
    img.src = "http://syldra.secret.jp/dots/image.php?SUBJECT_ID=<?php echo $SUBJECT_ID ?>";
    var canvas = document.getElementById('subject_image_canvas');
    var ctx = canvas.getContext('2d');
    var ctx2 = canvas.getContext('2d');
    img.onload = function() {
    	ctx.drawImage(img, 0, 0);
ctx.font= 'bold 25px Century Gothic';
ctx.lineWidth = 3; 
ctx.lineJoin = 'round';
ctx.strokeStyle = "black";
ctx.strokeText('<?php echo $SUBJECT_TITLE; ?>', 10, 30);
ctx.fillStyle = "white";
ctx.fillText('<?php echo $SUBJECT_TITLE; ?>', 10, 30);
}
	</script>
	<br>
	<input type="button" id="dotsButton" name="dispDots" value="みんなの答えを見る">
</body>
</html>