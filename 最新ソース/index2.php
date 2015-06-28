
<!DOCTYPE html>
<meta charset="UTF-8">
<title>アバター/メイン</title>
<html lang="ja">
  <head>
    <title>droppy - パネル開閉</title>
    <meta name="description" content="マウスオーバーによるパネル開閉への応用" />
    <meta name="keywords" content="javascript,jQuery,dropdown menu" />
	  <script type='text/javascript' src='/js/jquery.js'></script>
    
    <!-- per Project stuff -->
      <script type='text/javascript' src='js/dropDown.js'></script>
      <link rel="stylesheet" href="css/dropDown.css" type="text/css" />
    <!-- END per project stuff -->
  
  </head>
  <body>

<h2 id='example'>シルドラMember'sWebSite</h2>

<ul id='nav'>
  <li><a>Top level 1</a>
    <ul>
      <li><a href='/avatar/main.php'>Sub 1 - 1</a></li>
      <li>
        <a href='#'>Sub 1 - 2 &raquo;</a>
        <ul>
          <li>
            <a href='#'>Sub 1 - 2 - 1 &raquo;</a>
            <ul>
              <li><a href='#'>Sub 1 - 2 - 1 - 1</a></li>
              <li><a href='#'>Sub 1 - 2 - 1 - 2</a></li>
              <li><a href='#'>Sub 1 - 2 - 1 - 3</a></li>
              <li><a href='#'>Sub 1 - 2 - 1 - 4</a></li>
            </ul>
          </li>
          <li><a href='#'>Sub 1 - 2 - 2</a></li>
          <li>
            <a href='#'>Sub 1 - 2 - 3 &raquo;</a>
            <ul>
              <li><a href='#'>Sub 1 - 2 - 3 - 1</a></li>
              <li><a href='#'>Sub 1 - 2 - 3 - 2</a></li>
              <li><a href='#'>Sub 1 - 2 - 3 - 3</a></li>
              <li><a href='#'>Sub 1 - 2 - 3 - 4</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li><a href='#'>Sub 1 - 3</a></li>
    </ul>
  </li>
  <li><a href='#'>Top level 2 &raquo;</a>
    <ul>
      <li><a href='#'>Sub 2 - 1</a></li>
      <li>
        <a href='#'>Sub 2 - 2 &raquo;</a>
        <ul>
          <li>
            <a href='#'>Sub 2 - 2 - 1 &raquo;</a>
            <ul>
              <li><a href='#'>Sub 2 - 2 - 1 - 1</a></li>
              <li><a href='#'>Sub 2 - 2 - 1 - 2</a></li>
              <li><a href='#'>Sub 2 - 2 - 1 - 3</a></li>
              <li><a href='#'>Sub 2 - 2 - 1 - 4</a></li>
            </ul>
          </li>
          <li><a href='#'>Sub 2 - 2 - 2</a></li>
          <li>
            <a href='#'>Sub 2 - 2 - 3 &raquo;</a>
            <ul>
              <li><a href='#'>Sub 2 - 2 - 3 - 1</a></li>
              <li><a href='#'>Sub 2 - 2 - 3 - 2</a></li>
              <li><a href='#'>Sub 2 - 2 - 3 - 3</a></li>
              <li><a href='#'>Sub 2 - 2 - 3 - 4</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li><a href='#'>Sub 2 - 3</a></li>
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