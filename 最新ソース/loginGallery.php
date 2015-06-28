<?php 
session_start();
if(!isset($_SESSION["id"]))
{
$_SESSION['page'] = "gallery";
header("Location: limited.php");
exit;
}
header("Location: sample.php");
?>