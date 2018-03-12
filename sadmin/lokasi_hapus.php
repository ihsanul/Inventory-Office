<?php
session_start();
include '../koneksi.php';
$id=$_POST['id_lokasi'];
$query = mysqli_query($koneksi, "UPDATE tb_lokasi SET ket_lokasi='false' WHERE id_lokasi='$id'");
if (!$query){echo "Gagal menghapus data";
}else {echo "Berhasil menghapus data";}
mysqli_close($koneksi);
?>