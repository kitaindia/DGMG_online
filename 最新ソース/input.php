<?php
	$name = $_POST["name"];
	$id = $_POST["id"];
	$password = $_POST["password"];
	$password2 = $_POST["password2"];
	$seibetu = $_POST["seibetu"];
	$job = $_POST["job"];
	$comment = $_POST["comment"];

	//入力チェック
	$errormsg = array();
	//なまえ
	if ($name == null) {
		$errormsg[] = "なまえを入力してください。";
	}
	if (mb_strlen($name) > 20) {
		$errormsg[] = "なまえは20文字以内で入力して下さい。";
	}
	//重複チェック
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
		if (mb_strlen($id) > 10) {
		$errormsg[] = "IDは20文字以内で入力して下さい。";
	}
	//PASS
	if ($password == null) {
		$errormsg[] = "パスワードを入力して下さい。";
	}
	if ($password != $password2) {
		$errormsg[] = "パスワード（再入力）にはパスワードと同じものを入力してください。";
	}
	//自己紹介文
	if(mb_strlen($comment) > 100){
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
		#contact-form th {
			background-color: #9bdbea;
			padding: 10px 20px;
		}
		#contact-form td {
			background-color: #f7f7ef;
			padding: 10px 20px;
		}
		#contact-form td input {
			width: 400px;
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
	-->
	</style>
</head>
<body>
<center>
<h1>アカウント内容修正</h1>
<form action="./confirm.php" method="post">
    <table id="contact-form" border="1" cellpadding="0" cellspacing="0">
        <tr>
            <th>
                なまえ（20文字以内）
            </th>
            <td>
                <input type="text" name="name" value="<?= $name ?>" />
            </td>
        </tr>
        <tr>
            <th>
                キャラクター性別
            </th>
            <td><?php if($seibetu == "♂"){
            	print(
                '<input type="radio" name="seibetu" value="♂" checked>男性
                <input type="radio" name="seibetu" value="♀">女性');
}else{
	print('<input type="radio" name="seibetu" value="♂">男性
                <input type="radio" name="seibetu" value="♀" checked>女性');
} ?>
            </td>
        </tr>
                <tr>
            <th>
                職業
            </th>
            <td><?php 
            if($job == "ナイト"){print('
                <select name="job">
                	<option value="ナイト" selected>ナイト</option>
                	<option value="メイジ">メイジ</option>
                	<option value="プリースト">プリースト</option>
                </select>');
            }
                    if($job == "メイジ"){print('
                <select name="job">
                	<option value="ナイト">ナイト</option>
                	<option value="メイジ" selected>メイジ</option>
                	<option value="プリースト">プリースト</option>
                </select>');
            }
                    if($job == "プリースト"){print('
                <select name="job">
                	<option value="ナイト">ナイト</option>
                	<option value="メイジ">メイジ</option>
                	<option value="プリースト" selected>プリースト</option>
                </select>');
            }
                ?>
            </td>
        </tr>
                <tr>
            <th>
                自己紹介文（100文字以内）
            </th>
            <td>
               <textarea name="comment" cols=40 rows=5 wrap="hard"><?php print($comment)?></textarea>
            </td>
        </tr>
                <tr>
            <th>
                ID（半角英数字10文字以内）
            </th>
            <td>
                <input type="text" name="id" value="<?= $id ?>" />
            </td>
        </tr>
        <tr>
            <th>
                パスワード
            </th>
            <td>
                <input type="password" name="password" value="<?= $password ?>" />
            </td>
        </tr>
                <tr>
            <th>
                パスワード（再入力）
            </th>
            <td>
                <input type="password" name="password2" value="<?= $password2 ?>" />
            </td>
        </tr>
	<tr>
		<th colspan="2">
				<input type="submit" value="修正完了" />
			</form>
		</th>
	</tr>
</table>
</center>
</body>
</html>