<?php
session_start();
include '../koneksi.php';
$kodeb=$_POST['kode_barang'];
$querya = mysqli_query($koneksi, "SELECT * FROM tb_barang WHERE kode_barang='$kodeb' AND ket_barang='true'");
$data = mysqli_fetch_array($querya);
$nama = $data['nama_barang'];
$id_jenis = $data['id_jenisbarang'];
$kondisi = $data['kondisi_barang'];
$id_lokasi = $data['id_lokasi'];

$queryb = mysqli_query($koneksi, "SELECT * FROM tb_wishlist ORDER BY id_wish DESC");
$datab=mysqli_fetch_array($queryb);
$maxid = $datab[0];
if ($maxid=='') {
	$maxid=1;
}else{$maxid++;}
$queryc=mysqli_query($koneksi, "INSERT INTO tb_wishlist VALUES('$maxid','$kodeb','$nama','$id_jenis','$kondisi','$id_lokasi','Hapus Data',NOW(),'Belum ditanggapi') ") or die (mysqli_error());
// $query = mysqli_query($koneksi, "DELETE FROM tb_barang WHERE id_barang ='$id'");

if (!$queryc){echo "Gagal mengajukan hapus data ke wish list";
}else {echo "Berhasil mengajukan hapus data ke wish list";
	// $query1 = mysqli_query($koneksi, "SELECT * FROM log_barang ORDER BY id_logbarang DESC");
	// $data1=mysqli_fetch_array($query1);
	// $maxid1 = $data1[0];
	// if ($maxid1=='') {
	// 	$maxid1=1;
	// }else{$maxid1++;}
	// $id_adminlog = $_SESSION['id_admin'];
	// mysqli_query($koneksi, "INSERT INTO log_barang values ('$maxid1','$id_adminlog','Wish Hapus Data','$kodeb',NOW())")or die(mysqli_error($koneksi));
}
mysqli_close($koneksi);
?>