<?php
//増加分金貨枚数の変数
$addCoin = 2;
session_start();
	$id =$_POST["id"];
	$pass = $_POST["password"];
$link = mysql_connect('mysql010.phy.lolipop.lan', 'ユーザー名','パスワード');
if (!$link) {
    die('接続失敗です。'.mysql_error());
}
$db_selected = mysql_select_db('LAA0535115-dbname', $link);
if (!$db_selected){
    die('データベース選択失敗です。'.mysql_error());
}
mysql_set_charset('utf8');
$result = mysql_query('SELECT * FROM db_user');
if (!$result) {
    die('クエリーが失敗しました。'.mysql_error());
}
while ($row = mysql_fetch_assoc($result)) {
  if($id == $row['id'] && $pass == $row['pass']){
    $_SESSION['name']=$row['name'];
    $_SESSION['guildmember']=$row['guildmember'];
    $_SESSION["id"] = $id;
    $_SESSION["password"] = $pass;
///毎日ログインで金貨1枚ゲット
//データベース接続
    $pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト名', 'ユーザー名', 'パスワード');
    $pdo->query('SET NAMES utf8');
    date_default_timezone_set('Asia/Tokyo');
//ログインした記録の有無判定
    $exist = $pdo->query("SELECT EXISTS(SELECT * FROM LOG_LOGIN WHERE USER_ID = '".$id."')");
    if($exist==true){
//前回ログイン日付を取得
      $query = $pdo->query("SELECT * FROM LOG_LOGIN WHERE `USER_ID` = '".$id."' ORDER BY LOGIN_DATE DESC LIMIT 1 ");
      $lastlog = $query->fetch();
      $lasttime = $lastlog[1];
//今回ログイン日付を取得
      $time = date('Y-m-d');
//ログイン処理
      $logLogin2 = $pdo -> prepare("INSERT INTO LOG_LOGIN (`USER_ID`,`LOGIN_DATE`) VALUES ('".$id."','".$time."')");
      $logLogin2->execute();
//最終ログイン日＋１日＝今日　であれば金貨１枚追加
      if(date("Y-m-d", strtotime("-1 day"))==$lasttime){
        $sirudoru = $pdo -> prepare("UPDATE db_user SET sirudoru = sirudoru+'".$addCoin."' WHERE id = '$id'");
        $sirudoru->execute();
        $notice ="毎日ログインありがとうございます！<br>金貨を".$addCoin."枚獲得しました！";}
    }else{
//ログイン処理
      $time = date('Y-m-d');
      $logLogin2 = $pdo -> prepare("INSERT INTO LOG_LOGIN (`USER_ID`,`LOGIN_DATE`) VALUES ('".$id."','".$time."')");
      $logLogin2->execute();
    }
  }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="description" content="オンラインゲーム＜MazeMyth＞のギルド『シルドラ』のメンバー専用ページです。" />
<meta name="keywords" content="MazeMyth,メイズミス,シルドラ,アバター,ブラウザゲーム" />
<title>シルドラMember'sWebSite</title>
<link rel="shortcut icon" href="image/favolite.ico">
<link rel="stylesheet" type="text/css" href="css/html5reset.css"  />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<style TYPE="text/css">
#osirase {
	float:left;
}
</style>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-55630755-1', 'auto');
  ga('send', 'pageview');

