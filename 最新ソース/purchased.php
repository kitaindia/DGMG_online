<?php
//IDセッション無し→一般向けリミテーション
session_start();

if(!isset($_SESSION["id"]))
{
header("Location: top.php");
exit;
}
    //DB接続
    $pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト', 'ユーザ名', 'パスワード');
    $pdo->query('SET NAMES utf8');
    //IDの取得
    //$id = $_SESSION["id"];
    $id = $_SESSION["id"];
    //購入アイテムリストの取得
    $itemsHada = $_POST['itemsHada'];
    $itemsKao = $_POST['itemsKao'];
    $itemsKami = $_POST['itemsKami'];
    $itemsHuku = $_POST['itemsHuku'];
    $itemsKutu = $_POST['itemsKutu'];
    $itemsAkuse = $_POST['itemsAkuse'];
    $itemsMochimono = $_POST['itemsMochimono'];
    //残金額と合計金額の取得
    $stmt = $pdo->prepare('SELECT sirudoru FROM db_user WHERE id = :id');
    $stmt->bindValue(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch();
    //残金額
    $money = $row['sirudoru'];
    //合計金額
    $cost = $_POST["cost"];
//-残金額＞合計金額ならAVATAR_USER_BELONGINGSにINSERT
//-残金額＜合計金額ならエラー表示
    if($money-$cost>=0){
        $error = 0;

        //肌色購入リストをAVATAR_USER_BELONGINGSにインサート
        foreach($itemsHada as &$item){
                //アイテム名の取得
                    $stmt = $pdo->prepare('SELECT PARTS_NAME FROM AVATAR_SHOP WHERE VALUE = :VALUE');
                    $stmt->bindValue(':VALUE', $item, PDO::PARAM_STR);
                    $stmt->execute();
                    $row = $stmt->fetch();
                    $partsName = $row['PARTS_NAME'];
                //インサート
                $insWord = $pdo -> prepare("INSERT INTO AVATAR_USER_BELONGINGS (`USER_ID`, `VALUE`,`PARTS_NAME`,`PARTS_CATEGORY`) VALUES ('".$id."', '".$item."','".$partsName."','hada')");
                $insWord ->execute();
        }
                //顔購入リストをAVATAR_USER_BELONGINGSにインサート
        foreach($itemsKao as &$item){
                //アイテム名の取得
                    $stmt = $pdo->prepare('SELECT PARTS_NAME FROM AVATAR_SHOP WHERE VALUE = :VALUE');
                    $stmt->bindValue(':VALUE', $item, PDO::PARAM_STR);
                    $stmt->execute();
                    $row = $stmt->fetch();
                    $partsName = $row['PARTS_NAME'];
                //インサート
                $insWord = $pdo -> prepare("INSERT INTO AVATAR_USER_BELONGINGS (`USER_ID`, `VALUE`,`PARTS_NAME`,`PARTS_CATEGORY`) VALUES ('".$id."', '".$item."','".$partsName."','kao')");
                $insWord ->execute();
        }
                //髪型購入リストをAVATAR_USER_BELONGINGSにインサート
        foreach($itemsKami as &$item){
                //アイテム名の取得
                    $stmt = $pdo->prepare('SELECT PARTS_NAME FROM AVATAR_SHOP WHERE VALUE = :VALUE');
                    $stmt->bindValue(':VALUE', $item, PDO::PARAM_STR);
                    $stmt->execute();
                    $row = $stmt->fetch();
                    $partsName = $row['PARTS_NAME'];
                //インサート
                $insWord = $pdo -> prepare("INSERT INTO AVATAR_USER_BELONGINGS (`USER_ID`, `VALUE`,`PARTS_NAME`,`PARTS_CATEGORY`) VALUES ('".$id."', '".$item."','".$partsName."','kami')");
                $insWord ->execute();
        }
                //服購入リストをAVATAR_USER_BELONGINGSにインサート
        foreach($itemsHuku as &$item){
                //アイテム名の取得
                    $stmt = $pdo->prepare('SELECT PARTS_NAME FROM AVATAR_SHOP WHERE VALUE = :VALUE');
                    $stmt->bindValue(':VALUE', $item, PDO::PARAM_STR);
                    $stmt->execute();
                    $row = $stmt->fetch();
                    $partsName = $row['PARTS_NAME'];
                //インサート
                $insWord = $pdo -> prepare("INSERT INTO AVATAR_USER_BELONGINGS (`USER_ID`, `VALUE`,`PARTS_NAME`,`PARTS_CATEGORY`) VALUES ('".$id."', '".$item."','".$partsName."','huku')");
                $insWord ->execute();
        }
                //靴色購入リストをAVATAR_USER_BELONGINGSにインサート
        foreach($itemsKutu as &$item){
                //アイテム名の取得
                    $stmt = $pdo->prepare('SELECT PARTS_NAME FROM AVATAR_SHOP WHERE VALUE = :VALUE');
                    $stmt->bindValue(':VALUE', $item, PDO::PARAM_STR);
                    $stmt->execute();
                    $row = $stmt->fetch();
                    $partsName = $row['PARTS_NAME'];
                //インサート
                $insWord = $pdo -> prepare("INSERT INTO AVATAR_USER_BELONGINGS (`USER_ID`, `VALUE`,`PARTS_NAME`,`PARTS_CATEGORY`) VALUES ('".$id."', '".$item."','".$partsName."','kutu')");
                $insWord ->execute();
        }
                //アクセサリー色購入リストをAVATAR_USER_BELONGINGSにインサート
        foreach($itemsAkuse as &$item){
                //アイテム名の取得
                    $stmt = $pdo->prepare('SELECT PARTS_NAME FROM AVATAR_SHOP WHERE VALUE = :VALUE');
                    $stmt->bindValue(':VALUE', $item, PDO::PARAM_STR);
                    $stmt->execute();
                    $row = $stmt->fetch();
                    $partsName = $row['PARTS_NAME'];
                //インサート
                $insWord = $pdo -> prepare("INSERT INTO AVATAR_USER_BELONGINGS (`USER_ID`, `VALUE`,`PARTS_NAME`,`PARTS_CATEGORY`) VALUES ('".$id."', '".$item."','".$partsName."','akuse')");
                $insWord ->execute();
        }
                //持ち物色購入リストをAVATAR_USER_BELONGINGSにインサート
        foreach($itemsMochimono as &$item){
                //アイテム名の取得
                    $stmt = $pdo->prepare('SELECT PARTS_NAME FROM AVATAR_SHOP WHERE VALUE = :VALUE');
                    $stmt->bindValue(':VALUE', $item, PDO::PARAM_STR);
                    $stmt->execute();
                    $row = $stmt->fetch();
                    $partsName = $row['PARTS_NAME'];
                //インサート
                $insWord = $pdo -> prepare("INSERT INTO AVATAR_USER_BELONGINGS (`USER_ID`, `VALUE`,`PARTS_NAME`,`PARTS_CATEGORY`) VALUES ('".$id."', '".$item."','".$partsName."','mochimono')");
                $insWord ->execute();
        }
        //合計金額をマイナスする
        $costInt = intval($cost);
        $stmt = $pdo->prepare('UPDATE db_user SET sirudoru = sirudoru-"'.$costInt.'" WHERE id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
    }else{
        $error = 1;
    }

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>アバター/購入</title>
<link rel="stylesheet" type="text/css" href="css/html5reset.css"  />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<style type="text/css">
</style>
<script type="text/javascript" src="http://syldra.secret.jp/js/jquery-1.3.2.min.js"></script>
</head>
<body>
<script>
</script>
<div id="header">
<?php include( $_SERVER['DOCUMENT_ROOT'] . '/dropDownMenu.php'); ?>
</div>
<br>
<?php 
switch($error){
    case 1:
    echo "購入エラー！金額が残預金を超えています。";
    break;
    case 0;
    echo '購入成功！';
    break;
}
?>
<br>
<a href="http://syldra.secret.jp/avatar/shop.php">引き続きアイテムを買う</a><br><br>
<a href="http://syldra.secret.jp/avatar/main.php">アバターメインページに戻る</a>
</body>
</html>

