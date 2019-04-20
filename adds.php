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

if(isset($_POST['btn_insert']))
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
			$sql = "INSERT INTO siswa(nis ,nama ,tingkat ,jurusan ,kelas ,photo) VALUES(:fnis, :fnama, :ftingkat, :fjurusan, :fkelas, :fimage)";
			$insert_stmt=$db->prepare($sql);
			$insert_stmt->bindParam(':fnis', $nis);
			$insert_stmt->bindParam(':fnama', $name);
			$insert_stmt->bindParam(':ftingkat', $tingkat);
			$insert_stmt->bindParam(':fjurusan', $jurusan);
			$insert_stmt->bindParam(':fkelas', $kelas);
			$insert_stmt->bindParam(':fimage', $image_file); //bind all parameter

			if($insert_stmt->execute())
			{
				echo "<scipt>alert('file upload succesfully')</script>";
				header("Location: siswa.php");
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
						<td>Nis</td>
						<td><input type="text" name="nis"/></td>
					</tr>
					<tr>
						<td>Nama</td>
						<td><input type="text" name="nama"/></td>
					</tr>
					<tr>
						<td>Tingkat</td>
						<td>
							<select name="tingkat">
								<option value="X">X</option>
								<option value="XI">XI</option>
								<option value="XII">XII</option>
								<option value="XIII">XIII</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Jurusan</td>
						<td>
							<select name="jurusan">
								<option value="RPL">RPL</option>
								<option value="PFPT">PFPT</option>
								<option value="IOP">IOP</option>
								<option value="TOI">TOI</option>
								<option value="EIND">EIND</option>
								<option value="TPTU">TPTU</option>
								<option value="TEDK">TEDK</option>
								<option value="SIJA">SIJA</option>
								<option value="MEKA">MEKA</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Kelas</td>
						<td>
							<select name="kelas">
								<option value="A">A</option>
								<option value="B">B</option>
								<option value="C">C</option>
								<option value="D">D</option>
							</select>
						</td>
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