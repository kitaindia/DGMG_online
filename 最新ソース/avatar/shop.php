<?php
//IDセッション無し→一般向けリミテーション
session_start();

if(!isset($_SESSION["id"]))
{
header("Location: ../index.php");
exit;
}

//$user_id = $_SESSION["id"];
$user_id = $_SESSION["id"];
//データベース接続
$pdo = new PDO('mysql:dbname=LAA0535115-dbname;host=ホスト名', 'ユーザー名', 'パスワード');
$pdo->query('SET NAMES utf8');
//各カテゴリーのアイテムのリストを取得
//AVATAR_VISUAL_BELONGINGSからPARTS_CATEGORYで紐付け、使用可能アバターパーツのリストを取得
$sql = "SELECT * FROM AVATAR_SHOP WHERE PARTS_CATEGORY = :PARTS_CATEGORY";
//顔
$avatar_user_shop_kao = $pdo->prepare($sql);
$avatar_user_shop_kao->bindValue(':PARTS_CATEGORY','kao', PDO::PARAM_STR);
$avatar_user_shop_kao->execute();
//肌色
$avatar_user_shop_hada = $pdo->prepare($sql);
$avatar_user_shop_hada->bindValue(':PARTS_CATEGORY','hada', PDO::PARAM_STR);
$avatar_user_shop_hada->execute();
//髪型
$avatar_user_shop_kami = $pdo->prepare($sql);
$avatar_user_shop_kami->bindValue(':PARTS_CATEGORY','kami', PDO::PARAM_STR);
$avatar_user_shop_kami->execute();
//服
$avatar_user_shop_huku = $pdo->prepare($sql);
$avatar_user_shop_huku->bindValue(':PARTS_CATEGORY','huku', PDO::PARAM_STR);
$avatar_user_shop_huku->execute();
//アクセサリー
$avatar_user_shop_akuse = $pdo->prepare($sql);
$avatar_user_shop_akuse->bindValue(':PARTS_CATEGORY','akuse', PDO::PARAM_STR);
$avatar_user_shop_akuse->execute();
//靴
$avatar_user_shop_kutu = $pdo->prepare($sql);
$avatar_user_shop_kutu->bindValue(':PARTS_CATEGORY','kutu', PDO::PARAM_STR);
$avatar_user_shop_kutu->execute();
//持ち物
$avatar_user_shop_mochimono = $pdo->prepare($sql);
$avatar_user_shop_mochimono->bindValue(':PARTS_CATEGORY','mochimono', PDO::PARAM_STR);
$avatar_user_shop_mochimono->execute();
//背景
$avatar_user_shop_backimg = $pdo->prepare($sql);
$avatar_user_shop_backimg->bindValue(':PARTS_CATEGORY','backimg', PDO::PARAM_STR);
$avatar_user_shop_backimg->execute();

//AVATAR_VISUALからUSER_IDで紐付け、各パーツ情報を取得
$sql = "SELECT * FROM AVATAR_USER_VISUAL WHERE USER_ID = :USER_ID";
$avatar_visual = $pdo->prepare($sql);
$avatar_visual->bindValue(':USER_ID',$user_id, PDO::PARAM_STR);
$avatar_visual->execute();
$avatar_visual_list = $avatar_visual->fetch(PDO::FETCH_NUM);
///顔
$kao = $avatar_visual_list[1];
///髪
$kami = $avatar_visual_list[2];
///服
$huku = $avatar_visual_list[3];
///アクセサリー
$akuse = $avatar_visual_list[4];
///靴
$kutu = $avatar_visual_list[5];
///持ち物
$mochimono = $avatar_visual_list[6];
///肌
$hada = $avatar_visual_list[7];
///背景
$backimg = $avatar_visual_list[8];

