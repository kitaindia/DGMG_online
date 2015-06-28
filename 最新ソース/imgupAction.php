<?php
$url = "localhost";
$user = "root";
$pass = "root";
$db = "images";
 
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
     
    // MySQL登録
    $link = mysql_connect( $url, $user, $pass ) or die("MySQLへの接続に失敗しました。");
    $sdb = mysql_select_db( $db, $link ) or die("データベースの選択に失敗しました。");
    $sql = "INSERT INTO `images`.`posts` (`imgdat`, `mine`) VALUES ('".$imgdat."', '".$mine."')";
     
    $result = mysql_query( $sql, $link ) or die("クエリの送信に失敗しました。");
    mysql_close($link) or die("MySQL切断に失敗しました。");
}
?>