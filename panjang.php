<?php
$id_transaksi	= isset($_GET['id_peminjaman']) ? $_GET['id_peminjaman'] : "";
$judul			= isset($_GET['judul']) ? $_GET['judul'] : "";
$tgl_kembali	= isset($_GET['kembali']) ? $_GET['kembali'] : "";
$lambat			= isset($_GET['lambat']) ? $_GET['lambat'] : "";

if (isset($_GET['delete_id']))
{

if($lambat > 3) {
	echo "<script>alert('Buku yang dipinjam tidak dapat diperpanjang, karena sudah terlambat lebih dari 3 hari. Kembalikan dahulu, kemudian pinjam kembali !');</script>";
	header('Location: pinjam.php');
} else {
	include_once "koneksi.php";

	$pecah			= explode("-",$tgl_kembali);
	$next_3_hari	= mktime(0,0,0,$pecah[1],$pecah[0]+3,$pecah[2]);
	$hari_next		= date("d-m-Y", $next_3_hari);


	$sql= "UPDATE master_peminjaman SET tgl_kembali='$hari_next' WHERE id_peminjaman='$id_peminjaman'";

	if ($sql) {
		echo "<script>alert('Berhasil diperpanjang....');</script>";
		header('Location: pinjam.php');
	} else {
		echo "<script>alert('Gagal diperpanjang');</script>";
		header('Location: pinjam.php');
	}
}
}
?>