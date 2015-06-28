<?php
//====param=======================================
//$USER_NAME
//$USER_ID
//$USER_PASS
//$USER_PASS_RE
//$errormsg
//================================================
	$SALT = "a";
//*****POSTされた値をHASH変換、サニタイジング処理し取得*****
    $USER_NAME = htmlentities($_POST["USER_NAME"], ENT_QUOTES, "UTF-8");
    $USER_ID = htmlentities($_POST["USER_ID"], ENT_QUOTES, "UTF-8");
	$USER_PASS = $_POST["USER_PASS"];
	$USER_PASS_RE = $_POST["USER_PASS_RE"];
//*****バリデーション*****
	$errormsg = array();
//USER_NAME
	if ($USER_NAME == null) {
		$errormsg[] = "なまえを入力してね。";
	}
	if (mb_strlen($USER_NAME,'UTF-8')> 20) {
		$errormsg[] = "なまえは20文字以内で入力してね。";
	}
//DB接続しUSER_IDとUSER_NAMEの重複チェック
    try {
$pdo = new PDO('mysql:host=mysql010.phy.lolipop.lan;dbname=LAA0535115-dbname;charset=utf8','ユーザー名','パスワード');
array(PDO::ATTR_EMULATE_PREPARES => false);
} catch (PDOException $e) {
 exit('データベース接続失敗。'.$e->getMessage());
}
$sql = 'SELECT * FROM MST_USER';
$stmt = $pdo->query($sql);
while ($COLUMN = $stmt->fetch(PDO::FETCH_ASSOC)){
  if($USE_ID == $COLUMN['USER_ID']){
  	$errormsg[] = "入力されたIDは登録済みだよ。";
  }
  if($USER_NAME == $COLUMN['USER_NAME']){
  	$errormsg[] = "入力されたなまえは登録済みだよ。";
}
}
//USER_ID
	if ($USER_ID == null) {
		$errormsg[] = "IDを入力してください。";
	}
	$ret = preg_match("/^[a-zA-Z0-9]+$/", $USER_ID);
	if (!$ret) {
		$errormsg[] = "IDは半角英数字で入力してね。";
	}
		if (mb_strlen($USER_ID,'UTF-8') > 10) {
		$errormsg[] = "IDは10文字以内で入力してね。";
	}
//USER_PASS
	if ($USER_PASS == null) {
		$errormsg[] = "パスワードを入力してね。";
	}
	if ($USER_PASS != $USER_PASS_RE) {
		$errormsg[] = "パスワード（再入力）にはパスワードと同じものを入力してね。";
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
<h1>修正ページ</h1>
<form action="./main.php" method="post">
    <table id="tbl_register">
        <tr>
            <th>
                なまえ（20文字以内）
            </th>
            <td>
                <input type="text" name="USER_NAME" value="<?= $USER_NAME ?>"/>
            </td>
        </tr>
                <tr>
            <th>
                ID（半角英数字10文字以内）
            </th>
            <td>
                <input type="text" name="USER_ID" value="<?= $USER_ID ?>"/>
            </td>
        </tr>
        <tr>
            <th>
                パスワード
            </th>
            <td>
                <input type="password" name="USER_PASS" value="<?= $USER_PASS ?>"/>
            </td>
        </tr>
                <tr>
            <th>
                パスワード（再入力）
            </th>
            <td>
                <input type="password" name="USER_PASS_RE" value="<?= $USER_PASS_RE ?>"/>
            </td>
        </tr>
	<tr>
		<th colspan="2">
				<input type="submit" value="修正完了" />
			</form>
		</th>
	</tr>
</table>
</body>
</html>