<?php
 include_once("koneksi.php");

 if (isset($_GET['edit_id']))
 {
 	$id = $_GET['edit_id'];
 	$sql = "SELECT * FROM master_peminjaman WHERE id_peminjaman=:fid";
 	$select_stmt=$db->prepare($sql);
 	$select_stmt->bindParam(':fid' ,$id);
 	$select_stmt->execute();
 	$sqll = "SELECT * FROM detail_peminjaman WHERE id_buku=:fib";
 	$select_stmt=$db->prepare($sqll);
 	$select_stmt->bindParam(':fib' ,$id);
 	$select_stmt->execute();
 	$row = $select_stmt->fetch(PDO::FETCH_ASSOC);

 	$sql2="DELETE FROM master_peminjaman WHERE id_peminjaman=:fid";
 	$delete_stmt=$db->prepare($sql2);
 	$delete_stmt->bindParam(':fid',$id);
 	$delete_stmt->execute();
 	$sqll2="DELETE FROM detail_peminjaman WHERE id_buku=:fib";
 	$delete_stmt=$db->prepare($sqll2);
 	$delete_stmt->bindParam(':fib',$id);
 	$delete_stmt->execute();

 	echo "<scipt>alert('Berhasil dikembalikan')</script>";

 	header("Location: pinjam.php");
 }
 ?>