<?php
 include_once("koneksi.php");

 if (isset($_GET['delete_id']))
 {
 	$id = $_GET['delete_id'];
 	$sql = "SELECT * FROM buku WHERE id_buku=:id";
 	$select_stmt=$db->prepare($sql);
 	$select_stmt->bindParam(':id' ,$id);
 	$select_stmt->execute();
 	$row = $select_stmt->fetch(PDO::FETCH_ASSOC);
 	unlink("upload/".$row['photo']);

 	$sql="DELETE FROM buku WHERE id_buku=:id";
 	$delete_stmt=$db->prepare($sql);
 	$delete_stmt->bindParam(':id',$id);
 	$delete_stmt->execute();

 	header("Location: pustakawan.php");
 }
 ?>