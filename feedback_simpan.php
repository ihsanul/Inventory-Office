<?php
session_start();
include 'koneksi.php';
$nama = $_POST['nama'];
$keterangan = $_POST['keterangan'];

$queryb = mysqli_query($koneksi, "SELECT * FROM tb_feedback ORDER BY id_feedback DESC");
$datab=mysqli_fetch_array($queryb);
$maxid = $datab[0];
if ($maxid=='') {
	$maxid=1;
}else{$maxid++;}

$queryc = mysqli_query($koneksi, "INSERT INTO tb_feedback VALUES('$maxid','$nama','$keterangan',NOW(),'Belum dibaca','0')");
if (!$queryc){echo "Gagal mengirim feedback";
}else {echo "Berhasil mengirim feedback";}
mysqli_close($koneksi);
?>