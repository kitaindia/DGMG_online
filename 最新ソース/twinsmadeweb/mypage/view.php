<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>TWINS MADE　Web ■アバターカタログ</title>
<script type="text/javascript" src="http://syldra.secret.jp/twinsmadeweb/common/js/jquery-1.11.2.min.js"></script>
</head>
<body>
<script>
/**■■■■■■■■■■■■■■■■■■メソッド■■■■■■■■■■■■■■■■■■**/
//■■■■■■■■■■■■試着
//**ID=アバターアイテムのID
//**CATE=アバターアイテムのカテゴリー
  function trying(ID,CATE){
    if(!window.opener || window.opener.closed)
    {
      // dressing.phpの存在をチェック
      // 存在しない場合は警告ダイアログを表示
      window.alert('アバターウィンドウが消えてるよ。');
    }
    else
    {
      window.opener.$("#"+CATE+"Img").attr('src',"http://syldra.secret.jp/avatar/visual/"+CATE+"/"+ID+".png");
    }
  }

//■■■■■■■■■■■■買い物カゴに追加

/**■■■■■■■■■■■■■■■■■■実行処理■■■■■■■■■■■■■■■■■■**/
$(function(){
    $('div').click(function(){
      var ID = $(this).attr("id");
      var CATE = $(this).attr("class");
        trying(ID,CATE);
    });
});
</script>
<iframe src="search.php" name="search" width="500" height="100" frameborder="0" seamless></iframe><br>
<?php
/*categoryを$_SESSION['category']に保存しておく。
2ページ目以降で$_POSTが無効化されるっぽいので、、無効化されてたら、$_SESSIONを漁る。
*/

if($_POST['category']==NULL){
    $_POST['category']=$_SESSION['category'];
}

$_SESSION['category']=$_POST['category'];


/*Pager先生を読み込む*/
require_once("Pager/Pager.php");


/*適宜コネクト*/
$pdo = new PDO('mysql:host=mysql010.phy.lolipop.lan;dbname=LAA0535115-dbname;charset=utf8','ユーザ名','パスワード');

/*取ってきたcategoryでＳＥＬＥＣＴ文を作る。*/
$sql = "SELECT * FROM AVATAR_SHOP WHERE PARTS_CATEGORY = :PARTS_CATEGORY";
$items = $pdo->prepare($sql);
$items->bindValue(':PARTS_CATEGORY',$_SESSION['category'], PDO::PARAM_STR);
$items->execute();
$count=$items->rowCount();

/*Ｐager先生のためのパラメータ設定*/
$perPage = 6;
$params = array(
    "mode"
    =>'sliding',//リンク方式：ジャンプ型(Jumping)、スライド型(Sliding)
    "perPage"
    =>$perPage,//1ページあたりの項目数　ここでは6個
    "totalItems"=>$count,//項目の総数(この場合マッチした総件数）
    "firstPagePre"=>"",
    "firstPageText"=>"先頭",
    "firstPagePost"=>"",
    "lastPagePre"=>"",
    "lastPageText"=>"最後",
    "lastPagePost"=>"",
    "separator"=>"",
    "spacesAfterSeparator"=>0.5,//リンク表示の文字幅(デフォルトだと結構広い)
    "spacesBerorSeparator"=>0.5,//同じく
    );
$pager= Pager::factory($params);//作った$paramsを与えて、オブジェクト生成。
$navi=$pager->getLinks();//getLinkメソッドで作った各ページへのリンク情報を$naviへ格納。
print($navi['all'].'</br></br>');//$navi[]（連想配列）を表示することでmodeで指定したようなリンクナビが表示される。
print($pager->numItems()."件中   ");//numItemsメソッドでtotalItemの数値を獲得。

$scope=$pager->getOffsetByPageID();//引数なしの場合、現在のページIDを元に、何番目から何番目まで扱うのかが格納された配列を返す。非推奨。
print($scope['0']."～".$scope['1']."件目を表示</br></br>");
//テーブルの一番上に列名を作成
print('
     <table>
      <tr bgcolor="cccccc">
        <th>アイテム名</th>
        <th>試着</th>
        <th>販売価格</th>
        <th>買い物カゴ</th>
      </tr>');

/*
以下の式で、このページに表示すべき最初の番号が得られる。この例では
1ページ目なら(1-1)＊6＝0番目
2ページ目なら(2-1)＊6＝6番目
*/
$start=($pager->getCurrentPageID()-1)*$perPage;

$cnt = $perPage;//何個ずつ表示するか。＄perPageのままでよかった。


/*以下、主な情報表示部。*/
$i=$start;
$sql = "SELECT * FROM AVATAR_SHOP WHERE PARTS_CATEGORY = :PARTS_CATEGORY LIMIT $start,$cnt";
$items = $pdo->prepare($sql);
$items->bindValue(':PARTS_CATEGORY',$_SESSION['category'], PDO::PARAM_STR);
$items->execute();

 while(($i < ($start+$perPage)) && ($item = $items->fetch(PDO::FETCH_NUM))){
        print("
             <tr>
                <td>".$item['1']."</td>
                <td><div class=\"".$item['2']."\" id=\"".$item['0']."\">試着</div></td>
                <td>4</td>
                <td><input type=\"checkbox\"></td>
             </tr>
           ");
      $i++;
}



print("</table>");
print($navi['all']);/*最下部にもリンクナビを表示させてみた*/
?>
</body>
</html>