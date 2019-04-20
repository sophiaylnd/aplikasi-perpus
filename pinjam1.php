<!DOCTYPE html>
<html>
<head>
  <title> Bismillah</title>
</head>
<body>

</body>
</html><?php

include_once "koneksi.php";
include_once "fungsi.php";

$query = "SELECT master_peminjaman.id_peminjaman, master_peminjaman.id_pustakawan, master_peminjaman.nis, master_peminjaman.tgl_pinjam, detail_peminjaman.id_buku, detail_peminjaman.tgl_kembali FROM master_peminjaman left join detail_peminjaman on master_peminjaman.id_peminjaman=detail_peminjaman.id_peminjaman ORDER BY master_peminjaman.id_peminjaman";
?><table width="55%" align="center" cellspacing="0">
    <thead>
        <tr height="55" valign="bottom">
        <td colspan="4" align="left"><a href="addt.php">
          <img src="images/addb.png" width="32" height="32" title="+ peminjaman"></a></td>
      </tr>
        <tr>
      <td><form method="get"><input type="text" name="find" placeholder="Cari Penerbit">
        <input type="submit" name="cari" value="Cari"><br>
      </td></form>
    </tr><center>
      <tr bgcolor="solid black">
        <th width="20px">Id Peminjaman</th>
        <th>Id Pustakawan</th>
        <th>Nis</th>
        <th>Tgl Pinjam</th>
        <th>Tgl Kembali</th>
        <th>Id Buku</th>
        <th>Terlambat</th>
        <th>Kembali</th>
        <th>Perpanjang</th>
      </tr>
      </thead>
      </center>
        <tbody>
<?php

	   
          $select_stmt=$db->prepare($query);
          $select_stmt->execute();
while ($hasil=$select_stmt->fetch(PDO::FETCH_ASSOC)) {
echo "<tr>
      <td>".$hasil['id_peminjaman']."</td>
	  <td>".$hasil['id_pustakawan']."</td>
	  <td>".$hasil['nis']."</td>
	  <td>".$hasil['tgl_pinjam']."</td>
	  <td>".$hasil['tgl_kembali']."</td>
	  <td>".$hasil['id_buku']."</td>
	  <td>";

	  	$denda1=1000;
	    $tgl_dateline=$hasil['tgl_kembali'];
		$tgl_kembali=date('d-m-Y');
		$lambat=terlambat($tgl_dateline, $tgl_kembali);
		$denda=$lambat*$denda1;
		if ($lambat>0) {
		echo "<font color='red'>$lambat hari<br>(Rp $denda)</font>";
		}
		else {
		echo $lambat." hari";
		}

		echo "</td>";
		echo "<td align='center'>
        <a href='kembali.php?edit_id=".$hasil['id_peminjaman']."' ><img src='images/edit.png' width='25' height='25'></a></td>";
        echo "<td align='center'>
        <a href='panjang.php?delete_id=".$hasil['id_peminjaman']."' ><img src='images/edit.png' width='25' height='25'></a></td>";

}
?>
</table>