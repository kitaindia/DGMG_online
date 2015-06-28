<html>
<head><title>PHP TEST</title>
<meta charset="UTF-8"></head>
<body>
<?php
// include
require_once 'Pager.php';
 
// 初期設定
$item_per_page = 3;
 
// データ
$data  = array(a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z);
$count = sizeof($data);
 
// パラメータ設定
unset($options);
$options['itemData'] = $data;
$options['delta'] = 3;
$options['perPage'] = $item_per_page;
$options['path'] = 'http://tutty.info/path';
$options['fileName'] = '?p=%d';
$options['append'] = false;
$options['urlVar'] = 'p';
$options['mode'] = "sliding";
$options['separator'] = "";
$options['spacesBeforeSeparator'] = 1;
$options['spacesAfterSeparator'] = 1;
$options['prevImg'] = "前へ";
$options['nextImg'] = "次へ";
$options['firstPagePre'] = "";
$options['firstPageText'] = "最初";
$options['firstPagePost'] = "";
$options['lastPagePre'] = "";
$options['lastPageText'] = "最後";
$options['lastPagePost'] = "";
 
// インスタンス作成
$pager =& Pager::factory($options);
 
// データ取得
$data = $pager->getPageData();
 
// ナビゲーション文字列取得
$navi = $pager -> getLinks();
 
// 現在・最大ページ番号取得
$page = $pager -> getCurrentPageID();
$max_page = $pager -> numPages();
 
// 表示開始・終了位置を取得
list($start,$end) = $pager->getOffsetByPageId();
 
// 出力
echo $count . '件中' . $start . '-' . $end . '件表示';
echo '(' . $page . '/' . $max_page . 'ページ）<br>';
echo $navi['all'] . '<br>';
foreach($data as $d){
  echo $d[0];
}
?>
</body>
</html>