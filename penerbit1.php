<?php

include_once "koneksi.php";
$query = "SELECT * FROM penerbit";

if(isset($_GET['cari']))
{

  $cr = $_GET['find'];
  $query = "SELECT * FROM penerbit WHERE nama LIKE '%$cr%' ORDER BY id_penerbit DESC";
}
else
{
  //fetching dara in descending order
  $query = "SELECT * FROM penerbit ORDER BY id_penerbit DESC";
}

?>
<!DOCTYPE html>
<html>
<head>
	<title> Bismillah YaAllah</title>
</head>
<body>
        <table width="55%" align="center" cellspacing="0">
    <thead>
        <tr height="55" valign="bottom">
        <td colspan="4" align="left"><a href="addp.php">
          <img src="images/addp.png" width="32" height="32" title=""></a></td>
      </tr>
        <tr>
      <td><form method="get"><input type="text" name="find" placeholder="Cari Nama">
        <input type="submit" name="cari" value="Cari"><br>
      </td></form>
    </tr><center>
      <tr bgcolor="solid black">
        <td width="20px">Id Penerbit</th>
        <td align='center'>Nama</th>
        <td align='center'>Kota</th>
        <td align='center'>Option</th>
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
      echo "<td align='center'>".$row['id_penerbit']."</td>";
      echo "<td align='center'>".$row['nama']."</td>";
      echo "<td align='center'>".$row['kota']."</td>";
      echo "<td align='center'>
        <a href='editp.php?edit_id=".$row['id_penerbit']."' ><img src='images/edit.png' width='25' height='25'></a> | 
        <a href='deletep.php?delete_id=".$row['id_penerbit']."' onClick=\"return confirm('Are You Sure Want To Delete?')\"><img src='images/hapus.png' width='25' height='25'></a></td>";
          }

          ?>
        </tbody>
</body>
</html>