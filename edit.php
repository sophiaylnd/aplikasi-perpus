<?php
require_once("koneksi.php");

if(isset($_GET['edit_id']))
{
	try
	{
		$id=$_GET['edit_id'];
		$sql="SELECT * FROM buku WHERE id_buku =:id";
		$select_stmt=$db->prepare($sql);
		$select_stmt->bindParam(':id', $id);
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
						<td width="50">Id Buku</td>
						<td><input type="text" name="Id_buku" value="<?php echo $row['id_buku']; ?>" /></td>
					</tr>
					<tr>
						<td width="50">Penulis</td>
						<td><input type="text" name="Penulis" value="<?php echo $row['penulis']; ?>" /></td>
					</tr>
					<tr>
						<td width="50">Judul</td>
						<td><input type="text" name="Judul" value="<?php echo $row['judul']; ?>" /></td>
					</tr>
					<tr>
						<td width="50">Harga</td>
						<td><input type="text" name="Harga" value="<?php echo $row['harga']; ?>" /></td>
					</tr>
					<tr>
						<td width="60">  QTY </td>
						<td><input type="text" name="qty" value="<?php echo $row['qty']; ?>" /></td>
					</tr>
					<tr>
						<td>Photo</td>
						<td><input type="file" name="Photo"  value="<?php echo $row['photo']; ?>"/></td>
					</tr>
					<tr>
						<td></td>
						<td><img src="upload/<?php echo $row['photo']; ?>" height="100" width="100"/></td>
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
		$image_file = $_FILES["Photo"]["name"];
		$type = $_FILES["Photo"]["type"];
		$size = $_FILES["Photo"]["size"];
		$temp = $_FILES["Photo"]["tmp_name"];
		$id_buku = $_POST['Id_buku'];
		$name = $_POST['Penulis'];
		$judul = $_POST['Judul'];
		$harga = $_POST['Harga'];
		$qty = $_POST['qty'];
		$Id_penerbit = $_POST['Id_penerbit'];

		$path="upload/".$image_file; //set upload folder path

		$directory="upload/";

		if($image_file)
		if($type=="image/jpg" || $type=='image/jpeg' || $type=='image/png' || $type=='image/gif')
		{
			if(!file_exists($path)) //cek file not exist in your upload folder
			{
				if($size < 5000000) //cek file size 5mb
				{
					unlink($directory.$row['photo']);
					//moved upload file directory to your upload folder
					move_uploaded_file($temp, "upload/".$image_file);
				}
				else
				{
					//error message file size not large
					$errorMsg="Your file to large please upload 5mb size";
				}
			}
			else
			{
				//error message file not exist your upload folder path
				$errorMsg="File already exists check upload folder";
			}
		}
		else
		{
			//error message file extension
			$errorMsg="Upload JPG, JPEG, PNG, GIF File formate check file extension";
		}
		else
		{
			//if you not select new image then use previous image
			$image_file=$row['photo'];
		}
		if(!isset($errorMsg))
		{
			$update_stmt=$db->prepare('UPDATE buku SET id_penerbit=:ip_up, penulis=:penulis_up,  judul=:judul_up,  harga=:harga_up, qty=:qty_up, photo=:file_up WHERE id_buku=:ib_up');
			$update_stmt->bindParam(':ip_up', $id_penerbit);
			$update_stmt->bindParam(':harga_up', $harga);
			$update_stmt->bindParam(':penulis_up', $penulis);
			$update_stmt->bindParam(':judul_up', $judul);
			$update_stmt->bindParam(':file_up', $image_file);
			$update_stmt->bindParam(':ib_up', $id);
			$update_stmt->bindParam(':qty_up', $qty);


			if($update_stmt->execute())
			{
				echo "<scipt>alert('file Update succesfully');</script>";
				header("Location:pustakawan.php");
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