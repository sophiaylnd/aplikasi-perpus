<?php
require_once("koneksi.php");
if(isset($_GET['edit_id']))
{
	try
	{
		$id=$_GET['edit_id'];
		$sql="SELECT * FROM penerbit WHERE id_penerbit=:fid";
		$select_stmt=$db->prepare($sql);
		$select_stmt->bindParam(':fid', $id);
		$select_stmt->execute();
		$row = $select_stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
}
?>
<!DOCTYPE html>
<html>
<head><title>File Update</title></head>
<link rel="stylesheet" type="text/css" href="gradient.css">
<body>
<div align="center">
	<form method="post" enctype="multipart/form-data" action="">
		<fieldset style="width:100px; border-color: #66CDAA; border-radius: 25px;">
			<legend style="color: #66CDAA; font-weight:bold; text-align: right; border: 1px solid yellow;">Edit Buku</legend>
				<table align="center" width="90">
					<tr>
						<td width="50">Id Penerbit</td>
						<td><input type="text" name="id_penerbit" value="<?php echo $row['id_penerbit']; ?>" /></td>
					</tr>
					<tr>
						<td width="50">Nama</td>
						<td><input type="text" name="nama" value="<?php echo $row['nama']; ?>" /></td>
					</tr>
					<tr>
						<td width="50">Kota</td>
						<td><input type="text" name="kota" value="<?php echo $row['kota']; ?>" /></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="btn_edit" value="Update"></td>
					</tr>
				</table>
			</fieldset>
		</form>
	</div>
</body>
</html>

<?php
if(isset($_POST['btn_edit']))
{
	try
	{
		$id_penerbit = $_POST['id_penerbit'];
		$name = $_POST['nama'];
		$kota = $_POST['kota'];
		if(!isset($errorMsg))
		{
			$update_stmt=$db->prepare('UPDATE penerbit SET id_penerbit=:ip_up, nama=:nama_up,  kota=:kota_up WHERE id_penerbit=:ip_up');
			$update_stmt->bindParam(':ip_up', $id_penerbit);
			$update_stmt->bindParam(':nama_up', $name);
			$update_stmt->bindParam(':kota_up', $kota);


			if($update_stmt->execute())
			{
				echo "<scipt>alert('file Update succesfully');</script>";
				header("Location:penerbit.php");
			}
			else
			{
				echo "<script>alert('File Update failed');</script>";
			}
		}
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
}
?>