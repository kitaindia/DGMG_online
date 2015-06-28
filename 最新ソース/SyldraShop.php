<?php
//MST_ITEMSに接続
$pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト名', 'ユーザー名', 'パスワード');
$pdo->query('SET NAMES utf8');
$stmt = $pdo->query("SELECT ITEM_NAME, ITEM_COMMENT,ITEM_PRICE,ITEM_CATEGORY FROM MST_ITEMS ORDER BY  `id` ");
$i = 0;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>商品一覧</title>
<style TYPE="text/css">
.input{
width: 65px;
}
#osirase{
	font-family: "メイリオ", sans-serif;
}
.CSSTableGenerator {
	margin:0px;padding:0px;
	width:70%;
	box-shadow: 10px 10px 5px #888888;
	border:1px solid #000000;
	
	-moz-border-radius-bottomleft:8px;
	-webkit-border-bottom-left-radius:8px;
	border-bottom-left-radius:8px;
	
	-moz-border-radius-bottomright:8px;
	-webkit-border-bottom-right-radius:8px;
	border-bottom-right-radius:8px;
	
	-moz-border-radius-topright:8px;
	-webkit-border-top-right-radius:8px;
	border-top-right-radius:8px;
	
	-moz-border-radius-topleft:8px;
	-webkit-border-top-left-radius:8px;
	border-top-left-radius:8px;
}.CSSTableGenerator table{
    border-collapse: collapse;
        border-spacing: 0;
	width:100%;
	height:100%;
	margin:0px;padding:0px;
}.CSSTableGenerator tr:last-child td:last-child {
	-moz-border-radius-bottomright:8px;
	-webkit-border-bottom-right-radius:8px;
	border-bottom-right-radius:8px;
}
.CSSTableGenerator table tr:first-child td:first-child {
	-moz-border-radius-topleft:8px;
	-webkit-border-top-left-radius:8px;
	border-top-left-radius:8px;
}
.CSSTableGenerator table tr:first-child td:last-child {
	-moz-border-radius-topright:8px;
	-webkit-border-top-right-radius:8px;
	border-top-right-radius:8px;
}.CSSTableGenerator tr:last-child td:first-child{
	-moz-border-radius-bottomleft:8px;
	-webkit-border-bottom-left-radius:8px;
	border-bottom-left-radius:8px;
}.CSSTableGenerator tr:hover td{
	
}
.CSSTableGenerator tr:nth-child(odd){ background-color:#ceffee; }
.CSSTableGenerator tr:nth-child(even)    { background-color:#ffffff; }.CSSTableGenerator td{
	vertical-align:middle;
	
	
	border:1px solid #000000;
	border-width:0px 1px 1px 0px;
	text-align:left;
	padding:11px;
	font-size:15px;
	font-family:Arial;
	font-weight:normal;
	color:#000000;
}.CSSTableGenerator tr:last-child td{
	border-width:0px 1px 0px 0px;
}.CSSTableGenerator tr td:last-child{
	border-width:0px 0px 1px 0px;
}.CSSTableGenerator tr:last-child td:last-child{
	border-width:0px 0px 0px 0px;
}
.CSSTableGenerator tr:first-child td{
		background:-o-linear-gradient(bottom, #b5d5ff 5%, #b5d5ff 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #b5d5ff), color-stop(1, #b5d5ff) );
	background:-moz-linear-gradient( center top, #b5d5ff 5%, #b5d5ff 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#b5d5ff", endColorstr="#b5d5ff");	background: -o-linear-gradient(top,#b5d5ff,b5d5ff);

	background-color:#b5d5ff;
	border:0px solid #000000;
	text-align:center;
	border-width:0px 0px 1px 1px;
	font-size:14px;
	font-family:Arial;
	font-weight:bold;
	color:#ffffff;
}
.CSSTableGenerator tr:first-child:hover td{
	background:-o-linear-gradient(bottom, #b5d5ff 5%, #b5d5ff 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #b5d5ff), color-stop(1, #b5d5ff) );
	background:-moz-linear-gradient( center top, #b5d5ff 5%, #b5d5ff 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#b5d5ff", endColorstr="#b5d5ff");	background: -o-linear-gradient(top,#b5d5ff,b5d5ff);

	background-color:#b5d5ff;
}
.CSSTableGenerator tr:first-child td:first-child{
	border-width:0px 0px 1px 0px;
}
.CSSTableGenerator tr:first-child td:last-child{
	border-width:0px 0px 1px 1px;
}
}
</style>
<script type="text/javascript">
<!--
function dispSubTotal(){
	var price = document.getElementById('price');
	var unitPrice = price.value;
	var qty = document.getElementById('qty');
	var orderQty = qty.value;
	document.getElementById('subtotal').value=price*orderQty;
}
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-55630755-1', 'auto');
  ga('send', 'pageview');
// -->
</script>
</head>
<body>
-店主からのお詫び-<br>品質の良いものだけをお客さんにお届けするために、目をかっぴらいて品質を確かめているところだ。
<br>・・・だから今はちょっと買うのは待っててくれ。本当にすまない。
<br>ムムッ！？・・・このクレヨン、巻紙が少しはがれてる・・・。</text>
<center>
<form action="SyldraShop.php" method="post">
カテゴリー<select name='category'>
	<option value='all'>全てのカテゴリー</option>
	<option value='interior'>インテリア</option>
	<option value='adventure'>冒険アイテム</option>
	<option value='pet'>ペット</option>
	<option value='crayon'>クレヨン</option>
	<option value='other'>その他</option>
</select><br>
<input type='submit' name='disp' value='一覧表示'><br>
</form>
<div class="CSSTableGenerator" >
<form action="purchase.php" method="post">
<table>
	<tbody>
		<tr><?php if($_POST["category"]==="pet"){echo '<th>おなまえ</th>';}else{echo '<th>アイテム名</th>';}?>
			<th>説明</th>
			<th>消費シル$</th>
			<?php if($_POST["category"]==="pet"){echo '<th>飼う匹数</th>';}else{echo '<th>買う数</th>';}?>
			<th>消費シル$合計</th>
		</tr>
<?php
//全商品の表示
//カテゴリーが選択されていない場合OR全てのカテゴリーが選択されている場合に表示
if(is_null($_POST["category"]) or $_POST["category"]==="all"){
while ( $row = $stmt->fetch() ){
$i++;
echo '</tr>';
echo '<td><img src="./itemlist.php?id='.$i.'"></td>';//画像
echo '<td rowspan="2">'.$row[1].'</td>';//説明
echo '<td rowspan="2">'.$row[2].'<img src="image/sirudoru.png"></td>';//価格
echo '<td rowspan="2"><input class="input" type="text" name="qty" onChange="dispSubTotal()"></td>';//購入個数
echo '<td rowspan="2"><input class="input" type="text" name="subtotal"></td>';//小計
echo '</tr>';
echo '<tr>';
echo '<td>'.$row[0].'</td>';//商品名
echo '</tr>';
echo '<input type="hidden" name="price" value="'.$row[2].'">';//単価（hidden）
echo '<input type="hidden" name="imgUrl" value="./itemlist.php?id='.$i.'">';//画像URL（hidden）
}
}
//カテゴリー別
///クレヨン
///カテゴリーがクレヨンの場合に表示
if($_POST["category"]==="crayon"){
$i = 0;
while ( $row = $stmt->fetch() ){
$i++;
	if($row[3] === "クレヨン"){
	echo '</tr>';
echo '<td><img src="./itemlist.php?id='.$i.'"></td>';//画像
echo '<td rowspan="2">'.$row[1].'</td>';//説明
echo '<td rowspan="2">'.$row[2].'<img src="image/sirudoru.png"></td>';//価格
echo '<td rowspan="2"><input class="input" type="text" name="qty" onChange="dispSubTotal()"></td>';//購入個数
echo '<td rowspan="2"><input class="input" type="text" name="subtotal"></td>';//小計
echo '</tr>';
echo '<tr>';
echo '<td>'.$row[0].'</td>';//商品名
echo '</tr>';
echo '<input type="hidden" name="price" value="'.$row[2].'">';//単価（hidden）
echo '<input type="hidden" name="imgUrl" value="./itemlist.php?id='.$i.'">';//画像URL（hidden）
	}
}
}
///インテリア
///カテゴリーがインテリアの場合に表示
if($_POST["category"]==="interior"){
$i = 0;
while ( $row = $stmt->fetch() ){
$i++;

	if($row[3] === "インテリア"){
	echo '</tr>';
echo '<td><img src="./itemlist.php?id='.$i.'"></td>';//画像
echo '<td rowspan="2">'.$row[1].'</td>';//説明
echo '<td rowspan="2">'.$row[2].'<img src="image/sirudoru.png"></td>';//価格
echo '<td rowspan="2"><input class="input" type="text" name="qty" onChange="dispSubTotal()"></td>';//購入個数
echo '<td rowspan="2"><input class="input" type="text" name="subtotal"></td>';//小計
echo '</tr>';
echo '<tr>';
echo '<td>'.$row[0].'</td>';//商品名
echo '</tr>';
echo '<input type="hidden" name="price" value="'.$row[2].'">';//単価（hidden）
echo '<input type="hidden" name="imgUrl" value="./itemlist.php?id='.$i.'">';//画像URL（hidden）
	}
}
}
///冒険アイテム
///カテゴリーが冒険アイテムの場合に表示
if($_POST["category"]==="adventure"){
$i = 0;
while ( $row = $stmt->fetch() ){
$i++;
	if($row[3] === "冒険アイテム"){
	echo '</tr>';
echo '<td><img src="./itemlist.php?id='.$i.'"></td>';//画像
echo '<td rowspan="2">'.$row[1].'</td>';//説明
echo '<td rowspan="2">'.$row[2].'<img src="image/sirudoru.png"></td>';//価格
echo '<td rowspan="2"><input class="input" type="text" name="qty" onChange="dispSubTotal()"></td>';//購入個数
echo '<td rowspan="2"><input class="input" type="text" name="subtotal"></td>';//小計
echo '</tr>';
echo '<tr>';
echo '<td>'.$row[0].'</td>';//商品名
echo '</tr>';
echo '<input type="hidden" name="price" value="'.$row[2].'">';//単価（hidden）
echo '<input type="hidden" name="imgUrl" value="./itemlist.php?id='.$i.'">';//画像URL（hidden）
	}
}
}
///冒険アイテム
///カテゴリーが冒険アイテムの場合に表示
if($_POST["category"]==="pet"){
$i = 0;
while ( $row = $stmt->fetch() ){
$i++;
	if($row[3] === "ペット"){
	echo '</tr>';
echo '<td><img src="./itemlist.php?id='.$i.'"></td>';//画像
echo '<td rowspan="2">'.$row[1].'</td>';//説明
echo '<td rowspan="2">'.$row[2].'<img src="image/sirudoru.png"></td>';//価格
echo '<td rowspan="2"><input class="input" type="text" name="qty" onChange="dispSubTotal()"></td>';//購入個数
echo '<td rowspan="2"><input class="input" type="text" name="subtotal"></td>';//小計
echo '</tr>';
echo '<tr>';
echo '<td>'.$row[0].'</td>';//商品名
echo '</tr>';
echo '<input type="hidden" name="price" value="'.$row[2].'">';//単価（hidden）
echo '<input type="hidden" name="imgUrl" value="./itemlist.php?id='.$i.'">';//画像URL（hidden）
	}
}
}
///その他
///カテゴリーがその他の場合に表示
if($_POST["category"]==="other"){
$i = 0;
while ( $row = $stmt->fetch() ){
$i++;
	if($row[3] === "その他"){
	echo '</tr>';
echo '<td><img src="./itemlist.php?id='.$i.'"></td>';//画像
echo '<td rowspan="2">'.$row[1].'</td>';//説明
echo '<td rowspan="2">'.$row[2].'<img src="image/sirudoru.png"></td>';//価格
echo '<td rowspan="2"><input class="input" type="text" name="qty" onChange="dispSubTotal()"></td>';//購入個数
echo '<td rowspan="2"><input class="input" type="text" name="subtotal"></td>';//小計
echo '</tr>';
echo '<tr>';
echo '<td>'.$row[0].'</td>';//商品名
echo '</tr>';
echo '<input type="hidden" name="price" value="'.$row[2].'">';//単価（hidden）
echo '<input type="hidden" name="imgUrl" value="./itemlist.php?id='.$i.'">';//画像URL（hidden）
	}
}
}
?>
		<tr>
			<td colspan="2" style="background-color:#F0F8FF;">今あるシル$</td>
			<td colspan="3"><input class="input" id="nowSirudoru" type="text"></td>
		</tr>
		<tr>
			<td colspan="2" style="background-color:#F0F8FF;">この買い物で使うシル$</td>
			<td colspan="3" style="background-color:white;"><input class="input" name="totalPrice" id="useSirudoru" type="text"></td>
		</tr>
		<tr>
			<td colspan="2" style="background-color:#F0F8FF;">残るシル$</td>
			<td colspan="3"><input class="input" id="restSirudoru" type="text">　　　　　<input type="submit" name="button_purchase" value="購入する"></td>
		</tr>
</tbody>
	</table>
</form>
<br>
<a href="index.html"><img src="image/back.png" alt="地図へ戻る" style="border:0;"></a>
</center>
</body>
</html>