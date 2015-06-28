<?// この変数はMySQLの検索用クリエなどに使えば良い
$SUBJECT_ID = $_POST['val'];
//座標の配列取得
try {
	$pdo = new PDO('mysql:host=mysql010.phy.lolipop.lan;dbname=LAA0535115-dbname;charset=utf8','ユーザー名','パスワード');
	array(PDO::ATTR_EMULATE_PREPARES => false);
} catch (PDOException $e) {
	exit('データベース接続失敗。'.$e->getMessage());
}
$stmt = $pdo->prepare("SELECT * FROM DOT_DOTS_POSITION WHERE SUBJECT_ID = :SUBJECT_ID");
$stmt->bindValue(':SUBJECT_ID', $SUBJECT_ID, PDO::PARAM_INT);
$stmt->execute();
$resultArray = array();
    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    	$resultArray[]=$result;
    }

header('Content-Type: application/json; charset=utf-8');
echo json_encode($resultArray);
?>