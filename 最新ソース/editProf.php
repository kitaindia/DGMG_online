<?php
session_start();
$comment = $_POST["editedProf"];
$id = $_SESSION["id"];
//各ユーザーの情報のリストを取得
$pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト', 'ユーザ名', 'パスワード');
$pdo->query('SET NAMES utf8');
$sql = 'UPDATE db_user SET comment = :comment WHERE id = :USER_ID';
$stmt1 = $pdo->prepare($sql);
$stmt1->bindValue(':USER_ID',$id,PDO::PARAM_STR);
$stmt1->bindValue(':comment',$comment,PDO::PARAM_STR);
$stmt1->execute();
header("Location: ../memberlist.php");
exit;
?>