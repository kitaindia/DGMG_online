<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>サイトのタイトル</title>
<link rel="stylesheet" type="text/css" href="css/html5reset.css"  />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<style type="text/css">
.tile{
	width:50px;
	height:50px;
	background-color: #b0c4de;
	float:left;
}
.tileFront{
	width:0px;
	height:0px;
	clear:both;
}
</style>
<script type='text/javascript' src='C:\website\SOURCE\js\jquery-1.3.2.min.js'></script>
<script type="text/javascript">
<!--
function tileClick(tileId){
$(function(){
        $('#'+tileId).css('background-color', '#ddc8b3');
});
}
// -->
</script>
</head>
<body>
<div class="tileFront"></div>
<div id="tile1" class="tile" onclick="tileClick('tile1')"><?php echo rand(1, 5); ?></div>
<div id="tile2" class="tile" onclick="tileClick('tile2')"><?php echo rand(1, 5); ?></div>
<div id="tile3" class="tile" onclick="tileClick('tile3')">3</div>
<div id="tile4" class="tile" onclick="tileClick('tile4')">4</div>
<div id="tile5" class="tile" onclick="tileClick('tile5')">5</div>
<div class="tileFront"></div>
<div id="tile6" class="tile" onclick="tileClick('tile6')">6</div>
<div id="tile7" class="tile" onclick="tileClick('tile7')">7</div>
<div id="tile8" class="tile" onclick="tileClick('tile8')">8</div>
<div id="tile9" class="tile" onclick="tileClick('tile9')">9</div>
<div id="tile10" class="tile" onclick="tileClick('tile10')">10</div>
<div class="tileFront"></div>
<div id="tile11" class="tile" onclick="tileClick('tile11')">11</div>
<div id="tile12" class="tile" onclick="tileClick('tile12')">12</div>
<div id="tile13" class="tile" onclick="tileClick('tile13')">13</div>
<div id="tile14" class="tile" onclick="tileClick('tile14')">14</div>
<div id="tile15" class="tile" onclick="tileClick('tile15')">15</div>
<div class="tileFront"></div>
<div id="tile16" class="tile" onclick="tileClick('tile16')">16</div>
<div id="tile17" class="tile" onclick="tileClick('tile17')">17</div>
<div id="tile18" class="tile" onclick="tileClick('tile18')">18</div>
<div id="tile19" class="tile" onclick="tileClick('tile19')">19</div>
<div id="tile20" class="tile" onclick="tileClick('tile20')">20</div>
<div class="tileFront"></div>
<div id="tile21" class="tile" onclick="tileClick('tile21')">21</div>
<div id="tile22" class="tile" onclick="tileClick('tile22')">22</div>
<div id="tile23" class="tile" onclick="tileClick('tile23')">23</div>
<div id="tile24" class="tile" onclick="tileClick('tile24')">24</div>
<div id="tile25" class="tile" onclick="tileClick('tile25')">25</div>
</body>
</html>