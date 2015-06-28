<html>
<title>チャット表示</title>
<head>
<style type="text/css">
        body {
                font-size: 14px;        <!-- 文字の大きさ -->
        }
</style>
<meta http-equiv="refresh" content="5" ><!-- 5秒毎にチャット画面をリロード -->    
</head>
<body>
 
<?php
//データベース接続
$pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト名', 'ユーザー名', 'パスワード');
$pdo->query('SET NAMES utf8');
 
//INSERTするデータ整理
date_default_timezone_set('Asia/Tokyo');
$time= date(Y) . ' ' . date(m).'/'.date(d).' '.date(H).':'.date(i).':'.date(s);
$name = $_POST['name'];
$comment = $_POST['comment'];
 
//データのINSERT
if ( $name != null and $comment != null ) {
        $write = $pdo -> prepare("INSERT INTO chat (name, comment, time) VALUES ('$name', '$comment', '$time')");
        $write->execute();
}
 
//行数の確認
$query = $pdo->query("SELECT COUNT(*) FROM chat");
$count = $query->fetch();
 
//指定した行数より多ければ、timeの一番古いものを削除する。
$num = 20;
if ( $count[0] > $num ) {
        for ( ; $count[0] > $num ; $count[0]-- ) {
                //最も古いレコードを取り出す。
                $query = $pdo->query("SELECT MIN(time) FROM chat");
                $mintime = $query->fetch();
                //最も古いレコードの削除
                $delete = $pdo -> prepare("DELETE FROM chat WHERE time = '$mintime[0]'");
                $delete->execute();
        }
}
 
//書き込み内容の取り出し
$str = $pdo->query("SELECT name, comment, time FROM chat ORDER BY time DESC");
 
//書き込み内容の出力
while ( $row = $str->fetch() ){
        echo '【'. $row[0] .'】' . $row[2] . '<br>' . $row[1] . '<br><br>';
}
?>
</body>
</html>