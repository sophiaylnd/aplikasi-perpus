<?php

$db_host="127.0.0.1";
$db_user="root";
$db_password="";
$db_name="aplikasi_perpus";
try
{
	$db=new PDO("mysql:host=$db_host;dbname=$db_name",$db_user,$db_password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo $e->getMessage();
}
?>