<?php
 include_once("koneksi.php");

 if (isset($_GET['delete_id']))
 {
 	$id = $_GET['delete_id'];
 	$sql = "SELECT * FROM master_peminjaman WHERE id_peminjaman=:fid";
 	$select_stmt=$db->prepare($sql);
 	$select_stmt->bindParam(':fid' ,$id);
 	$select_stmt->execute();
 	$sqll = "SELECT * FROM detail_peminjaman WHERE id_buku=:fib";
 	$select_stmt=$db->prepare($sqll);
 	$select_stmt->bindParam(':fib' ,$id);
 	$select_stmt->execute();
 	$row = $select_stmt->fetch(PDO::FETCH_ASSOC);

 	$sql="DELETE FROM penerbit WHERE id_penerbit=:fid";
 	$delete_stmt=$db->prepare($sql);
 	$delete_stmt->bindParam(':fid',$id);
 	$delete_stmt->execute();

 	header("Location: penerbit.php");
 }
 ?>