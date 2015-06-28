<?php 
session_start();
if(!isset($_SESSION["id"])) 
{
$_SESSION['page'] = "bbs";
header("Location: limited.php");
exit;
}
header("Location: bbs.php");
?>