<?php
session_start();

if($_SESSION['guildmember']==0)
{
header("Location: ../top.php");
exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>サイトのタイトル</title>
<link rel="stylesheet" type="text/css" href="css/html5reset.css"  />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
<html>
<title>チャット表示</title>
<head>
<style type="text/css">
        body {
                font-size: 14px;        <!-- 文字の大きさ -->
        }
        #comment {
                font-family: "メイリオ", sans-serif;
        }
        #msg {
                color: #FF6347;
                 font-family: "メイリオ", sans-serif;
        }
</style>
<meta http-equiv="refresh" content="30" ><!-- 5秒毎にチャット画面をリロード -->    
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
$commentForKeyword = $comment;

//データのINSERT
if ( $name != null and $comment != null ) {
        $write = $pdo -> prepare("INSERT INTO chat (name, comment, time) VALUES ('$name', '$comment', '$time')");
        $write->execute();
        //書き込み回数追加
        $write = $pdo -> prepare("UPDATE db_user SET CHAT_COUNT = CHAT_COUNT+1 WHERE name = '$name'");
        $write->execute();
        //初回書き込みメッセージとシルドラ追加処理
$query = $pdo->query("SELECT CHAT_COUNT FROM db_user WHERE name = '$name'");
$CHAT_COUNT = $query->fetch();
if($CHAT_COUNT[0]==1){
        $osr = "↑";
        $comment = $name."さんが<img src=\"image/sirudoru.png\">1枚ゲット！↑<br>【詳細】初書き込みで取得。<br>";
        $write = $pdo -> prepare("INSERT INTO chat (name, comment, time) VALUES ('$osr', '$comment', '$time')");
        $write->execute();
        $sirudoru = $pdo -> prepare("UPDATE db_user SET sirudoru = sirudoru+1 WHERE name = '$name'");
        $sirudoru->execute();

}
//キーワードを含んでいるか判定
//キーワードを格納する配列の生成
$pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト名', 'ユーザー名', 'パスワード');
$pdo->query('SET NAMES utf8');
$keywords = $pdo->query("SELECT KEYWORD FROM CHAT_KEYWORD");
while( $keyword = $keywords->fetch(PDO::FETCH_ASSOC) ){
//HIT済みかどうかの判定
$keyword = $keyword["KEYWORD"];
$sql = "SELECT USERNAME FROM CHAT_HITUSER WHERE KEYWORD = :keyword AND USERNAME = :name";
$sth = $pdo->prepare($sql);
$sth->bindValue(':keyword',$keyword, PDO::PARAM_STR);
$sth->bindValue(':name',$name, PDO::PARAM_STR);
$sth->execute();
$hitCount = $sth->rowCount();
    if(strpos($commentForKeyword, $keyword) !== FALSE and $hitCount == 0){
        //HIT済みに登録
        $hit = $pdo -> prepare("INSERT INTO CHAT_HITUSER (KEYWORD, USERNAME) VALUES ('$keyword', '$name')");
        $hit->execute();
        //HIT済みメッセージのINSERT
        $osr = "HIT！";
        $comment = "<text id=\"msg\">".$name."さんが<img src=\"image/sirudoru.png\">１枚ゲット！↑<br>【詳細】キーワードにHIT!<br>KEYWORD：</text>". $keyword."<br>";
        $write = $pdo -> prepare("INSERT INTO chat (name, comment, time) VALUES ('$osr', '$comment', '$time')");
        $write->execute();
        //HITによるシル$のINSERT
        $sirudoru = $pdo -> prepare("UPDATE db_user SET sirudoru = sirudoru+1 WHERE name = '$name'");
        $sirudoru->execute();
    }
}
}

 
//行数の確認
$query = $pdo->query("SELECT COUNT(*) FROM chat");
$count = $query->fetch();
 
//指定した行数より多ければ、timeの一番古いものを削除する。
$num = 50;
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
        if($row[0]==="↑"){
                echo '<text id="msg">'.$row[0].$row[1].'</text><br>';
        }else{
        echo '【'. $row[0] .'】' . $row[2] . '<br><text id="comment">' . $row[1] . '</text><br>';
}
}
?>
</body>
</html>
</body>
</html>
