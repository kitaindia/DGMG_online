<?php
$url = "mysql010.phy.lolipop.lan";
$user = "LAA0535115";
$pass = "ãƒ‘ã‚¹ãƒ¯ãƒ¼ãƒ‰";
$db = "LAA0535115-dbname";
 
if (!empty($_POST))
{
    // ¥Ð¥¤¥Ê¥ê¥Ç©`¥¿
    $fp = fopen($_FILES["image"]["tmp_name"], "rb");
    $imgdat = fread($fp, filesize($_FILES["image"]["tmp_name"]));
    fclose($fp);
    $imgdat = addslashes($imgdat);
     
    // ’ˆˆ×Ó
    $dat = pathinfo($_FILES["image"]["name"]);
    $extension = $dat['extension'];
     
    // MINE¥¿¥¤¥×
    if ( $extension == "jpg" || $extension == "jpeg" ) $mime = "image/jpeg";
    else if( $extension == "gif" ) $mime = "image/gif";
    else if ( $extension == "png" ) $mine = "image/png";
     
    // MySQLµÇåh
    $link = mysql_connect( $url, $user, $pass ) or die("MySQL¤Ø¤Î½Ó¾A¤ËÊ§”¡¤·¤Þ¤·¤¿¡£");
    $sdb = mysql_select_db( $db, $link ) or die("¥Ç©`¥¿¥Ù©`¥¹¤Îßx’k¤ËÊ§”¡¤·¤Þ¤·¤¿¡£");
    $sql = "INSERT INTO `images`.`posts` (`imgdat`, `mine`) VALUES ('".$imgdat."', '".$mine."')";
     
    $result = mysql_query( $sql, $link ) or die("¥¯¥¨¥ê¤ÎËÍÐÅ¤ËÊ§”¡¤·¤Þ¤·¤¿¡£");
    mysql_close($link) or die("MySQLÇÐ¶Ï¤ËÊ§”¡¤·¤Þ¤·¤¿¡£");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>HTML5¥µ¥ó¥×¥ë</title>
</head>
<body>
<form enctype="multipart/form-data" action="./shopUpload.php" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
    <input name="image" type="file" />
    <p><input type="submit" name="save" value="Submit" /><p>
</form>
</body>
</html>