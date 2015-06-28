<?php
//IDセッション無し→一般向けリミテーション
session_start();

if(!isset($_SESSION["id"]))
{
header("Location: ../top.php");
exit;
}
//質問の種類の取得
$syurui = $_POST['syurui'];
//PDO生成
$pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト', 'ユーザ名', 'パスワード');
$pdo->query('SET NAMES utf8');

//回答文取得
//---質問による場合わけ
switch ($syurui){
//調子
case 'chosi':
  // 処理
$stmt = $pdo->query("SELECT WORD FROM SYLDRA_WORD WHERE CATEGORY = 'yousu' ORDER BY rand() LIMIT 0,1;");
$row = $stmt->fetch();
$rand = rand(1,3);
switch ($rand){
	case 1:
$answer = $row[0]."よ。";
  break;
case 2:
$answer = $row[0]."なあ。";
  break;
case 3:
$answer = $row[0]."よ・・・。とても".$row[0]."・・・。";
  break;
  default:
}
  break;
//欲しい
case 'want1':
  // 処理
$fORn = rand(1,3);
if($fORn==1){
$stmt = $pdo->query("SELECT WORD FROM SYLDRA_WORD WHERE CATEGORY = 'physic' order by rand() limit 0,1;");
}elseif(2){
$stmt = $pdo->query("SELECT WORD FROM SYLDRA_WORD WHERE CATEGORY = 'nonphysic' order by rand() limit 0,1;");
}else{
$stmt = $pdo->query("SELECT WORD FROM SYLDRA_WORD WHERE CATEGORY = 'ikimono' order by rand() limit 0,1;");
}$row = $stmt->fetch();
$rand = rand(1,2);
switch ($rand){
	case 1:
$answer = $row[0]."が欲しいなあ。";
  break;
case 2:
$answer = $row[0]."に囲まれて生きてたいなあ。";
  break;
  default:
}
  break;
//したい
case 'want2':
  // 処理
$stmt = $pdo->query("SELECT WORD FROM SYLDRA_WORD WHERE CATEGORY = 'ugoki' order by rand() limit 0,1;");
$row = $stmt->fetch();
$rand = rand(1,3);
switch ($rand){
	case 1:
$answer = "とにかく".$row[0]."ことかなあ。";
  break;
case 2:
$answer = $row[0]."。これに尽きるね。";
  break;
case 3:
$answer = $row[0]."なんてできたらいいなあ。";
  break;
  default:
}
  break;
//将来の夢
case 'yume':
  // 処理
$stmt = $pdo->query("SELECT WORD FROM SYLDRA_WORD WHERE CATEGORY = 'physic' order by rand() limit 0,1;");
$row = $stmt->fetch();
$stmt = $pdo->query("SELECT WORD FROM SYLDRA_WORD WHERE CATEGORY = 'yousu' order by rand() limit 0,1;");
$row2 = $stmt->fetch();
$rand = rand(1,3);
switch ($rand){
	case 1:
$answer = "世界一の".$row[0]."になりたいんだ。";
  break;
case 2:
$answer = $row2[0].$row[0]."になりたいんだ。";
  break;
case 3:
$answer = $row[0]."を独り占めしたいなあ。";
  break;
  default:
}
break;
//様子をうかがう
case 'silent':
$stmt = $pdo->query("SELECT WORD FROM SYLDRA_WORD WHERE CATEGORY = 'serihu' order by rand() limit 0,1;");
$row = $stmt->fetch();
$answer = $row[0];
  break;
default:
  // 処理
}

$stmt = $pdo->query("SELECT * FROM posts order by ID DESC");
?>
<!DOCTYPE html>
<html lang="ja">
<html>
<head>
<meta charset="UTF-8">
<titleみんなで育てるシルドラくん</title>
<style type="text/css">
body {  
    text-align: center;  
      background-color:#e9e5f9;
}  
body text{
  font-family:"メイリオ", sans-serif;

}
</style>　
<script type="text/javascript">
<!--
// -->
</script>
</head>
<body>
<image src="http://syldra.secret.jp/image/sirudoraBorned.png" width="500px" height="300px" id="eggborn" border="0" style="margin:30px;"/><br><br>
<text><?php echo $answer;
?></text>
<br>
<br>
<a href="http://syldra.secret.jp/BringUpSyldra/question.php" style="border:0;">もう一度たずねる</a>
<br>
<br>
<a href="http://syldra.secret.jp/BringUpSyldra/main.php" style="border:0;">シルドラくんトップに戻る</a>
<br>
<br>
</body>
</html>