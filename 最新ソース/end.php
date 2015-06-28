<?php
	$name = $_POST["name"];
	$id = $_POST["id"];
	$password = $_POST["password"];
	$password2 = $_POST["password2"];
	$seibetu = "不明";
	$job = "不明";
	$comment = $_POST["comment"];
	$sirudoru = 10;
	$chatCount = 0;
$shokui = "メンバー";
$points = 0;
//DB接続・インサート・切断
$pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト名', 'ユーザー名', 'パスワード');
$pdo->query('SET NAMES utf8');
$stmt = $pdo->prepare('INSERT INTO db_user VALUES (:id,:name,:password,:seibetu,:shokui,:job,:comment,:sirudoru,:chatcount,:memberflg)');
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_INT);
$stmt->bindValue(':seibetu', $seibetu, PDO::PARAM_STR);
$stmt->bindValue(':shokui', $shokui, PDO::PARAM_STR);
$stmt->bindValue(':job', $job, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$stmt->bindValue(':sirudoru', $sirudoru, PDO::PARAM_INT);
$stmt->bindValue(':chatcount', $chatCount, PDO::PARAM_INT);
$stmt->bindValue(':memberflg', 0, PDO::PARAM_INT);
$stmt->execute();
$stmt = $pdo->prepare('INSERT INTO TEST_GAME VALUES (:id,:points)');
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$stmt->bindValue(':points', 0, PDO::PARAM_INT);
$stmt->execute();
header("Location: http://syldra.secret.jp/avatar/main.php");
?>