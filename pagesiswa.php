<?php

include_once "koneksi.php";
$query = "SELECT * FROM buku";

if(isset($_GET['cari']))
{

  $cr = $_GET['find'];
  $query = "SELECT * FROM buku WHERE judul LIKE '%$cr%' ORDER BY id_penerbit DESC";
}
else
{
  //fetching dara in descending order
  $query = "SELECT * FROM buku ORDER BY id_penerbit DESC";
}

?>
<!DOCTYPE html>
<html>
<head>
	<title> Bismillah YaAllah</title>
  <link rel="stylesheet" type="text/css" href="gradient.css">
</head>
<body>
        <table width="55%" align="center" cellspacing="0">
    <thead>
        <tr height="55" valign="bottom">
        <td colspan="4" align="left"><a href="addb.php">
          <img src="images/addb.png" width="32" height="32" title="+ penerbit"></a></td>
      </tr>
        <tr>
      <td><form method="get"><input type="text" name="find" placeholder="Cari Judul Buku">
        <input type="submit" name="cari" value="Cari"><br>
      </td></form>
    </tr><center>
      <tr bgcolor="solid black">
        <th width="20px">Id Penerbit</th>
        <th>Id Buku</th>
        <th>Penulis</th>
        <th>Judul</th>
        <th>Harga</th>
        <th>QTY</th>
        <th>Photo</th>
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
      echo "<td align='center'>".$row['id_buku']."</td>";
      echo "<td align='center'>".$row['penulis']."</td>";
      echo "<td align='center'>".$row['judul']."</td>";
      echo "<td align='center'>".$row['harga']."</td>";
      echo "<td align='center'>".$row['qty']."</td>";
      echo "<td align='center' style='border-bottom: 1pt solid black;'><img src='upload/".$row['photo']."' width='70' height='60'></td>";
          }

          ?>
        </tbody>
</body>
</html>