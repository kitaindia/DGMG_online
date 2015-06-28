<?php
	$memberFlg = $_POST["memberFlg"];
	$name = $_POST["name"];
	$id = $_POST["id"];
	$password = $_POST["password"];
	$password2 = $_POST["password2"];
	$comment = $_POST["comment"];

	//入力チェック
	$errormsg = array();
	//なまえ
	if ($name == null) {
		$errormsg[] = "なまえを入力してください。";
	}
	if (mb_strlen($name,'UTF-8')> 20) {
		$errormsg[] = "なまえは20文字以内で入力して下さい。";
	}
	//重複チェック
$link = mysql_connect('mysql010.phy.lolipop.lan', 'ユーザ名','パスワード');
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
  if($id == $row['id']){
  	$errormsg[] = "入力されたIDは登録済みです。";
  }
  if($name == $row['name']){
  	$errormsg[] = "入力されたなまえは登録済みです。";
}
}
	//ID
	if ($id == id) {
		$errormsg[] = "IDを入力してください。";
	}
	$ret = preg_match("/^[a-zA-Z0-9]+$/", $id);
	if (!$ret) {
		$errormsg[] = "IDは半角英数字で入力してください。";
	}
		if (mb_strlen($id,'UTF-8') > 10) {
		$errormsg[] = "IDは10文字以内で入力して下さい。";
	}
	//PASS
	if ($password == null) {
		$errormsg[] = "パスワードを入力して下さい。";
	}
	if ($password != $password2) {
		$errormsg[] = "パスワード（再入力）にはパスワードと同じものを入力してください。";
	}
	//自己紹介文
	if(mb_strlen($comment,'UTF-8') > 100){
		$errormsg[] = "自己紹介文は100文字以内で入力してください。";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="ja">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>アカウント登録</title>
	<style TYPE="text/css">
	<!--
#nameform {
width:100px
}
#form {
width:70px
}
#answer {
width:45px
}
#radio {
width:10px
}
		#contact-form th {
			background-color: #9bdbea;
			padding: 10px 20px;
		}
		#contact-form td {
			background-color: #f7f7ef;
			padding: 10px 20px;
		}
		#contact-form td input {
			width: 100px;
		}
		#contact-form td textarea {
			width: 400px;
		}
		form {
			display: inline;
		}
		#errmsg {
			background-color:#E7D3D6;
			border:3px solid #A55952;
			color:#944121;
			font-size:12px;
			margin:10px;
			padding:10px;
			text-align:left;
			width:400px;
		}
		#seibetu{text-align: left;
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
<h1>アカウント情報入力</h1>
<?php if (count($errormsg) > 0): ?>
<div id="errmsg">
<?php foreach ($errormsg as $msg): ?>
	・<?=$msg?><br />
<?php endforeach; ?>
</div>
<form action="./confirm.php" method="post">
    <table id="contact-form" border="1" cellpadding="0" cellspacing="0">
        <tr>
            <th>
                なまえ（20文字以内）
            </th>
            <td>
                <input type="text" name="name" value="<?= $name ?>" id = "nameform"/>
            </td>
        </tr>
                <tr>
            <th>
                自己紹介文（100文字以内）
            </th>
            <td>
               <textarea name="comment" cols=40 rows=5 wrap="hard"><?php print($comment);?></textarea>
            </td>
        </tr>
                <tr>
            <th>
                ID（半角英数字10文字以内）
            </th>
            <td>
                <input type="text" name="id" value="<?= $id ?>" id="form"/>
            </td>
        </tr>
        <tr>
            <th>
                パスワード
            </th>
            <td>
                <input type="password" name="password" value="<?= $password ?>" id="form"/>
            </td>
        </tr>
                <tr>
            <th>
                パスワード（再入力）
            </th>
            <td>
                <input type="password" name="password2" value="<?= $password2 ?>" id="form"/>
            </td>
        </tr>
        <tr>
            <th colspan="2">
                <input id="answer" type="submit" value="確認">
            </th>
        </tr>
    </table>
</form>
<br>
<?php else: ?>
<table id="contact-form" border="1" cellpadding="0" cellspacing="0">
	<tr>
		<th>
			なまえ
		</th>
		<td>
			<?= $name ?>
		</td>
	</tr>
	<tr>
		<th>
			ID
		</th>
		<td>
			<?= $id ?>
		</td>
	</tr>
	<tr>
		<tr>
		<th>
			自己紹介文
		</th>
		<td>
			<?= $comment ?>
		</td>
	</tr>
	<tr>
	<tr>
		<th colspan="2">
			<form action="./end.php" method="post">
				<input type="hidden" name="name" value="<?= $name ?>">
				<input type="hidden" name="id" value="<?= $id ?>">
				<input type="hidden" name="password" value="<?= $password ?>">
				<input type="hidden" name="password2" value="<?= $password2 ?>">
				<input type="hidden" name="comment" value="<?= $comment ?>">
				<input type="submit" value="送信" />
			</form>
			<form action="./input.php" method="post">
				<input type="hidden" name="name" value="<?= $name ?>">
				<input type="hidden" name="id" value="<?= $id ?>">
				<input type="hidden" name="password" value="<?= $password ?>">
				<input type="hidden" name="password2" value="<?= $password2 ?>">
				<input type="hidden" name="comment" value="<?= $comment ?>">
				<input type="submit" value="内容修正" />
			</form>
		</th>
	</tr>
</table>
<br>
<?php endif; ?>
</center>
</body>
</html>