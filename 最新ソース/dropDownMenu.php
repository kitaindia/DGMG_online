
<!DOCTYPE html>
<meta charset="UTF-8">
<title>メニュー</title>
<html lang="ja">
  <head>
    <meta name="description" content="メニュー" />
    <meta name="keywords" content="javascript,jQuery,dropdown menu" />
	  <script type='text/javascript' src='/js/jquery.js'></script>
    
    <!-- per Project stuff -->
      <script type='text/javascript' src='http://syldra.secret.jp/js/dropDown.js'></script>
      <link rel="stylesheet" href="http://syldra.secret.jp/css/dropDown.css" type="text/css" />
    <!-- END per project stuff -->
  
  </head>
  <body>
<ul id='nav'>
  <li><a href='/index.php'>トップ</a></li>
  <li><a href='/confirm.php'>アカウント登録</a></li>
  <li><a href='#'>ゲーム　&raquo;</a>
    <ul>
      <li><a href='/avatar/main.php'>アバター</a></li>
      <li><a href='/avatar/shop.php'>ショップ</a></li>
      <li><a href='/turngame/confirm.php'>めくってシルドラくん(試験運用中)</a></li>
      <li><a href='/exchange/main.php'>換金所</a></li>
      <li><a href='http://www62.atwiki.jp/avatargame/'>Wiki</a></li>
    </ul>
  </li>
  <li><a href='#'>ギルド　&raquo;</a>
    <ul>
      <li><a href='/about.php'>シルドラについて</a></li>
      <li><a href='/main.php'>ギルドルール</a></li>
      <li><a href='/memberlist.php'>メンバー紹介</a></li>
      <li><a href='/sample.php'>ギルマスギャラリー</a></li>
    </ul>
  </li>
  <li><a href='#'>メンバー専用ページ　&raquo;</a>
    <ul>
      <li><a href='/bbs.php'>けいじばん</a></li>
      <li><a href='/ChatDisp.php'>チャット</a></li>
      <li><a href='#'>ギャラリー　&raquo;</a>
        <ul>
        <li><a href='/PhotoContest/imgView.php'>共有ギャラリー</a></li>
        </ul>
      </li>
    </ul>
  </li>
</ul>

<script type='text/javascript'>
  $(function() {
    $('#nav').droppy();
  });
</script>

  </body>
</html>