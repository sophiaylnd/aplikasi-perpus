<td>
							<input type="text" name="id_peminjaman" autocomplete="off" disabled="off" value="<?php
							require_once ("koneksi.php");
							$sqll = "SELECT id_peminjaman FROM master_peminjaman ORDER BY id_peminjaman DESC LIMIT 1";
							$select_stmt=$db->prepare($sqll);
							 $select_stmt->execute();
							 $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
							 function autonumber($id_terakhir, $panjang_kode, $panjang_angka)
							{
								$kode = "T";
								$angka = substr($id_terakhir, $panjang_kode, $panjang_angka);
								$angka_baru = str_repeat("0", $panjang_angka - strlen($angka+1)).($angka+1);
								$id_baru = $kode.$angka_baru;
								return $id_baru;
							}
							 $id_buku = autonumber($row['id_buku'], 1, 3);
							 echo $id_buku;
							?>">
							<input type="hidden" name="id_peminjaman" autocomplete="off" value="<?php
							require_once ("koneksi.php");
							$sqll = "SELECT id_peminjaman FROM master_peminjaman ORDER BY id_peminjaman DESC LIMIT 1";
								$select_stmt=$db->prepare($sqll);
								$select_stmt->execute();
								$row=$select_stmt->fetch(PDO::FETCH_ASSOC);
								$id_buku = autonumber($row['id_peminjaman'], 1, 3);
								echo $id_buku;
							?>">
						</td>