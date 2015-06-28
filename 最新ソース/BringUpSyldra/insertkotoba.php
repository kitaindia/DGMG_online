<?php
	//セッション開始
	session_start();
	//DB接続
	$pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト', 'ユーザ名', 'パスワード');
	$pdo->query('SET NAMES utf8');
    //データの取得
    $word = $_POST['textkotoba'];
    $category = $_POST['syurui'];
    $userName = $_SESSION["name"];
    $id = $_SESSION["id"];
   //残りのシル＄が０の場合
    $stmt = $pdo->prepare('SELECT sirudoru FROM db_user WHERE id = :id');
    $stmt->bindValue(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch();
    if($row['sirudoru']==0){
    	$error=1;
    }
    else{
    //１シル＄消費
	$stmt = $pdo->prepare('UPDATE db_user SET sirudoru = sirudoru-1 WHERE id = :id');
	$stmt->bindValue(':id', $id, PDO::PARAM_STR);
	$stmt->execute();
	$error=0;
	    //データの登録
    $pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト', 'ユーザ名', 'パスワード');
    $pdo->query('SET NAMES utf8');
    $insWord = $pdo -> prepare("INSERT INTO SYLDRA_WORD (`WORD`, `CATEGORY`,`USER_NAME`) VALUES ('".$word."', '".$category."','".$userName."')");
    $insWord ->execute();
}
?>
<!DOCTYPE html>
<html lang="ja">
<html>
<head>
<meta charset="UTF-8">
<titleみんなで育てるシルドラくん</title>
<style type="text/css">
body {  
    text-align: center;  
    background-color:#e9e5f9;
}  
body text{
	font-family:"メイリオ", sans-serif;
}
</style>　
<script type="text/javascript">
<!--
// -->
</script>
</head>
<body>
    <div id="header">
<?php include( $_SERVER['DOCUMENT_ROOT'] . '/dropDownMenu.php'); ?>
</div>
<image src="http://syldra.secret.jp/image/sirudoraBorned.png" width="500px" height="300px" id="eggborn" border="0" style="margin:30px;"/><br><br>
	<?php
if($error==1){echo "シル＄が足りないよ！";}else{
	echo "「".$word."」かー。教えてくれてありがとう".$userName."さん。";
}
	?>
<br>
<br>
<a href="http://syldra.secret.jp/BringUpSyldra/main.php" style="border:0;">シルドラくんトップに戻る</a>
<br>
<br>
</body>
</html>