hinfo($_FILES["image"]["name"]);<?php
if (!empty($_POST))
{
    // 画像のバイナリデータの取得
    $fp = fopen($_FILES["image"]["tmp_name"], "rb");
    $imgdat = fread($fp, filesize($_FILES["image"]["tmp_name"]));
    fclose($fp);
    $IMAGE_DAT = addslashes($imgdat);

    // 拡張子の取得
    $dat = pathinfo($_FILES["image"]["name"]);
    $extension = $dat['extension'];

    // 拡張子によるMINEタイプの取得
    if ( $extension == "jpg" || $extension == "jpeg" ) $MINETYPE = "image/jpeg";
    else if( $extension == "gif" ) $MINETYPE = "image/gif";
    else if ( $extension == "png" ) $MINETYPE = "image/png";

    // 登録処理開始
    try {
        $pdo = new PDO('mysql:host=mysql010.phy.lolipop.lan;dbname=LAA0535115-dbname;charset=utf8','ユーザ名','パスワード');
        array(PDO::ATTR_EMULATE_PREPARES => false);
    } catch (PDOException $e) {
       exit('データベース接続失敗。'.$e->getMessage());
   }
   //１：画像の登録
   $stmt = $pdo->prepare("INSERT INTO DOT_IMAGE (IMAGE_DAT,MINETYPE) VALUES ('".$IMAGE_DAT."','".$MINETYPE."')");
   $stmt->execute();
   //２：題目情報の登録
   $SUBJECT_ID = $pdo->lastInsertId();
   $SUBJECT_TITLE = $_POST["SUBJECT_TITLE"];
   //$USER_ID = $_SESSION["USER_ID"];
   $USER_ID = "TEST";
   $CREATE_DATE = date("Y/m/d");
   $stmt = $pdo->prepare('INSERT INTO DOT_SUBJECT (SUBJECT_ID,SUBJECT_TITLE,USER_ID,CREATE_DATE) VALUES (:SUBJECT_ID,:SUBJECT_TITLE,:USER_ID,:CREATE_DATE)');
   $stmt->bindValue(':SUBJECT_ID', $SUBJECT_ID, PDO::PARAM_INT);
   $stmt->bindValue(':SUBJECT_TITLE', $SUBJECT_TITLE, PDO::PARAM_STR);
   $stmt->bindValue(':USER_ID', $USER_ID, PDO::PARAM_STR);
   $stmt->bindValue(':CREATE_DATE', $CREATE_DATE, PDO::PARAM_STR);
   $stmt->execute();
}
?>