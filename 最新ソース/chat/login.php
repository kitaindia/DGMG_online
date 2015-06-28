<?
if(isset($_POST['name']) && !isset($display_case)){
 $name=htmlspecialchars($_POST['name']);
 $sql=$dbh->prepare("SELECT name FROM chatters WHERE name=?");
 $sql->execute(array($name));
 if($sql->rowCount()!=0){
  $ermsg="<h2 class='error'>そのなまえは既に使用されています。<br><a href='index.php'>別のなまえを使う。</a></h2>";
 }else{
  $sql=$dbh->prepare("INSERT INTO chatters (name,seen) VALUES (?,NOW())");
  $sql->execute(array($name));
  $_SESSION['user']=$name;
 }
}elseif(isset($display_case)){
 if(!isset($ermsg)){
?>
 チャットをはじめるには、なまえを入力する必要があります。<br/>なまえは他のユーザーにも表示されます。<br/><br/>
 <form action="index.php" method="POST">
  <div>なまえ : <input name="name" placeholder="なまえを入力してね。"/></div><br/>
  <button>チャットをはじめる</button>
 </form>
<?
 }else{
  echo $ermsg;
 }
}
?>
