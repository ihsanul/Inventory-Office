<?php
session_start();
include '../koneksi.php';
$id=$_POST['id_jenis'];
$query = mysqli_query($koneksi, "UPDATE tb_jenisbarang SET ket_jenis='false' WHERE id_jenisbarang='$id'");
if (!$query){echo "Gagal menghapus data";
}else {echo "Berhasil menghapus data";}
mysqli_close($koneksi);
?>