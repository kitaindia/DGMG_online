<?php 
session_start();

if(!isset($_SESSION["id"]))
{
$_SESSION['page'] = "members";
header("Location: limited.php");
exit;
}
header("Location: contact.php");
?>