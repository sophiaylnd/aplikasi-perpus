<?php
 include_once("koneksi.php");

 if (isset($_GET['delete_id']))
 {
 	$id = $_GET['delete_id'];
 	$sql = "SELECT * FROM siswa WHERE nis=:fnis";
 	$select_stmt=$db->prepare($sql);
 	$select_stmt->bindParam(':fnis' ,$id);
 	$select_stmt->execute();
 	$row = $select_stmt->fetch(PDO::FETCH_ASSOC);
 	unlink("upload/".$row['photo']);

 	$sql="DELETE FROM siswa WHERE nis=:fnis";
 	$delete_stmt=$db->prepare($sql);
 	$delete_stmt->bindParam(':fnis',$id);
 	$delete_stmt->execute();

 	header("Location: siswa.php");
 }
 ?>