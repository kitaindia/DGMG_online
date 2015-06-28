<?php
//試し書き
//-DB接続
$pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト名', 'ユーザー名', 'パスワード');
$pdo->query('SET NAMES utf8');
//-ギルドメンバーのVISUALのリスト取得
$memberVisuals = $pdo->query('SELECT * FROM AVATAR_USER_VISUAL INNER JOIN db_user ON AVATAR_USER_VISUAL.USER_ID = db_user.id ORDER BY FIELD(shokui, "ギルドマスター","サブマスター","メンバー","マネージャー"),FIELD(job, "メイジ","プリースト","ナイト","不明"),FIELD(seibetu, "♂","♀")');
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
<title>SITENAME &gt; CONTACT</title><!-- ////////// サイト名 ////////// -->
<style TYPE="text/css">
<!--
#submit_button{
float: left;
    background: -moz-linear-gradient(top, #fff, #e1e1e1 1%, #e1e1e1 50%, #cfcfcf 99%, #ccc);  
    background: -webkit-gradient(linear, left top, left bottom, from(#fff), color-stop(0.01, #e1e1e1), color-stop(0.5, #e1e1e1), color-stop(0.99, #cfcfcf), to(#ccc)); 
}
.base {
    position: relative;
    width: 173px;
    height: 307px;
}
.base #hadaImg {
    position: absolute;
    width: 173px;
    height: 307px;
}
.base #kaoImg {
    position: absolute;
    width: 173px;
    height: 307px;
}
.base #kamiImg {
    position: absolute;
    width: 173px;
    height: 307px;
}
.base #akuseImg {
    position: absolute;
    width: 173px;
    height: 307px;
}
.base #kutuImg {
    position: absolute;
    width: 173px;
    height: 307px;
}
.base #hukuImg {
    position: absolute;
    width: 173px;
    height: 307px;
}
.base #mochimonoImg {
    position: absolute;
    width: 173px;
    height: 307px;
}

-->
</style>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-55630755-1', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body>
<div id="header">
<?php include( $_SERVER['DOCUMENT_ROOT'] . '/dropDownMenu.php'); ?>
</div>
	<center>
	<!-- ////////// コンタクトここから ////////// -->

		<h1>MEMBERS</h1>

		<h2>メンバー紹介</h2>
		<table summary="登録用">
	<tr>
	<th>職位</th>
	<th>なまえ</th>
	<th>性別</th>
	<th>職業</th>
	<th>自己紹介</th>
	<th>金貨</th>
	<th>アバター</th>
	</tr><?php
while($row = $memberVisuals->fetch(PDO::FETCH_ASSOC)) {
$name = $row["name"];
$job = $row["job"];
$comment = $row["comment"];
$seibetu = $row["seibetu"];
$shokui = $row["shokui"];
$sirudoru = $row["sirudoru"];
$kao = $row["KAO"];
$kami =$row["KAMI"];
$huku =$row["HUKU"];
$akuse =$row["ACCESSORY"];
$kutu =$row["KUTU"];
$mochimono =$row["MOCHIMONO"];
$hada =$row["HADA"];
	print "<tr><td ";
		switch ($shokui) {
		case 'ギルドマスター':
			print 'style="background-color:#FFD700;"';
			break;
		case 'サブマスター':
			print 'style="background-color:#FFFF00;"';
			break;
		case 'メンバー':
			print 'style="background-color:#FAFAD2;"';
			break;
		default:
			# code...
			break;
	}
	print ">{$shokui}</td><td>{$name}</td><td ";
		switch ($seibetu) {
		case '♂':
			print 'style="background-color:#F0FFFF;"';
			break;
		case '♀':
			print 'style="background-color:#FFFAFA;"';
			break;
		default:
			# code...
			break;
	}
	print">{$seibetu}</td><td ";
	switch ($job) {
		case 'メイジ':
			print 'style="background-color:#F8F8FF;"';
			break;
		case 'プリースト':
			print 'style="background-color:#F0FFF0;"';
			break;
		case 'ナイト':
			print 'style="background-color:#FFF5EE;"';
			break;
		default:
			# code...
			break;
	}
	print ">{$job}</td><td>{$comment}</td><td>";
	if($name=="サリサ"){print "0";}else{print $sirudoru;}
	print "</td>";
	print "<td>";
	print "<div class=\"base\"><img id=\"hadaImg\" src=\"http://syldra.secret.jp/avatar/visual/hada/";
	print $hada;
	print ".png\">";
	print "<img id=\"kaoImg\" src=\"http://syldra.secret.jp/avatar/visual/kao/";
	print $kao;
	print ".png\">";
	print "<img id=\"kamiImg\" src=\"http://syldra.secret.jp/avatar/visual/kami/";
	print $kami;
	print ".png\">";
	print "<img id=\"akuseImg\" src=\"http://syldra.secret.jp/avatar/visual/akuse/";
	print $akuse;
	print ".png\">";
	print "<img id=\"kutuImg\" src=\"http://syldra.secret.jp/avatar/visual/kutu/";
	print $kutu;
	print ".png\">";
	print "<img id=\"hukuImg\" src=\"http://syldra.secret.jp/avatar/visual/huku/";
	print $huku;
	print ".png\">";
	print "<img id=\"mochimonoImg\" src=\"http://syldra.secret.jp/avatar/visual/mochimono/";
	print $mochimono;
	print ".png\"></div>";
	print "</td></tr>";
}
?>
</table>
</center>
<center>
<form action="./comment.php" method="post">
<h2 style="text-align:center;"><text>自己紹介の更新ができるよ</text></h2>
<form action="comment.php" method="POST">
	<table summary="登録用">
	<tr>
	<th>なまえ</th>
	<th>自己紹介</th>
	<th>↓更新ボタン↓</th>
	</tr>
	<tr>
	<td><?php echo $_SESSION['name'];?></td>
	<td><input type="textarea" value="<?php print $_SESSION['comment'];?>" name="updcom"</td>
	<td><input type="submit" name="submit" id="submit_button" value="更新" style="background-color: white; width:75;"></td>
	</tr>
	</table>
	<br>
</form>
<br>
</center>
		<ul class="PAGETOP">
			<li><a href="#PAGETOP" title="ページトップへ戻る">PAGETOP</a></li>
		</ul>

	<!-- ////////// コンタクトここまで ////////// -->

<div id="FOOTER">

	<!-- ////////// フッターここから ////////// -->

		シルドラMember'sWebSite| <a href="http://syldra.secret.jp/index.php" target="_top">http://syldra.secret.jp/index.php</a>


	<!-- ////////// フッターここまで ////////// -->

</div><!-- #FOOTER /END -->

</div><!-- #CONTAINER /END -->
</center>
</body>
</html>