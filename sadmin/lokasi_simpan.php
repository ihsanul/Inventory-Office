<?php
session_start();

include '../koneksi.php';
$query = mysqli_query($koneksi, "SELECT * FROM tb_lokasi ORDER BY id_lokasi DESC");
$data=mysqli_fetch_array($query);
$maxid = $data[0];
if ($maxid=='') {
	$maxid=1;
}else{$maxid++;}
$lokasi = $_POST['lokasi'];

$query = mysqli_query($koneksi, "INSERT INTO tb_lokasi VALUES('$maxid','$lokasi','true')");
if (!$query){echo "Gagal simpan data";
}else {echo "Berhasil simpan data";}
mysqli_close($koneksi);
?>