<?php
$url = "mysql010.phy.lolipop.lan";
$user = "LAA0535115";
$pass = "パスワード";
$db = "LAA0535115-dbname";
 
if (!empty($_POST))
{
    // �Х��ʥ�ǩ`��
    $fp = fopen($_FILES["image"]["tmp_name"], "rb");
    $imgdat = fread($fp, filesize($_FILES["image"]["tmp_name"]));
    fclose($fp);
    $imgdat = addslashes($imgdat);
     
    // ������
    $dat = pathinfo($_FILES["image"]["name"]);
    $extension = $dat['extension'];
     
    // MINE������
    if ( $extension == "jpg" || $extension == "jpeg" ) $mime = "image/jpeg";
    else if( $extension == "gif" ) $mime = "image/gif";
    else if ( $extension == "png" ) $mine = "image/png";
     
    // MySQL���h
    $link = mysql_connect( $url, $user, $pass ) or die("MySQL�ؤνӾA��ʧ�����ޤ�����");
    $sdb = mysql_select_db( $db, $link ) or die("�ǩ`���٩`�����x�k��ʧ�����ޤ�����");
    $sql = "INSERT INTO `images`.`posts` (`imgdat`, `mine`) VALUES ('".$imgdat."', '".$mine."')";
     
    $result = mysql_query( $sql, $link ) or die("����������Ť�ʧ�����ޤ�����");
    mysql_close($link) or die("MySQL�жϤ�ʧ�����ޤ�����");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>HTML5����ץ�</title>
</head>
<body>
<form enctype="multipart/form-data" action="./shopUpload.php" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
    <input name="image" type="file" />
    <p><input type="submit" name="save" value="Submit" /><p>
</form>
</body>
</html>