//AVATAR_USER_BELONGINGSからUSER_IDで紐付け、購入済みアイテムのリストを取得
$sql = "SELECT VALUE FROM AVATAR_USER_BELONGINGS WHERE USER_ID = :USER_ID";
$avatar_user_belongings = $pdo->prepare($sql);
$avatar_user_belongings->bindValue(':USER_ID',$user_id, PDO::PARAM_STR);
$avatar_user_belongings->execute();
$belongings = array();
$i = 0;
while($avatar_user_belongings_list = $avatar_user_belongings->fetch(PDO::FETCH_NUM)){
$belongings[$i] = $avatar_user_belongings_list[0];
$i++;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>アバター/ショップ</title>
<link rel="stylesheet" type="text/css" href="css/html5reset.css"  />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<style TYPE="text/css">
/* アバター表示(試着室) */
.base {
    position: relative;
    width: 519px;
    height: 307px;
    float:left;
}
.base #hadaImg {
    position: absolute;
    width: 173px;
    height: 307px;
}
.base #kaoImg {
    position: absolute;
    width: 173px;
    height: 307px;
}
.base #kamiImg {
    position: absolute;
    width: 173px;
    height: 307px;
}
.base #akuseImg {
    position: absolute;
    width: 173px;
    height: 307px;
}
.base #kutuImg {
    position: absolute;
    width: 173px;
    height: 307px;
}
.base #hukuImg {
    position: absolute;
    width: 173px;
    height: 307px;
}
.base #mochimonoImg {
    position: absolute;
    width: 173px;
    height: 307px;
}
.base #backimgImg {
	position: absolute;
	width: 519px;
	height: 307px;
	z-index: -1;
}
/* アコーディオン */
.accordion-box {
	width:200px;
	height:auto;
	margin:0;
	padding:1px 0;
	text-align:left;
	border-bottom:1px #EEEEEE solid;
	background-color:#EEEEEE;
	float:left;
}

.accordion-box h3 {
	width:200px;
	height:20px;
	margin:1px 0 0 1px;
	padding:2px 0 0 10px;
	line-height:20px;
	color:#FFFFFF;
	font-size:12px;
	background:url(/avatar/img/arrow_7.gif) no-repeat;
	background-color:#BBBBBB;
	background-position:right 0px;
	cursor:pointer;
}
/* active */ 
.accordion-box h3.active {
	background-position:right -21px;
}　
/* hovered */
.accordion-box h3.hovered {
	background-color:#555555;
}

.accordion-box .accordion-block {
	display:block;
	width:200px;
	margin:1px 0 0 1px;
	padding:0;
	background-color:#FFFFFF;
}
.accordion-box .accordion-block dl {
	list-style-type:none;
	display:inline-block;
	margin-left:10px;
	padding:0;
}
.accordion-box .accordion-block dl dt {
	list-style-type:none;
	width:200px;
	margin-left:0px;
	padding:0;
	text-align:left;
	font-size:12px;
	font-weight:normal;
	line-height:150%;
	border-bottom:1px #CCCCCC solid;
}
.accordion-box .accordion-block dl dt a {
	text-decoration:none;
	color:#FFD700;
	text-shadow: black 1px 1px 0px, black -1px 1px 0px,
             black 1px -1px 0px, black -1px -1px 0px;
             font-size:12px;
             font-family: "メイリオ";
}
#purchased {
	color:#BBBBBB;
	text-shadow: black 1px 1px 0px, black -1px 1px 0px,
             black 1px -1px 0px, black -1px -1px 0px;
    font-size:12px;
    font-family: "メイリオ";
}
#check {
	text-align: right;
}
/* 合計金額表示 */
#totalCost{
	clear:both;
	font-family: "メイリオ";
}
</style>
<script type="text/javascript" src="http://syldra.secret.jp/js/jquery-1.3.2.min.js"></script>
</head>
<body>
<div id="header">
<?php include( $_SERVER['DOCUMENT_ROOT'] . '/dropDownMenu.php'); ?>
</div>
<script>
function alertNoItems(){//アイテム無しで購入
	totalCost = jQuery('#totalCostForm').val();
	totalCost = parseInt(totalCost);
	if(totalCost==0){
		window.alert("購入する商品が選択されていません。");
		return false;
	}
}
//画像の変更
function change(part,value){
    if(value=="noimg"){
    	$("#"+part+"Img").attr('src','http://syldra.secret.jp/avatar/visual/noimg.png');
    }
    else{
    $("#"+part+"Img").attr('src','http://syldra.secret.jp/avatar/visual/'+part+'/'+value+'.png');
        	switch(part){
        	//肌色
    		case "hada":
    		$(':hidden[name="hada"]').val(value);
    		//顔
    		case "kao":
    		$(':hidden[name="kao"]').val(value);
    		break;
    		//髪
    		case "kami":
    		$(':hidden[name="kami"]').val(value);
    		break;
    		//服
    		case "huku":
    		$(':hidden[name="huku"]').val(value);
    		break;
    		//靴
    		case "kutu":
    		$(':hidden[name="kutu"]').val(value);
    		break;
    		//アクセサリー
    		case "akuse":
    		$(':hidden[name="akuse"]').val(value);
    		break;
    		//持ち物
    		case "mochimono":
    		$(':hidden[name="mochimono"]').val(value);
    		break;
    		//背景
    		case "backimg":
    		$(':hidden[name="backimg"]').val(value);
    		break;
    }
}
}

