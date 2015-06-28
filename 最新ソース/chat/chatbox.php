<?
include("config.php");
if(isset($_SESSION['user'])){
?>
 <h2>チャットログ</h2>
 <a style="right: 20px;top: 20px;position: absolute;cursor: pointer;" href="logout.php">ログアウト</a>
 <div class='msgs'>
  <?include("msgs.php");?>
 </div>
 <form id="msg_form">
  <input name="msg" size="30" type="text"/>
  <button>送信</button>
 </form>
<?
}
?>