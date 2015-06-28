<?php
header("Content-Type: text/html; charset=UTF-8");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>HTML5銈点兂銉椼儷</title>
</head>
<body>
<?php
$keyword = "シルドラ";
$name = "サリサ";
$pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト', 'ユーザ名', 'パスワード');
$pdo->query('SET NAMES utf8');
// 準備
$sql = "SELECT USERNAME FROM CHAT_HITUSER WHERE KEYWORD = :keyword AND USERNAME = :name";
$sth = $pdo->prepare($sql);
$sth->bindValue(':keyword',$keyword, PDO::PARAM_STR);
$sth->bindValue(':name',$name, PDO::PARAM_STR);

// 実行
$sth->execute();

// 直近の実行結果の行数を得る
$count = $sth->rowCount();
echo $count;
    /*$stmt = $pdo->prepare("SELECT USERNAME FROM CHAT_HITUSER WHERE KEYWORD = :keyword AND USERNAME = :name");
    $stmt -> bindParam(':keyword',$keyword);
    $stmt -> bindParam(':name',$name);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $hitCount = $result['USERNAME'];
    echo $hitCount;
    echo $keyword;
    echo $name; */
?>
</body>
</html>