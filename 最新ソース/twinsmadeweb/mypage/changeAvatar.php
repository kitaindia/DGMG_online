<?php
session_start();
?>
<html>
<head><title>PHP TEST</title>
<meta charset="UTF-8"></head>
<body>
<p>テスト</p>
<form method="post" action ="changeAvatar.php" >
<select name="SEARCH_CATEGORY">
<option value="all">全て</option>
<option value="kao">顔</option>
<option value="hada">肌</option>
<option value="kami">髪</option>
<option value="huku">服</option>
<option value="kutu">靴</option>
<option value="akuse">アクセサリー</option>
<option value="mochimono">持ち物</option>
<option value="backimg">背景</option>
</select>
<input type="submit" name="searchButton" value="Let's検索ゥ!">
</form>
<?php
//セッションアウトによるリダイレクト
if(!isset($_SESSION["USER_ID"]))
{
header("Location: http://syldra.secret.jp/twinsmadeweb/index.php");
exit;
}
$_SESSION["SEARCH_CATEGORY"] = $_POST["SEARCH_CATEGORY"];
//ページャー関数
function pager_search ($sql,$cate) {
    //インストールしたPEARのPagerライブラリを読み込む
    require_once("Pager/Pager.php");
 
    //1ページあたりに表示するデータ数
    $pagelength = "10";
 
    //データを格納する配列
    $data_array=array();
 
    //SQLを実行する
    $sql->bindValue(':CATE', $cate, PDO::PARAM_STR);
    $sql->execute();
    $list = $sql->fetchAll(PDO::FETCH_ASSOC);

    //データ数を取得する
    $total = count($list);
 
    //ページャーライブラリに渡す設定（パラメーター
    $page=array(
    "itemData"=>$list,  //アイテムの配列です。
    "totalItems"=>$total, //合計アイテム数
    "perPage"=>$pagelength, //１ページあたりの表示数
    "mode"=>"Jumping",
    "linkClass" => "list",
    "curPageLinkClassName" => "list",
    "altFirst"=>"First", //以下、文字表示設定　１ページ目のalt表示
    "altPrev"=>"", //前のalt
    'prevImg'=>"&lt;&lt; 前へ", //前へ　の文字表示
    "altNext"=>"", //次へ　のalt
    "nextImg"=>"次へ &gt;&gt;", //次へ　の文字表示
    "altLast"=>"Last", //ラストのalt表示
    "altPage"=>"",
    "separator"=>" ", //数字と数字の間の文字
    "append"=>1,
    "urlVar"=>"page",//get属性
    );
 
    //Pagerに設定した項目を読み込ませます
    $pager= Pager::factory($page);
 
    //現在のページ配列（戻り値）を取得
    $data_array['data'] = $pager->getPageData();
    //ページ遷移のリンクリストを取得
    $data_array['links'] = $pager->links;
    $data_array['total'] = $pager->numItems();
    //データ配列を返す

    return $data_array;
}
//条件を付加したデータを取得する
    try {
$pdo = new PDO('mysql:host=mysql010.phy.lolipop.lan;dbname=LAA0535115-dbname;charset=utf8','ユーザー名','パスワード');
array(PDO::ATTR_EMULATE_PREPARES => false);
} catch (PDOException $e) {
 exit('データベース接続失敗。'.$e->getMessage());
}
$sql = $pdo->prepare("SELECT * FROM AVATAR_SHOP WHERE PARTS_CATEGORY = :CATE");
$sql->bindValue(':CATE', $_SESSION["SEARCH_CATEGORY"], PDO::PARAM_STR);
$sql->execute();
$_SESSION["SQL"] = $sql;
$data = pager_search ($_SESSION["SQL"],$_SESSION["SEARCH_CATEGORY"]);
//登録データを出力
foreach ($data['data'] as $row){
  echo $row['PARTS_NAME'];
  echo $row['VALUE'];
  echo "<br>";
}
echo '<div class="pager">';
echo $data['links'];
echo '</div>';
echo $_SESSION["SEARCH_CATEGORY"];
echo $_POST["SEARCH_CATEGORY"];
?></p>
</body>
</html>