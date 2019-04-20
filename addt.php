<!DOCTYPE html>
<html>
<head>
	<title>Add</title>
	<link rel="stylesheet" type="text/css" href="gradient.css">
</head>
<body>

</body>
</html>


<?php
require_once("koneksi.php");
$pinjam			= date("d-m-Y");
$tiga_hari		= mktime(0,0,0,date("n"),date("j")+3,date("Y"));
$kembali		= date("d-m-Y", $tiga_hari);

$ssql = "SELECT id_peminjaman FROM detail_peminjaman ORDER BY id_peminjaman";
$sssql = "SELECT id_pustakawan FROM pustakawan ORDER BY id_pustakawan";
$ssssql = "SELECT nis FROM siswa ORDER BY nis";
$sssssql = "SELECT id_buku FROM buku ORDER BY id_buku";
if(isset($_POST['btn_insert']))
{
	try
	{

		$id_peminjaman = $_POST['id_peminjaman'];
		$id_pustakawan = $_POST['id_pustakawan'];
		$nis = $_POST['nis'];
		//$tgl_pinjam = $_POST['tgl_pinjam'];
		//$tgl_kembali = $_POST['tgl_kembali'];
		$id_buku = $_POST['id_buku'];
		if(!isset($errorMsg))
		{
			$sql = "INSERT INTO master_peminjaman(id_peminjaman,id_pustakawan,nis,tgl_pinjam) VALUES(:fip, :fidp, :fnis, :ftgl)";
			$insert_stmt=$db->prepare($sql);
			$insert_stmt->bindParam(':fip', $id_peminjaman);
			$insert_stmt->bindParam(':fidp', $id_pustakawan);
			$insert_stmt->bindParam(':fnis', $nis);
			$insert_stmt->bindParam(':ftgl', $pinjam); //bind all parameter
			$insert_stmt->execute();
			$sqll = "INSERT INTO detail_peminjaman(id_peminjaman,id_buku,tgl_kembali) VALUES(:fip, :fib, :ftgl)";
			$insert_stmt2=$db->prepare($sqll);
			$insert_stmt2->bindParam(':fip', $id_peminjaman);
			$insert_stmt2->bindParam(':fib', $id_buku);
			$insert_stmt2->bindParam(':ftgl', $kembali); //bind all parameter
			$insert_stmt2->execute();
			header('Location: pinjam.php');

			/*if($insert_stmt->execute())
			{
				echo "<scipt>alert('file upload succesfully')</script>";
				header("Location: pinjam.php");
			}
			else
			{
				echo "<script>alert('File upload failed')</script>";
			}
		}
		else
		{
			echo "<script>alert('".$errorMsg."')</script>";
		}*/
	}
}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
}
?>
<!DOCTYPE html>
<html>
<head><title>Add Transaksi</title></head>
<body>

<input type="hidden" name="tgl_pinjam" value="<?php echo $pinjam; ?>">
<input type="hidden" name="tgl_kembali" value="<?php echo $kembali; ?>">
	<div align="center">
		<form method="post" enctype="multipart/form-data" action="">
			<!-- Gunakan Multipart jika pada file terdapat file upload-->
			<fieldset style="width: 75px; border-color: #66CDAA; border-radius: 25px;">
				<legend style="color: #66CDAA; font-weight: bold; text-align: right; border: 1px solid yellow;">Tambah Peminjaman</legend>
				<table align="center">
					<tr>
						<td>Id Peminjaman</td>
						<td><input type="text" name="id_peminjaman"/></td>
					</tr>
					<tr>
						<td>Id Pustakawan</td>
						<td><select name="id_pustakawan">
							<?php

							$stmt = $db->prepare($sssql);
							$stmt->execute();
							while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
								extract($row); ?>
								<option value="<?php echo $id_pustakawan ?>"><?php echo $id_pustakawan ?></option><?php
							}

							?>
						</select>
						</td>
					</tr>
					<tr>
						<td>Nis</td>
						<td><select name="nis">
							<?php

							$stmt = $db->prepare($ssssql);
							$stmt->execute();
							while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
								extract($row); ?>
								<option value="<?php echo $nis ?>"><?php echo $nis ?></option><?php
							}

							?>
						</select>
						</td>
					</tr>

					<tr>
						<td>Tanggal Pinjam</td>
						<td><b><?php echo $pinjam; ?></b></td>
					</tr>
					<tr>
						<td>Tanggal Kembali</td>
						<td><b><?php echo $kembali; ?></b></td>
					</tr>
					<tr>
						<td>Id Buku</td>
						<td><select name="id_buku">
							<?php

							$stmt = $db->prepare($sssssql);
							$stmt->execute();
							while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
								extract($row); ?>
								<option value="<?php echo $id_buku ?>"><?php echo $id_buku ?></option><?php
							}

							$numbers = substr($row['id_peminjaman'], 1);
							$angka=intval($numbers);
							$angka++;

							?>
						</select>
						</td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="btn_insert" value="Insert"></td>
					</tr>
				</table>
			</fieldset>
		</form>
	</div>
</body>
</html>