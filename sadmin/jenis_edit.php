<?php
session_start();

include '../koneksi.php';
$id = $_POST['id_jenis'];
$jenis= $_POST['jenis'];
$kode= $_POST['kode'];

$query = mysqli_query($koneksi, "UPDATE tb_jenisbarang SET jenis_barang='$jenis',default_kodebarang='$kode' WHERE id_jenisbarang='$id'");
if (!$query){echo "Gagal edit data";
}else {echo "Berhasil edit data";}
mysqli_close($koneksi);
?>