//金貨加算
function addCost(cost,id){
	if($("#"+id+":checked").val()){
	totalCost = jQuery('#totalCostForm').val();
	totalCost = parseInt(totalCost);
	jQuery("#totalCostForm").val(totalCost+cost);
}else{
	totalCost = jQuery('#totalCostForm').val();
	totalCost = parseInt(totalCost);
	jQuery("#totalCostForm").val(totalCost-cost);
}
}

//アコーディオン
(function($){

	//accordion31
	$(function(){

		//オブジェクトを保存
		var accordionItem=$('#accordion-31');
		//一旦全部消す
		accordionItem.find('div').hide();

		//active要素を指定して開く
		var no=0;
		//accordionItem.find('h3').eq(no).addClass('active').next('div').show();

		//click-action
		accordionItem.find('h3').click(function () {

			//slide
			$(this).next('div').slideToggle('slow')
			.siblings('div:visible').slideUp('slow');
			//activeクラス切り替え
			$(this).toggleClass('active');
			$(this).siblings('h3').removeClass('active');

		});

		//hover-toggle
		accordionItem.find('h3').hover(function () {

			//toggle hoveredクラス
			$(this).toggleClass('hovered');

		});
	});

})(jQuery);



</script>
<!-- 画像表示領域 -->
<div class="base">
<img id="hadaImg" src="http://syldra.secret.jp/avatar/visual/hada/<?php echo $hada?>.png">
<img id="kaoImg" src="http://syldra.secret.jp/avatar/visual/kao/<?php echo $kao?>.png">
<img id="kamiImg" src="http://syldra.secret.jp/avatar/visual/kami/<?php echo $kami?>.png">
<img id="akuseImg" src="http://syldra.secret.jp/avatar/visual/akuse/<?php echo $akuse?>.png">
<img id="kutuImg" src="http://syldra.secret.jp/avatar/visual/kutu/<?php echo $kutu?>.png">
<img id="hukuImg" src="http://syldra.secret.jp/avatar/visual/huku/<?php echo $huku?>.png">
<img id="mochimonoImg" src="http://syldra.secret.jp/avatar/visual/mochimono/<?php echo $mochimono?>.png">
<img id="backimgImg" src="http://syldra.secret.jp/avatar/visual/backimg/<?php echo $backimg?>.png">
</div><br>
<!-- 試着アイテム選択-->
<form action="purchased.php" method="post" onsubmit="return alertNoItems()">
<div id="accordion-31" class="accordion-box">
<!-- 購入済みアイテムてすと-->
	<h3>肌色</h3>
	<div class="accordion-block">
	<dl>
	<?php
	//商品リストのレコード取り出し
	while($avatar_user_shop_hada_list = $avatar_user_shop_hada->fetch(PDO::FETCH_NUM)){
		if(array_search($avatar_user_shop_hada_list[0], $belongings)){
			echo "<dt><a id=\"purchased\" href=\"javascript:void(0);\" onclick=\"change('hada','".$avatar_user_shop_hada_list[0]."')\">".$avatar_user_shop_hada_list[1]."</a></dt>";
		}else{
					echo "<dt><a href=\"javascript:void(0);\" onclick=\"change('hada','".$avatar_user_shop_hada_list[0]."')\">".$avatar_user_shop_hada_list[1]."</a><input id=\"".$avatar_user_shop_hada_list[0]."\" type=\"checkbox\" name=\"itemsHada[]\" value=\"".$avatar_user_shop_hada_list[0]."\" onclick=\"addCost(1,'".$avatar_user_shop_hada_list[0]."')\"></dt>";
				}
	}
	?>
