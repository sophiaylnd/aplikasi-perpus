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
$ssql = "SELECT id_penerbit FROM penerbit ORDER BY id_penerbit";
$sssql = "SELECT id_buku FROM detail_peminjaman ORDER BY id_buku";

if(isset($_POST['btn_insert']))
{
	try
	{
		//textbox name txt_name
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

		if(empty($name))
		{
			$errorMsg = "Please enter name";
		}
		else if(empty($image_file))
		{
			$errorMsg = "Please Select Image";
		}
		else if($type=="image/jpg" || $type=='image/jpeg' || $type=='image/png' || $type=='image/gif')
		{
			if(!file_exists($path)) //cek file not exist in your upload folder
			{
				if($size < 5000000) //cek file size 5mb
				{
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
		if(!isset($errorMsg))
		{
			$sql = "INSERT INTO buku(id_penerbit,id_buku,penulis,judul,harga,qty,photo) VALUES(:fidp, :fidb, :fpenulis, :fjudul, :fharga, :fqty, :fimage)";
			$insert_stmt=$db->prepare($sql);
			$insert_stmt->bindParam(':fidp', $Id_penerbit);
			$insert_stmt->bindParam(':fidb', $id_buku);
			$insert_stmt->bindParam(':fpenulis', $name);
			$insert_stmt->bindParam(':fjudul', $judul);
			$insert_stmt->bindParam(':fharga', $harga);
			$insert_stmt->bindParam(':fqty', $qty);
			$insert_stmt->bindParam(':fimage', $image_file); //bind all parameter

			if($insert_stmt->execute())
			{
				echo "<scipt>alert('file upload succesfully')</script>";
				header("Location: pustakawan.php");
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
				<legend style="color: #66CDAA; font-weight: bold; text-align: right; border: 1px solid yellow;">Insert file image</legend>
				<table align="center">
					<tr>
						<td>id Penerbit</td>
						<td><select name="Id_penerbit">
							<?php

							$stmt = $db->prepare($ssql);
							$stmt->execute();
							while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
								extract($row); ?>
								<option value="<?php echo $id_penerbit ?>"><?php echo $id_penerbit ?></option><?php
							}

							?>
						</select>
						</td>
					</tr>
					<tr>
						<td>Id Buku</td>
						<td><input type="text" name="Id_buku"/></td>
					</tr>
					<tr>
						<td>Penulis</td>
						<td><input type="text" name="Penulis"/></td>
					</tr>
					<tr>
						<td>Judul</td>
						<td><input type="text" name="Judul"/></td>
					</tr>
					<tr>
						<td>Harga</td>
						<td><input type="text" name="Harga"/></td>
					</tr>
					<tr>
						<td>Qty</td>
						<td><input type="text" name="qty"/></td>
					</tr>
					<tr>
						<td>Photo</td>
						<td><input type="file" name="Photo"/></td>
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