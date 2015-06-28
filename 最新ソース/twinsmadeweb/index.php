<?php
//セッション開始
session_start();
//POSTでUSER_IDとUSER_PASSを取得
  $USER_ID = htmlentities($_POST["USER_ID"], ENT_QUOTES, "UTF-8");
  $salt = "x";
  $USER_PASS = crypt($_POST["USER_PASS"],$salt);

  $flg = "1";
//DB接続
    try {
$pdo = new PDO('mysql:host=mysql010.phy.lolipop.lan;dbname=LAA0535115-dbname;charset=utf8','ユーザ名','パスワード');
array(PDO::ATTR_EMULATE_PREPARES => false);
  $flg = "2";
} catch (PDOException $e) {
 exit('データベース接続失敗。'.$e->getMessage());
   $flg = "3";
}
//MST_USERからユーザー情報を取得し、照合を行う
$sql = 'SELECT * FROM MST_USER';
$stmt = $pdo->query($sql);
while ($COLUMN = $stmt->fetch(PDO::FETCH_ASSOC)){
//照合されれば基本ユーザー情報をセッション変数にセットする
  if($USER_ID == $COLUMN['USER_ID'] && $USER_PASS == $COLUMN['USER_PASS']){
    $_SESSION['USER_NAME']=$COLUMN['USER_NAME'];
    $_SESSION["USER_ID"] = $USER_ID;
    $_SESSION["USER_PASS"] = $USER_PASS;
      $flg = "4";
///毎日ログインで金貨1枚ゲット
//ログインした記録の有無判定
    $exist = $pdo->query("SELECT EXISTS(SELECT * FROM LOG_LOGIN WHERE USER_ID = '".$USER_ID."')");
    if($exist==true){
//前回ログイン日付を取得
      $query = $pdo->query("SELECT * FROM LOG_LOGIN WHERE `USER_ID` = '".$USER_ID."' ORDER BY LOGIN_DATE DESC LIMIT 1 ");
      $lastlog = $query->fetch();
      $lasttime = $lastlog[1];
//今回ログイン日付を取得
      $time = date('Y-m-d');
//ログイン処理
      $logLogin2 = $pdo -> prepare("INSERT INTO LOG_LOGIN (`USER_ID`,`LOGIN_DATE`) VALUES ('".$USER_ID."','".$time."')");
      $logLogin2->execute();
//最終ログイン日＋１日＝今日　であれば金貨１枚追加
      if(date("Y-m-d", strtotime("-1 day"))==$lasttime){
        $sirudoru = $pdo -> prepare("UPDATE USER_DETAIL SET USER_COIN = USER_COIN+1 WHERE USER_ID = '$USER_ID'");
        $sirudoru->execute();
        $notice ="毎日ログインありがとうございます！<br>連続ログインボーナスとして金貨を１枚獲得しました！";}
    }else{
//ログイン処理
      $time = date('Y-m-d');
      $logLogin2 = $pdo -> prepare("INSERT INTO LOG_LOGIN (`USER_ID`,`LOGIN_DATE`) VALUES ('".$USER_ID."','".$time."')");
      $logLogin2->execute();
    }
  }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>TWINS MADE　Web</title>
<link rel="stylesheet" type="text/css" href="css/html5reset.css"  />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
<div id="osirase">
<?php if(isset($_SESSION["USER_ID"])){
echo "ようこそ".$_SESSION['USER_NAME']."さん<br>";
echo "前回ログイン日:".$lastlog[1]."<br>";
echo $notice;
}
?>
<?php
if(!isset($_SESSION["USER_ID"])){
print<<<EOF
<form action="index.php" method="post">
ID<br>
<input type="text" name="USER_ID"><br>
PASSWORD<br><input type="password" name="USER_PASS"><br>
<br>
<input type="submit" value="ログイン">
</form>
</div>
EOF;
}
if(isset($_SESSION["USER_ID"])){
print<<<EOF
<a href="http://syldra.secret.jp//twinsmadeweb/logout.php"><text>ログアウト<text></a>
EOF;
}
?>
<?php echo $flg ?>
<?php echo $USER_ID ?>
<?php echo $USER_PASS ?>
</body>
</html>