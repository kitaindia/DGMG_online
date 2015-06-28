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
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript">
//==プレイ回数取得
//==ドロップアウト処理
function getCount(){
	//ajax処理
		$.ajax({
        	type: 'POST',
        	dataType: 'json',
        	url: 'getPlayCount.php',
        	success: function(data){
        		alert(data);
        	}
        });
}
// -->
</script>
</head>
<body>
<input type="button" onclick="getCount()">
</body>
</html>