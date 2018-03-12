<?php
session_start();

include '../koneksi.php';
$id_jenis = $_POST['jenis'];
$query = mysqli_query($koneksi, "SELECT * FROM tb_jenisbarang WHERE id_jenisbarang='$id_jenis' AND ket_jenis='true'");
$data=mysqli_fetch_array($query);
$maxid = $data['default_kodebarang'];
// if ($maxid=='') {
// 	$maxid=1;
// }else{$maxid++;}
$nama = $_POST['nama'];
$kondisi = $_POST['kondisi'];
$id_lokasi = $_POST['lokasi'];

$queryb = mysqli_query($koneksi, "SELECT * FROM tb_wishlist ORDER BY id_wish DESC");
$datab=mysqli_fetch_array($queryb);
$maxid2 = $datab[0];
if ($maxid2=='') {
	$maxid2=1;
}else{$maxid2++;}

$queryc = mysqli_query($koneksi, "INSERT INTO tb_wishlist VALUES ('$maxid2','$maxid','$nama','$id_jenis','$kondisi','$id_lokasi','Tambah Data',NOW(),'Belum ditanggapi')")or die(mysqli_error($koneksi));
if (!$queryc){echo "Gagal mengajukan tambah data ke wish list";
}else {echo "Berhasil mengajukan tambah data ke wish list";
	// $query1 = mysqli_query($koneksi, "SELECT * FROM log_barang ORDER BY id_logbarang DESC");
	// $data1=mysqli_fetch_array($query1);
	// $maxid1 = $data1[0];
	// if ($maxid1=='') {
	// 	$maxid1=1;
	// }else{$maxid1++;}
	// $id_adminlog = $_SESSION['id_admin'];
	// mysqli_query($koneksi, "INSERT INTO log_barang values('$maxid1','$id_adminlog','Wish Tambah Data','$maxid',NOW())")or die(mysql_error($koneksi));
}
mysqli_close($koneksi);
?>