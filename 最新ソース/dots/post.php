<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title></title>
<style type="text/css">
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript">
$(function() {
  $('input[type=file]').after('<span></span>');
  // アップロードするファイルを選択
  $('input[type=file]').change(function() {
    var file = $(this).prop('files')[0];

    // 画像以外は処理を停止
    if (! file.type.match('image.*')) {
      $('span').html('');
      return;
    }
    
    // 画像表示
    var reader = new FileReader();
    reader.onload = function() {
      var img_src = $('<img>').attr('src', reader.result);
      $('span').html(img_src);
    }
    reader.readAsDataURL(file);
  });
});
</script>
</head>
<body>
<form enctype="multipart/form-data" action="./posting.php" method="POST">
画像：<input type="file" name="image"/><br>
題目:<input type="text" name="SUBJECT_TITLE"><br>
<input type="submit" name="save" value="投稿する">
</form>
<br>
<form action="./view.php" method="GET">
ID:<input type="text" name="SUBJECT_ID"><br>
<input type="submit" value="閲覧する">
</body>
</html>