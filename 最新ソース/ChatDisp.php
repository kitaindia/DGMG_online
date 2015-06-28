<?php

session_start();

if($_SESSION['guildmember']==0)
{
header("Location: ../index.php");
exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>シルドラチャット</title>
<link rel="stylesheet" type="text/css" href="css/html5reset.css"  />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<style type="text/css">
#commForm {
	width:310px;
	border: 1px solid #848484; 
    -webkit-border-radius: 30px; 
    -moz-border-radius: 30px; 
    border-radius: 30px; 
    outline:0;  
    padding-left:10px; 
    padding-right:10px; 
    border:0px;
}
#serihutxt{
  font-size:8px;
  font-family: "メイリオ", sans-serif;
}
</style>
<script type="text/javascript">
<!--
function changeCommentForm(X){
	var chatCommentForm = document.getElementById('chatCommentForm');
	if(X==1){
	chatCommentForm.src = "image/chatCommentFormCursor.png";
}else{
	chatCommentForm.src = "image/chatCommentForm.png";
}
}
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-55630755-1', 'auto');
  ga('send', 'pageview');
</script>
</head>
<body>
<div id="header">
<?php include( $_SERVER['DOCUMENT_ROOT'] . '/dropDownMenu.php'); ?>
</div>
<center>
<div style="background-image:url('image/chatFrame.png');width:700px;height:700px;position:relative;">
<img id="chatHukidashi" src="image/chatHukidashi.png" style="position:absolute;top:20px;left:120px;width:300px;height:80px;z-index:1;">
<div id="serihu" style="position:absolute; z-index:2; top:40px; left:200px;"><text id="serihutxt">ようこそ、<?php echo $_SESSION['name'];?>さん。</text></div>
<img id="chatCommentForm" src="image/chatCommentForm.png" style="position:absolute;top:80px;left:85px;width:400px;height:80px;">
<form name="form" action="ChatSys.php" method="post" target="ChatSys">
<input type="image" src="image/chatWriteDown.png" style="position:absolute;top:120px;left:485px;width:100px;height:50px; border:0px; ">
<div style="position:absolute;top:130px;left:145px;" onmouseover="changeCommentForm(1)" onmouseout="changeCommentForm(0)"><input type="text" name="comment" id="commForm"></div>
<input type="hidden" name="name" value="<?php echo $_SESSION['name'];?>">
</form>
<iframe src="ChatSys.php" frameborder="0" style="position:absolute;top:175px;left:175px;width:350px;height:350px;" name="ChatSys"></iframe>
</div>
</center>
</body>
</html>