　　　</dl>
	</div>
	<h3>顔</h3>
	<div class="accordion-block">
	<dl>
	<?php
	//商品リストのレコード取り出し
	while($avatar_user_shop_kao_list = $avatar_user_shop_kao->fetch(PDO::FETCH_NUM)){
		if(array_search($avatar_user_shop_kao_list[0], $belongings)){
			echo "<dt><a id=\"purchased\" href=\"javascript:void(0);\" onclick=\"change('kao','".$avatar_user_shop_kao_list[0]."')\">".$avatar_user_shop_kao_list[1]."</a></dt>";
		}else{
					echo "<dt><a href=\"javascript:void(0);\" onclick=\"change('kao','".$avatar_user_shop_kao_list[0]."')\">".$avatar_user_shop_kao_list[1]."</a><input id=\"".$avatar_user_shop_kao_list[0]."\" type=\"checkbox\" name=\"itemsKao[]\" value=\"".$avatar_user_shop_kao_list[0]."\" onclick=\"addCost(1,'".$avatar_user_shop_kao_list[0]."')\"></dt>";
				}
	}
	?>
　　　</dl>
	</div>
	<h3>髪型</h3>
	<div class="accordion-block">
	<dl>
	<?php
	//商品リストのレコード取り出し
	while($avatar_user_shop_kami_list = $avatar_user_shop_kami->fetch(PDO::FETCH_NUM)){
		if(array_search($avatar_user_shop_kami_list[0], $belongings)){
			echo "<dt><a id=\"purchased\" href=\"javascript:void(0);\" onclick=\"change('kami','".$avatar_user_shop_kami_list[0]."')\">".$avatar_user_shop_kami_list[1]."</a></dt>";
		}else{
					echo "<dt><a href=\"javascript:void(0);\" onclick=\"change('kami','".$avatar_user_shop_kami_list[0]."')\">".$avatar_user_shop_kami_list[1]."</a><input id=\"".$avatar_user_shop_kami_list[0]."\" type=\"checkbox\" name=\"itemsKami[]\" value=\"".$avatar_user_shop_kami_list[0]."\" onclick=\"addCost(1,'".$avatar_user_shop_kami_list[0]."')\"></dt>";
				}
	}
	?>
　　　</dl>
	</div>
	<h3>服</h3>
	<div class="accordion-block">
	<dl>
	<?php
	//商品リストのレコード取り出し
	while($avatar_user_shop_huku_list = $avatar_user_shop_huku->fetch(PDO::FETCH_NUM)){
		if(array_search($avatar_user_shop_huku_list[0], $belongings)){
			echo "<dt><a id=\"purchased\" href=\"javascript:void(0);\" onclick=\"change('huku','".$avatar_user_shop_huku_list[0]."')\">".$avatar_user_shop_huku_list[1]."</a></dt>";
		}else{
					echo "<dt><a href=\"javascript:void(0);\" onclick=\"change('huku','".$avatar_user_shop_huku_list[0]."')\">".$avatar_user_shop_huku_list[1]."</a><input id=\"".$avatar_user_shop_huku_list[0]."\" type=\"checkbox\" name=\"itemsHuku[]\" value=\"".$avatar_user_shop_huku_list[0]."\" onclick=\"addCost(4,'".$avatar_user_shop_huku_list[0]."')\"></dt>";
				}
	}
	?>
　　　</dl>
	</div>
	<h3>靴</h3>
	<div class="accordion-block">
	<dl>
	<?php
	//商品リストのレコード取り出し
	while($avatar_user_shop_kutu_list = $avatar_user_shop_kutu->fetch(PDO::FETCH_NUM)){
		if(array_search($avatar_user_shop_kutu_list[0], $belongings)){
			echo "<dt><a id=\"purchased\" href=\"javascript:void(0);\" onclick=\"change('kutu','".$avatar_user_shop_kutu_list[0]."')\">".$avatar_user_shop_kutu_list[1]."</a></dt>";
		}else{
					echo "<dt><a href=\"javascript:void(0);\" onclick=\"change('kutu','".$avatar_user_shop_kutu_list[0]."')\">".$avatar_user_shop_kutu_list[1]."</a><input id=\"".$avatar_user_shop_kutu_list[0]."\" type=\"checkbox\" name=\"itemsKutu[]\" value=\"".$avatar_user_shop_kutu_list[0]."\" onclick=\"addCost(2,'".$avatar_user_shop_kutu_list[0]."')\"></dt>";
				}
	}
	?>
