<?php
session_start();

if($_SESSION['guildmember']==0)
{
header("Location: ../index.php");
exit;
}
//クッキーセット
setcookie("over12hour", "over12hour2", time()+60*60*12);

if (!empty($_POST))
{
    // バイナリデータ
    $fp = fopen($_FILES["image"]["tmp_name"], "rb");
    $imgdat = fread($fp, filesize($_FILES["image"]["tmp_name"]));
    fclose($fp);
    $imgdat = addslashes($imgdat);
     
    // 拡張子
    $dat = pathinfo($_FILES["image"]["name"]);
    $extension = $dat['extension'];
     
    // MINEタイプ
    if ( $extension == "jpg" || $extension == "jpeg" ) $mime = "image/jpeg";
    else if( $extension == "gif" ) $mime = "image/gif";
    else if ( $extension == "png" ) $mine = "image/png";

    //タイトル/部門/USER_NAMEを取得nl2br
    $title = nl2br($_POST['title']);
    $category = $_POST['category'];
    $userName = $_POST['userName'];
     
    // MySQL登録
    $pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト', 'ユーザ名', 'パスワード');
    $pdo->query('SET NAMES utf8');
    $updItems = $pdo -> prepare("INSERT INTO posts (`imgdat`, `mine`,`TITLE`,`USER_NAME`) VALUES ('".$imgdat."', '".$mine."', '".$title."','".$userName."')");
    $updItems ->execute();

    //１シル$追加
    $pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト', 'ユーザ名', 'パスワード');
    $pdo->query('SET NAMES utf8');
    $updSirudoru = $pdo -> prepare("UPDATE db_user SET sirudoru = sirudoru+1 WHERE name = '".$userName."'");
    $updSirudoru ->execute();

    header("Location: imgView.php");
}
?>