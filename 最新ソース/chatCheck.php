<?php 
session_start();

if (!isset($_SESSION["id"])) {
  header("Location: logout.php");
  exit;
}
 header("Location: mbc/mbc.cgi");
?>