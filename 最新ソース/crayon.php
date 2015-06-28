<?php
//MST_ITEMSからアイテムのリストを取得
$pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト', 'ユーザ名', 'パスワード');
$pdo->query('SET NAMES utf8');
$stmt = $pdo->query("SELECT ITEM_NAME, ITEM_COMMENT,ITEM_PRICE,ITEM_CATEGORY FROM MST_ITEMS ORDER BY  `id` ");
$itemCount = $stmt->rowCount();
$pages = ceil($itemCount/10);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>シル印良品</title>
<link rel="stylesheet" type="text/css" href="css/html5reset.css"  />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<link rel="stylesheet" href="css/simplePagination.css" type="text\css">
<style type="text/css">
.selection {display: none;}
#page-1 { display: block;}
/** 商品欄 **/
#img {
    position: absolute;
    float : left; 
}
#name {
    position: absolute;
}
</style>
<script type='text/javascript' src='/js/jquery.js'></script>
<script type='text/javascript' src='/js/jquery.simplePagination.js'></script>
<script type="text/javascript">
$(function(){
$("#paging").pagination({
items: <?php echo $pages.",";?>
displayedPages: <?php echo $pages.",";?>
cssStyle: 'light-theme',
prevText: '前',
nextText: '次',
onPageClick: function(pageNumber){show(pageNumber)}
})
});
function show(pageNumber){
var page="#page-"+pageNumber;
$('.selection').hide()
$(page).show()
}
</script>
</head>
<body>
<?php
$i = 1;
$imgCount = 0;
echo "<div id=\"paging\"></div>";
while($i<=$pages){
echo "<p class=\"selection\" id=\"page-".$i."\">";
for($count = 0; $count < 10; $count++){
$row = $stmt->fetch();
if(is_null($row[0])){
	break;
}
echo '<tr>';
echo '<td><img src="./itemlist.php?id='.$imgCount.'"></td>';//画像
echo '<td><span style="background-color: #edbe90">'.$row[0].'</span></td>';//商品名
echo '<br>';
echo '<td><span style="background-color: #90ee90">'.$row[1].'</span></td>';
echo '<br>';
echo '<td><span style="background-color: #90eddd">必要な金貨'.$row[2].'枚</span></td>';
echo '<br>';
echo '<td><span style="background-color: #eded90">購入数</span><input type="text" value="" name="qty"></td>　';
echo '</br><span style="background-color: #dd90ed">小計</span><td><input type="text" value="" name="subTotal" readonly></td>';
echo '</br><td><span style="background-color: #beed90">購入</span><input type="checkbox" name="purchase[]"></td>';
echo '</tr>';
echo '<br>';
$imgCount++;
}
if($imgCount==10)
{
$imgCount = 10;
}else{
$imgCount = $imgCount+11;
}
$i++;
}
echo '</p>';
echo "<div id=\"paging\"></div>";
?>
合計金額<input type="vatext" value="" name="total"><br>
<input type="submit" value="購入" name="purchaseButton">
<div id="paging"></div>
</body>
</html>

