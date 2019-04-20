<?php
include_once "koneksi.php";
$pinjam			= date("d-m-Y");
$tiga_hari		= mktime(0,0,0,date("n"),date("j")+3,date("Y"));
$kembali		= date("d-m-Y", $tiga_hari);

$ssql = "SELECT id_peminjaman FROM detail_peminjaman ORDER BY id_peminjaman";
$sssql = "SELECT id_pustakawan FROM master_peminjaman ORDER BY id_pustakawan";
$ssssql = "SELECT nis FROM siswa ORDER BY nis";
?>
<form method="post" action="">
<input type="hidden" name="pinjam" value="<?php echo $pinjam; ?>">
<input type="hidden" name="kembali" value="<?php echo $kembali; ?>">
<table border=1 width=100%>
<tr><td colspan="2">Peminjaman Buku</td></tr>

<tr>
<td>Id Peminjaman</td>
<td><select name="id_peminjaman">
<?php

$stmt = $db->prepare($ssql);
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
extract($row); ?>
<option value="<?php echo $id_peminjaman ?>">
<?php echo $id_peminjaman ?></option>
<?php
}
?>
</select>
</td>
</tr>

<tr>
<td>Id Pustakawan</td>
<td><select name="id_pustakawan">
<?php

$stmt = $db->prepare($sssql);
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
extract($row); ?>
<option value="<?php echo $id_pustakawan ?>">
<?php echo $id_pustakawan ?></option>
<?php
}
?>
</select>
</td>
</tr>



<tr>
<td>Nis</td>
<td><select name="nis">
<?php

$stmt = $db->prepare($ssssql);
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
extract($row); ?>
<option value="<?php echo $nis ?>">
<?php echo $nis ?></option>
<?php
}
?>
</select>
</td>
</tr>




<td class="pinggir-data">
<select name="buku">
<option value="" selected>------- Pilih Judul Bukunya -----</option>
<?php
include "../include/koneksi_db.php";
$q=mysql_query("SELECT * FROM data_buku ORDER BY id", $konek);
while ($buku=mysql_fetch_array($q)) {
echo "<option value='$buku[0].$buku[1]'>$buku[0]. $buku[1]</option>";
}
?>
</select> <a href="?page=input_buku">Tambah Buku Baru</a>
</td></tr>

<tr><td class="pinggir-data">Nama Peminjam</td>
<td class="pinggir-data">
<select name="peminjam">
<option value="" selected>------- Pilih Nama Peminjamnya -----</option>
<?php
$qa=mysql_query("SELECT * FROM data_anggota ORDER BY id", $konek);
while ($anggota=mysql_fetch_array($qa)) {
echo "<option value='$anggota[2]'>$anggota[0]. $anggota[2]</option>";
}
?>
</select>
</td></tr>


<tr><td class="pinggir-data">Tanggal Pinjam</td><td class="pinggir-data"><b><?php echo $pinjam; ?></b></td></tr>
<tr><td class="pinggir-data">Tanggal Kembali</td><td class="pinggir-data"><b><?php echo $kembali; ?></b></td></tr>
<tr><td class="pinggir-data">Keterangan</td>
<td class="pinggir-data"><input type="text" name="ket" size="40"></td></tr>

<tr><td colspan="2" align="center" class="head-data">
<input type="submit" value="Input">
</td></tr>
</table>
</form>
