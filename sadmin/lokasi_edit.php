<?php
session_start();

include '../koneksi.php';
$id = $_POST['id_lokasi'];
$lokasi= $_POST['lokasi'];

$query = mysqli_query($koneksi, "UPDATE tb_lokasi SET lokasi='$lokasi' WHERE id_lokasi='$id'");
if (!$query){echo "Gagal edit data";
}else {echo "Berhasil edit data";}
mysqli_close($koneksi);
?>