<?php 
$id = $_GET['id'];
$pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト名', 'ユーザー名', 'パスワード');
$pdo->query('SET NAMES utf8');
$stmt = $pdo->query("SELECT * FROM posts WHERE ID = '".$id."'");
 
    while($row = $stmt->fetch()) {
        header( "Content-Type: ".$row['mine'] );
        echo $row['imgdat'];
    }
?>