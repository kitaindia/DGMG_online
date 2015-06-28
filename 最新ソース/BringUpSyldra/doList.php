<?php
$do = $_POST["do"];
if($do == "adventure"){
	header("Location: adventure.php");
}
if($do == "kotoba"){
	header("Location: kotoba.php");
}
if($do == "question"){
	header("Location: question.php");
}
?>