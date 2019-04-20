<?php
require_once("koneksi.php");

if(isset($_GET['edit_id']))
{
	try
	{
		$id=$_GET['edit_id'];
		$sql="SELECT * FROM siswa WHERE nis =:fnis";
		$select_stmt=$db->prepare($sql);
		$select_stmt->bindParam(':fnis', $id);
		$select_stmt->execute();
		$row = $select_stmt->fetch(PDO::FETCH_ASSOC);
		$kls=$row['kelas'];
		$jrsn=$row['jurusan'];
		$tkt=$row['tingkat'];
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
						<td width="50">Nis</td>
						<td><input type="text" name="nis" value="<?php echo $row['nis']; ?>" /></td>
					</tr>
					<tr>
						<td width="50">Nama</td>
						<td><input type="text" name="nama" value="<?php echo $row['nama']; ?>" /></td>
					</tr>
					<tr>
						<td>Tingkat</td>
						<td>
							<select name="tingkat">
								<option value="X" <?php echo ($tkt=='X')?'selected':'' ?> >X</option>
								<option value="XI" <?php echo ($tkt=='XI')?'selected':'' ?> >XI</option>
								<option value="XII" <?php echo ($tkt=='XII')?'selected':'' ?> >XII</option>
								<option value="XIII" <?php echo ($tkt=='XIII')?'selected':'' ?> >XIII</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Jurusan</td>
						<td>
							<select name="jurusan">
								<option value="RPL" <?php echo ($jrsn=='RPL')?'selected':'' ?> >RPL</option>
								<option value="PFPT" <?php echo ($jrsn=='PFPT')?'selected':'' ?> >PFPT</option>
								<option value="IOP" <?php echo ($jrsn=='IOP')?'selected':'' ?> >IOP</option>
								<option value="TOI" <?php echo ($jrsn=='TOI')?'selected':'' ?> >TOI</option>
								<option value="EIND" <?php echo ($jrsn=='EIND')?'selected':'' ?> >EIND</option>
								<option value="TPTU" <?php echo ($jrsn=='TPTU')?'selected':'' ?> >TPTU</option>
								<option value="TEDK" <?php echo ($jrsn=='TEDK')?'selected':'' ?> >TEDK</option>
								<option value="SIJA" <?php echo ($jrsn=='SIJA')?'selected':'' ?> >SIJA</option>
								<option value="MEKA" <?php echo ($jrsn=='MEKA')?'selected':'' ?> >MEKA</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Kelas</td>
						<td>
							<select name="kelas">
								<option value="A" <?php echo ($kls=='A')?'selected':'' ?> >A</option>
								<option value="B" <?php echo ($kls=='B')?'selected':'' ?> >B</option>
								<option value="C" <?php echo ($kls=='C')?'selected':'' ?> >C</option>
								<option value="D" <?php echo ($kls=='D')?'selected':'' ?> >D</option>
							</select>
						</td>
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
		//textbox name txt_name
		$image_file = $_FILES["Photo"]["name"];
		$type = $_FILES["Photo"]["type"];
		$size = $_FILES["Photo"]["size"];
		$temp = $_FILES["Photo"]["tmp_name"];
		$nis = $_POST['nis'];
		$name = $_POST['nama'];
		$tingkat = $_POST['tingkat'];
		$jurusan = $_POST['jurusan'];
		$kelas = $_POST['kelas'];

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
			$update_stmt=$db->prepare('UPDATE siswa SET nama=:nama_up,  tingkat=:tingkat_up,  jurusan=:jurusan_up, kelas=:kelas_up, photo=:file_up WHERE nis=:fnis_up');
			$update_stmt->bindParam(':nama_up', $name);
			$update_stmt->bindParam(':tingkat_up', $tingkat);
			$update_stmt->bindParam(':jurusan_up', $jurusan);
			$update_stmt->bindParam(':file_up', $image_file);
			$update_stmt->bindParam(':kelas_up', $kelas);
			$update_stmt->bindParam(':fnis_up', $nis);


			if($update_stmt->execute())
			{
				echo "<scipt>alert('file Update succesfully');</script>";
				header("Location:siswa.php");
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