　　　</dl>
	</div>
	<h3>アクセサリー</h3>
	<div class="accordion-block">
	<dl>
	<?php
	//商品リストのレコード取り出し
	while($avatar_user_shop_akuse_list = $avatar_user_shop_akuse->fetch(PDO::FETCH_NUM)){
		if(array_search($avatar_user_shop_akuse_list[0], $belongings)){
			echo "<dt><a id=\"purchased\" href=\"javascript:void(0);\" onclick=\"change('akuse','".$avatar_user_shop_akuse_list[0]."')\">".$avatar_user_shop_akuse_list[1]."</a></dt>";
		}else{
					echo "<dt><a href=\"javascript:void(0);\" onclick=\"change('akuse','".$avatar_user_shop_akuse_list[0]."')\">".$avatar_user_shop_akuse_list[1]."</a><input id=\"".$avatar_user_shop_akuse_list[0]."\" type=\"checkbox\" name=\"itemsAkuse[]\" value=\"".$avatar_user_shop_akuse_list[0]."\" onclick=\"addCost(1,'".$avatar_user_shop_akuse_list[0]."')\"></dt>";
				}
	}
	?>
　　　</dl>
	</div>
	<h3>所持品</h3>
	<div class="accordion-block">
	<dl>
	<?php
	//商品リストのレコード取り出し
	while($avatar_user_shop_mochimono_list = $avatar_user_shop_mochimono->fetch(PDO::FETCH_NUM)){
		if(array_search($avatar_user_shop_mochimono_list[0], $belongings)){
			echo "<dt><a id=\"purchased\" href=\"javascript:void(0);\" onclick=\"change('mochimono','".$avatar_user_shop_mochimono_list[0]."')\">".$avatar_user_shop_mochimono_list[1]."</a></dt>";
		}else{
					echo "<dt><a href=\"javascript:void(0);\" onclick=\"change('mochimono','".$avatar_user_shop_mochimono_list[0]."')\">".$avatar_user_shop_mochimono_list[1]."</a><input id=\"".$avatar_user_shop_mochimono_list[0]."\" type=\"checkbox\" name=\"itemsMochimono[]\" value=\"".$avatar_user_shop_mochimono_list[0]."\" onclick=\"addCost(1,'".$avatar_user_shop_mochimono_list[0]."')\"></dt>";
				}
	}
	?>
　　　</dl>
	</div>
		<h3>背景</h3>
	<div class="accordion-block">
	<dl>
	<?php
	//商品リストのレコード取り出し
	while($avatar_user_shop_backimg_list = $avatar_user_shop_backimg->fetch(PDO::FETCH_NUM)){
		if(array_search($avatar_user_shop_backimg_list[0], $belongings)){
			echo "<dt><a id=\"purchased\" href=\"javascript:void(0);\" onclick=\"change('backimg','".$avatar_user_shop_backimg_list[0]."')\">".$avatar_user_shop_backimg_list[1]."</a></dt>";
		}else{
					echo "<dt><a href=\"javascript:void(0);\" onclick=\"change('backimg','".$avatar_user_shop_backimg_list[0]."')\">".$avatar_user_shop_backimg_list[1]."</a><input id=\"".$avatar_user_shop_backimg_list[0]."\" type=\"checkbox\" name=\"itemsBackimg[]\" value=\"".$avatar_user_shop_backimg_list[0]."\" onclick=\"addCost(1,'".$avatar_user_shop_backimg_list[0]."')\"></dt>";
				}
	}
	?>
　　　</dl>
	</div>
</div>
<br />
<div id="totalCost">
金貨合計：<input type="text" name="cost" id="totalCostForm" value="0" readonly>
<?php
    //残金額の取得
    $stmt = $pdo->prepare('SELECT sirudoru FROM db_user WHERE id = :id');
    $stmt->bindValue(':id', $user_id, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch();
    //残金額
    $money = $row['sirudoru'];

    echo "<br><br>使える金貨は".$money."枚です。<br>";
?>
</div>
<div id="buttonPurchase">
<input type="submit" name="button_purchase" value="購入する"/>
</form>
</div>
<br>
<a href="http://syldra.secret.jp/avatar/main.php">アバターメインページに戻る</a>
</body>
</html>