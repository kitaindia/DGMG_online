<?php
session_start();

if (isset($_SESSION["id"])) {
  $errorMessage = "ログアウトしました。";
}
else {
  $errorMessage = "セッションがタイムアウトしました。";
}
// セッション変数のクリア
$_SESSION = array();
// クッキーの破棄
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
// セッションクリア
@session_destroy();
?>

<html lang="ja">
<head>
<link rel="shortcut icon" href="image/favolite.ico"><!-- ////////// ファビコン ////////// -->
<link rel="stylesheet" type="text/css" href="style.css"><!-- ////////// スタイルシート ////////// -->
<meta http-equiv="Content-Language" content="ja">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="content-language" content="ja">
<title>ログアウト</title><!-- ////////// サイト名 ////////// -->
</head>
<body id="INDEX">

	<!-- ///// インデックスここから ///// -->

    <h1>シルドラ</h1><br>
    <text style="font-size:small; color:white;">Member's Web Site</text>
    <br>
    <br>
  <div><text style="font-size:small; color:white;"><?php echo $errorMessage; ?></text></div>
  <br>
  <ul>
  <li><a href="index.php">ログイン画面に戻る</a></li>
  </ul>

	<!-- ///// インデックスここまで ///// -->

</body>
</html>