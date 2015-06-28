<?php 
session_start();

if(!isset($_SESSION["id"]))
{
$_SESSION['page'] = "chat";
header("Location: limited.php");
exit;
}
header("Location: ChatDisp.php");
?>