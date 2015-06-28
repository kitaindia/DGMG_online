<?
ini_set("display_errors","on");
if(!isset($dbh)){
 session_start();
 date_default_timezone_set("UTC"); // Set Time Zone
 $host = "mysql010.phy.lolipop.lan"; // Hostname
 $port = "3306"; // MySQL Port : Default : 3306
 $user = "LAA0535115"; // Username Here
 $pass = "パスワード"; //Password Here
 $db   = "LAA0535115-dbname"; // Database Name
 $dbh  = new PDO('mysql:dbname='.$db.';host='.$host.';port='.$port,$user,$pass);
 
 /*Change The Credentials to connect to database.*/
 include("user_online.php");
}
?>