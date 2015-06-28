<?php
session_start();

if (!isset($_SESSION["id"])) {
  header("Location: logout.php");
  exit;
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="ja">
<head>
<link rel="shortcut icon" href="image/favolite.ico"><!-- ////////// ファビコン ////////// -->
<link rel="stylesheet" type="text/css" href="style.css"><!-- ////////// スタイルシート ////////// -->
<meta http-equiv="Content-Language" content="ja">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="content-language" content="ja">
<title>シルドラ &gt; ABOUT</title><!-- ////////// サイト名 ////////// -->
</head>
<body id="PAGETOP">

<div id="CONTAINER">

	<!-- ////////// アバウトここから ////////// -->

		<h1>CHAT</h1>
		<h2>交流チャット</h2>
		<br><p>現在準備中です。</p>

		<ul class="PAGETOP">
			<li><a href="#PAGETOP" title="ページトップへ戻る">PAGETOP</a></li>
		</ul>
<div id="FOOTER">

	<!-- ////////// フッターここから ////////// -->

		SITENAME | <a href="http://YOURSITE.URL/" target="_top">http://YOURSITE.URL/</a>

	<!-- ////////// フッターここまで ////////// -->

</div><!-- #FOOTER /END -->

</div><!-- #CONTAINER /END -->

</body>
</html>