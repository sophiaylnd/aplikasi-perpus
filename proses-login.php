<?php
session_start();
include_once "koneksi.php";
$username =$_POST['username'];
$password =$_POST['password'];

$query ="SELECT * FROM pustakawan WHERE username='$username' AND password='$password'";
$result = $db->prepare("SELECT COUNT(*) FROM pustakawan WHERE username='$username' AND password='$password'");
$result->execute();
$num_rows = $result->fetchColumn();

$st = $db->prepare($query);
$st->execute();

if($num_rows==1)
{

	header('Location: siswa.php');

}
else
{
	header('Location: loginpustakawan.php');
}
?>