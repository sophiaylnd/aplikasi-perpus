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
include_once "koneksi.php";

if(isset($_POST['btn_insert']))
{
	try
	{
		$id_penerbit = $_POST['id_penerbit'];
		$name = $_POST['nama'];
		$kota = $_POST['kota'];

		if(empty($name))
		{
			$errorMsg = "Please enter name";
		}
		if(!isset($errorMsg))
		{
			$sql = "INSERT INTO penerbit(id_penerbit ,nama ,kota) VALUES(:fid, :fnama, :fkota)";
			$insert_stmt=$db->prepare($sql);
			$insert_stmt->bindParam(':fid', $id_penerbit);
			$insert_stmt->bindParam(':fnama', $name);
			$insert_stmt->bindParam(':fkota', $kota);
			if($insert_stmt->execute())
			{
				echo "<scipt>alert('file upload succesfully')</script>";
				header("Location: penerbit.php");
			}
			else
			{
				echo "<script>alert('File upload failed')</script>";
			}
		}
		else
		{
			echo "<script>alert('".$errorMsg."')</script>";
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
<head><title>Add File Image</title></head>
<body>
	<div align="center">
		<form method="post" enctype="multipart/form-data" action="">
			<!-- Gunakan Multipart jika pada file terdapat file upload-->
			<fieldset style="width: 75px; border-color: #66CDAA; border-radius: 25px;">
				<legend style="color: #66CDAA; font-weight: bold; text-align: right; border: 1px solid yellow;">Add New Data</legend>
				<table align="center">
					<tr>
						<td align="center">Id Penerbit</td>
						<td><input type="text" name="id_penerbit"/></td>
					</tr>
					<tr>
						<td align="center">Nama</td>
						<td><input type="text" name="nama"/></td>
					</tr>
					<tr>
						<td align="center">Kota</td>
						<td><input type="text" name="kota"/></td>
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