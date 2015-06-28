<?php
//IDセッション無し→一般向けリミテーション
session_start();

if(!isset($_SESSION["id"]))
{
header("Location: ../index.php");
exit;
}
//USER_IDの取得
$id = $_SESSION["id"];
    //DB接続
    $pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト名', 'ユーザー名', 'パスワード');
    $pdo->query('SET NAMES utf8');
    //選択アイテムの取得
    $hada = $_POST['hada'];
    $kami = $_POST['kami'];
    $kao = $_POST['kao'];
    $huku = $_POST['huku'];
    $kutu = $_POST['kutu'];
    $akuse = $_POST['akuse'];
    $mochimono = $_POST['mochimono'];
    $backimg = $_POST['backimg'];
    //選択アイテムでUPDATE
    $stmt = $pdo->prepare('UPDATE AVATAR_USER_VISUAL SET USER_ID = :id, KAO = :kao, KAMI = :kami, HUKU = :huku, ACCESSORY = :akuse,KUTU = :kutu, MOCHIMONO = :mochimono ,HADA = :hada ,BACKIMG = :backimg WHERE USER_ID = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->bindParam(':kao', $kao, PDO::PARAM_STR);
    $stmt->bindParam(':kami', $kami, PDO::PARAM_STR);
    $stmt->bindParam(':hada', $hada, PDO::PARAM_STR);
    $stmt->bindParam(':huku', $huku, PDO::PARAM_STR);
    $stmt->bindParam(':kutu', $kutu, PDO::PARAM_STR);
    $stmt->bindParam(':akuse', $akuse, PDO::PARAM_STR);
    $stmt->bindParam(':mochimono', $mochimono, PDO::PARAM_STR);
    $stmt->bindParam(':backimg', $backimg, PDO::PARAM_STR);
    $stmt->execute();
    header("Location: main.php");
?>