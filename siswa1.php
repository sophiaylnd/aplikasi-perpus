<?php

include_once "koneksi.php";
$query = "SELECT * FROM siswa";

if(isset($_GET['cari']))
{

	$cr = $_GET['find'];
	$query = "SELECT * FROM siswa WHERE nama LIKE '%$cr%' ORDER BY nis DESC";
}
else
{
	//fetching dara in descending order
	$query = "SELECT * FROM siswa ORDER BY nis DESC";
}
?>
<!DOCTYPE html>
<html>
<head>
<title> index - siswa </title>
	<link rel="stylesheet" type="text/css" href="search.css">
	<link rel="stylesheet" type="text/css" href="button.css">
</head>
<body>
	<table width="55%" align="center" cellspacing="0">
		<thead>
				<tr height="55" valign="bottom">
				<td colspan="4" align="left"><a href="adds.php">
					<img src="images/adds.png" width="32" height="32" title="Add Image"></a></td>
			</tr>
				<tr>
			<td><form method="get"><input type="text" name="find" placeholder="Cari Nama">
				<input type="submit" name="cari" value="Cari"><br>
			</td></form>
		</tr><center>
			<tr bgcolor="solid black">
				<th width="20px">Nis</th>
				<th>Nama</th>
				<th>Tingkat</th>
				<th>Jurusan</th>
				<th>Kelas</th>
				<th>Photo</th>
				<th>Update</th>
			</tr>
			</thead>
			</center>
				<tbody>
					<?php
					$select_stmt=$db->prepare($query);
					$select_stmt->execute();
					while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
					{
						
						echo "<tr>";
			echo "<td align='center'>".$row['nis']."</td>";
			echo "<td align='center'>".$row['nama']."</td>";
			echo "<td align='center'>".$row['tingkat']."</td>";
			echo "<td align='center'>".$row['jurusan']."</td>";
			echo "<td align='center'>".$row['kelas']."</td>";
			echo "<td align='center' style='border-bottom: 1pt solid black;'><img src='upload/".$row['photo']."' width='70' height='60'></td>";
			echo "<td align='center'>
				<a href='edits.php?edit_id=".$row['nis']."' ><img src='images/edit.png' width='25' height='25'></a> | 
				<a href='deletes.php?delete_id=".$row['nis']."' onClick=\"return confirm('Are You Sure Want To Delete?')\"><img src='images/hapus.png' width='25' height='25'></a></td>";
					}

					?>
				</tbody>
				</table>
</body>

</html>