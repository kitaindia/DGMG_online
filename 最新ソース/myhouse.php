<?php
//セッションをスタート
session_start();
//セッションが無い場合、ログインができない

//SESSIONでID/NAMEを受け取る
$UserId = $_SESSION['id'];
$UserName = $_SESSION['name'];
//DB接続
$pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト名', 'ユーザー名', 'パスワード');
$pdo->query('SET NAMES utf8');
//基本データの取得
$sql = "SELECT name,shokui,seibetu,job,sirudoru,comment FROM db_user WHERE id = :userId";
$dataUser = $pdo->prepare($sql);
$dataUser->bindValue(':userId',$UserId, PDO::PARAM_STR);
$dataUser->execute();
//アイテムデータの取得
$sql = "SELECT ITEM_NAME,ITEM_IMG,ITEM_QTY FROM MYPAGE_ITEMS WHERE USER_ID = :userId";
$dataItems = $pdo->prepare($sql);
$dataItems->bindValue(':userId',$UserId, PDO::PARAM_STR);
$dataItems->execute();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style TYPE="text/css">
<!--
table , td, th {
	border: 1px solid #595959;
	border-collapse: collapse;
}
-->
</style>
<title><?php echo $UserName.'のお家'?></title>
</head>
<body>
<p>基本情報</p>
<table>
	<tbody>
<?php
//基本情報の項目の配列作成
$data = array("なまえ","職位","性別","職業","保有シル$","自己紹介");
//基本情報の内容の配列作成
$dataUserResult = $dataUser->fetch(PDO::FETCH_NUM);
$name = $dataUserResult[0];
$shokui= $dataUserResult[1];
$seibetu = $dataUserResult[2];
$job = $dataUserResult[3];
$sirudoru = $dataUserResult[4];
$comment = $dataUserResult[5];
$dataContents = array($name,$shokui,$seibetu,$job,$sirudoru,$comment);
//基本情報の表示
for($i=0; $i < count($data);$i++){
	echo '<tr>';
	echo '<td>'.$data[$i];
	echo'</td>';
	echo '<td>'.$dataContents[$i];
	echo '</td>';
	echo '</tr>';
}
?>
	</tbody>
</table>
<p>所持アイテム</p>
<?php
//所持アイテムの配列生成
		//$item_i(アイテムの種類数)が5で割り切れるとき、次のテーブルを下にする
		$item_i = 1;
		while($dataItemsResult = $dataItems->fetch(PDO::FETCH_NUM)){
		if($item_i%5 == 0){
			echo'<table style="clear:left;">';
		}else{
			echo '<table style="float:left;">';
	}
		echo'<tbody>';
		echo'<tr>';
		echo'<td>'.$dataItemsResult[0];
		echo'</td>';
		echo'</tr>';
		echo'<tr>';
		echo'<td>'.$dataItemsResult[1];
		echo'</td>';
		echo'</tr>';
		echo'<tr>';
		echo'<td>'.$dataItemsResult[2].'個';
		echo'</td>';
		echo'</tr>';
		echo'</tbody>';
		echo'</table>';
		$item_i++;
	}

?>

</body>
</html>