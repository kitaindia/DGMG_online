<?php
	$USER_NAME = $_POST["USER_NAME"];
	$USER_ID = $_POST["USER_ID"];
	$salt = "x";
	$USER_PASS = crypt($_POST["USER_PASS"],$salt);
	$REG_DATE = date(Ymd);
//DB接続し入力情報をMST_USERに登録
    try {
$pdo = new PDO('mysql:host=mysql010.phy.lolipop.lan;dbname=LAA0535115-dbname;charset=utf8','ユーザー名','パスワード');
array(PDO::ATTR_EMULATE_PREPARES => false);
} catch (PDOException $e) {
 exit('データベース接続失敗。'.$e->getMessage());
}
$stmt = $pdo->prepare('INSERT INTO MST_USER VALUES (:USER_ID,:USER_PASS,:USER_NAME,:REG_DATE)');
$stmt->bindValue(':USER_ID', $USER_ID, PDO::PARAM_STR);
$stmt->bindValue(':USER_NAME', $USER_NAME, PDO::PARAM_STR);
$stmt->bindValue(':USER_PASS', $USER_PASS, PDO::PARAM_STR);
$stmt->bindValue(':REG_DATE', $REG_DATE, PDO::PARAM_STR);
$stmt->execute();
//USER_DETAILに初期値を登録
$stmt = $pdo->prepare('INSERT INTO USER_DETAIL VALUES (:USER_ID,:USER_NAME,:USER_LEVEL,:USER_COIN,:USER_POINT,:USER_COMMENT,:USER_SEX)');
$stmt->bindValue(':USER_ID', $USER_ID, PDO::PARAM_STR);
$stmt->bindValue(':USER_NAME', $USER_NAME, PDO::PARAM_STR);
$stmt->bindValue(':USER_LEVEL', 1, PDO::PARAM_INT);
$stmt->bindValue(':USER_COIN', 0, PDO::PARAM_INT);
$stmt->bindValue(':USER_POINT', 0, PDO::PARAM_INT);
$stmt->bindValue(':USER_COMMENT', "よろしく！", PDO::PARAM_STR);
$stmt->bindValue(':USER_SEX', 3, PDO::PARAM_INT);
$stmt->execute();
//AVATAR_USER_VISUALに初期値を登録
$stmt = $pdo->prepare('INSERT INTO AVATAR_USER_VISUAL VALUES (:USER_ID,:KAO,:KAMI,:HUKU,:ACCESSORY,:KUTU,:MOCHIMONO,:HADA,:BACKIMG)');
$stmt->bindValue(':USER_ID', $USER_ID, PDO::PARAM_STR);
$stmt->bindValue(':KAO', "hohoemi", PDO::PARAM_STR);
$stmt->bindValue(':HADA', "hada_akarume", PDO::PARAM_STR);
$stmt->bindValue(':HUKU', "default_tshirt", PDO::PARAM_STR);
$stmt->bindValue(':KAMI', "short_darkbrown", PDO::PARAM_STR);
$stmt->bindValue(':MOCHIMONO', "default_map", PDO::PARAM_STR);
$stmt->bindValue(':KUTU', "default_kutu", PDO::PARAM_STR);
$stmt->bindValue(':ACCESSORY', "noimg", PDO::PARAM_STR);
$stmt->bindValue(':BACKIMG', "default_backimg", PDO::PARAM_STR);
$stmt->execute();
//AVATAR_USER_BELONGINGSに初期値を登録
    $stmt1 = $pdo->prepare('INSERT INTO AVATAR_USER_BELONGINGS(USER_ID, VALUE, PARTS_NAME, PARTS_CATEGORY) VALUES (:id,:VALUE,:NAME,:CATE)');
    $stmt1->bindParam(':id', $USER_ID, PDO::PARAM_STR);
    $stmt1->bindValue(':VALUE', "hada_akarume", PDO::PARAM_STR);
    $n = "明るめの肌";
    $c = "hada";
    $stmt1->bindParam(':NAME', $n, PDO::PARAM_STR);
    $stmt1->bindParam(':CATE', $c, PDO::PARAM_STR);
    $stmt1->execute();

        $stmt2 = $pdo->prepare('INSERT INTO AVATAR_USER_BELONGINGS(USER_ID, VALUE, PARTS_NAME, PARTS_CATEGORY) VALUES (:id,:VALUE,:NAME,:CATE)');
    $stmt2->bindParam(':id', $USER_ID, PDO::PARAM_STR);
    $stmt2->bindValue(':VALUE', "hohoemi", PDO::PARAM_STR);
        $n = "微笑んでる";
    $c = "kao";
    $stmt2->bindParam(':NAME', $n, PDO::PARAM_STR);
    $stmt2->bindParam(':CATE', $c, PDO::PARAM_STR);
    $stmt2->execute();

        $stmt3 = $pdo->prepare('INSERT INTO AVATAR_USER_BELONGINGS(USER_ID, VALUE, PARTS_NAME, PARTS_CATEGORY) VALUES (:id,:VALUE,:NAME,:CATE)');
    $stmt3->bindParam(':id', $USER_ID, PDO::PARAM_STR);
    $stmt3->bindValue(':VALUE', "default_tshirt", PDO::PARAM_STR);
        $n = "白いTシャツ";
    $c = "huku";
    $stmt3->bindParam(':NAME', $n, PDO::PARAM_STR);
    $stmt3->bindParam(':CATE', $c, PDO::PARAM_STR);
    $stmt3->execute();

        $stmt4 = $pdo->prepare('INSERT INTO AVATAR_USER_BELONGINGS(USER_ID, VALUE, PARTS_NAME, PARTS_CATEGORY) VALUES (:id,:VALUE,:NAME,:CATE)');
    $stmt4->bindParam(':id', $USER_ID, PDO::PARAM_STR);
    $stmt4->bindValue(':VALUE', "default_kutu", PDO::PARAM_STR);
        $n = "白い靴";
    $c = "kutu";
    $stmt4->bindParam(':NAME', $n, PDO::PARAM_STR);
    $stmt4->bindParam(':CATE', $c, PDO::PARAM_STR);
    $stmt4->execute();

        $stmt5 = $pdo->prepare('INSERT INTO AVATAR_USER_BELONGINGS(USER_ID, VALUE, PARTS_NAME, PARTS_CATEGORY) VALUES (:id,:VALUE,:NAME,:CATE)');
    $stmt5->bindParam(':id', $USER_ID, PDO::PARAM_STR);
    $stmt5->bindValue(':VALUE', "noimg", PDO::PARAM_STR);
        $n = "なし";
    $c = "akuse";
    $stmt5->bindParam(':NAME', $n, PDO::PARAM_STR);
    $stmt5->bindParam(':CATE', $c, PDO::PARAM_STR);
    $stmt5->execute();

            $stmt6 = $pdo->prepare('INSERT INTO AVATAR_USER_BELONGINGS(USER_ID, VALUE, PARTS_NAME, PARTS_CATEGORY) VALUES (:id,:VALUE,:NAME,:CATE)');
    $stmt6->bindParam(':id', $USER_ID, PDO::PARAM_STR);
    $stmt6->bindValue(':VALUE', "default_map", PDO::PARAM_STR);
        $n = "丸めた地図";
    $c = "mochimono";
    $stmt6->bindParam(':NAME', $n, PDO::PARAM_STR);
    $stmt6->bindParam(':CATE', $c, PDO::PARAM_STR);
    $stmt6->execute();

                $stmt7 = $pdo->prepare('INSERT INTO AVATAR_USER_BELONGINGS(USER_ID, VALUE, PARTS_NAME, PARTS_CATEGORY) VALUES (:id,:VALUE,:NAME,:CATE)');
    $stmt7->bindParam(':id', $USER_ID, PDO::PARAM_STR);
    $stmt7->bindValue(':VALUE', "short_darkbrown", PDO::PARAM_STR);
        $n = "セミショート(黒)";
    $c = "kami";
    $stmt7->bindParam(':NAME', $n, PDO::PARAM_STR);
    $stmt7->bindParam(':CATE', $c, PDO::PARAM_STR);
    $stmt7->execute();

                    $stmt7 = $pdo->prepare('INSERT INTO AVATAR_USER_BELONGINGS(USER_ID, VALUE, PARTS_NAME, PARTS_CATEGORY) VALUES (:id,:VALUE,:NAME,:CATE)');
    $stmt7->bindParam(':id', $USER_ID, PDO::PARAM_STR);
    $stmt7->bindValue(':VALUE', "default_backimg", PDO::PARAM_STR);
        $n = "背景（ノーマル）";
    $c = "backimg";
    $stmt7->bindParam(':NAME', $n, PDO::PARAM_STR);
    $stmt7->bindParam(':CATE', $c, PDO::PARAM_STR);
    $stmt7->execute();

header("Location: finished.php");
?>