</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
<!--
// -->
</script>
</head>
<body>
<div id="header">
<?php include( $_SERVER['DOCUMENT_ROOT'] . '/dropDownMenu.php'); ?>
</div>
<br>
<div id="osirase">
<?php if(isset($_SESSION["id"])){
echo "ようこそ".$_SESSION['name']."さん<br>";
echo "前回ログイン日:".$lastlog[1]."<br>";
echo $notice;
}
?>
<h2>▼アカウント登録のお願い</h2>
<p>
<text>[ゲーム]内の各ページにアクセスしたい方は</text><br>
<text><a href="confirm.php">こちら</a>でアカウント登録後、ログインをお願いします。</text><br>
<text>さらに[メンバー専用ページ]内の各ページにアクセスしたい方は、ブラウザゲームMazeMyth内のギルド シルドラ のメンバーに登録してください。</text><br>
<text>その後、個人チャットでサリサ（ギルドマスター）宛てに、メンバー専用ページアクセス希望の旨をご連絡下さい。</text><br>
</p>
<h2>▼ギルドメンバー大募集</h2>
<p>
<text>現在、シルドラでは一緒に戦ってくれる仲間を大募集しています！</text><br>
<text>サーバー『ミケ』にて活動中です！</text><br>
<text>MazeMythをより面白おかしく楽しく遊ぶために、助け合っていけるメンバーを求めます。</text><br>
<text>ぜひギルドメンバーになってください！</text><br>
</p>
<h2>▼最新イベント/HP情報など</h2>
<p><text><font color="red">・換金所でポイントを金貨に交換できるようになりました。</font></text><br></p>
<p><text><font color="red">・ミニゲーム「めくってシルドラくん」の試験運用を開始しました。</font></text><br></p>
<br>
<?php
if(!isset($_SESSION["id"])){
print<<<EOF
<form action="index.php" method="post">
ID<br>
<input type="text" name="id"><br>
PASSWORD<br><input type="password" name="password"><br>
<br>
<input type="submit" value="ログイン" style="width:100px;">
</form>
</div>
EOF;
}
if(isset($_SESSION["id"])){
print<<<EOF
<a href="logout.php"><text>ログアウト<text></a>
EOF;
}
?>
</div>
<div id="kousin">
<br>
<form>
<select name="kousin">
<option value="a">---------更 新 履 歴---------</option>
<option value="a">2015.5.4 / 換金所でポイントを金貨に交換できるようになりました。</option>
<option value="a">2015.5.2 / ミニゲーム「めくってシルドラくん」の試験運用を開始しました。</option>
<option value="a">2014.12.10 / サイトをリニューアルしました。（アバター機能あり）</option>
<option value="a">2014.11.18 / シルドラくんが言葉を覚えたり、質問に答えたりできるようになりました。</option>
<option value="a">2014.11.16 / 共有投稿ギャラリーを公開。</option>
<option value="a">2014.11.06 / チャットにキーワードHITで１シル$ゲット機能追加のメンテナンス終了、公開再開。</option>
<option value="a">2014.11.05 / チャットにキーワードHITでシル$ゲット機能追加。(訂正:メンテナンス中につき一時非公開)</option>
<option value="a">2014.11.05 / リニューアルしたショップ（準備中）を公開。</option>
<option value="a">2014.10.31 / 新しいチャット(機能付き)を公開。</option>
<option value="a">2014.10.30 / 新しいチャット(準備中)を公開。</option>
<option value="a">2014.10.27 / トップページを大幅にリニューアル。</option>
<option value="a">2014.10.25 / トップページを設置。</option>
<option value="a">2014.10.25 / フレーム非対応ユーザー向けにリンクアイコン設置。</option>
<option value="a">2014.10.21 / ギルドルールを改訂。</option>
<option value="a">2014.10.20 / 「シルドラくん」にシル$ゲット機能追加。</option>
<option value="a">2014.10.19 / 「皆で育てるシルドラくん」設置。</option>
<option value="a">2014.10.15 / ギャラリーをリニューアル</option>
<option value="a">2014.10.14 / ファビコンを変更</option>
<option value="a">2014.10.12 / アカウント登録機能を実装</option>
<option value="a">2014.10.09 / トップページにハロウィンイラストを掲載</option>
<option value="a">2014.10.04 / メニュー背景の変更ボタンを設置</option>
<option value="a">2014.10.04 / 認証を一部のページに限定</option>
<option value="a">2014.09.26 / チャット(ミニゲーム付き)を実装</option>
<option value="a">2014.09.19 / インフォメーション更新</option>
<option value="a">2014.09.19 / サイト開設</option>
</select>
</form>
</div>
</body>
</html>