<?php
require_once 'PEAR/Config.php';  
require_once 'PEAR/Registry.php';  
  
$config = new PEAR_Config();  
$reg = new PEAR_Registry($config->get('php_dir'));  
$packages = $reg->listPackages();  
  
foreach($packages as $value)  
{  
    echo $value."<br>";  
}  
?>