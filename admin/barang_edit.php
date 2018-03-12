<?php
session_start();

include '../koneksi.php';
$kodeb = $_POST['kode_barang'];
$nama= $_POST['nama'];
$id_jenis = $_POST['jenis'];
$kondisi = $_POST['kondisi'];
$id_lokasi = $_POST['lokasi'];
$querya = mysqli_query($koneksi, "SELECT * FROM tb_wishlist ORDER BY id_wish DESC");
$dataa=mysqli_fetch_array($querya);
$maxid = $dataa[0];
if ($maxid=='') {
	$maxid=1;
}else{$maxid++;}
$queryc=mysqli_query($koneksi, "INSERT INTO tb_wishlist values ('$maxid','$kodeb','$nama','$id_jenis','$kondisi','$id_lokasi','Edit Data',NOW(),'Belum ditanggapi')")or die(mysqli_error($koneksi));
// $query = mysqli_query($koneksi, "UPDATE tb_barang SET nama_barang='$nama',jenis_barang='$jenis',kondisi_barang='$kondisi',lokasi_barang='$lokasi' WHERE id_barang='$id'");
if (!$queryc){echo "Gagal mengajukan edit data ke wish list";
}else {echo "Berhasil mengajukan edit data ke wish list";
	// $query1 = mysqli_query($koneksi, "SELECT * FROM log_barang ORDER BY id_logbarang DESC");
	// $data1=mysqli_fetch_array($query1);
	// $maxid1 = $data1[0];
	// if ($maxid1=='') {
	// 	$maxid1=1;
	// }else{$maxid1++;}
	// $id_adminlog = $_SESSION['id_admin'];
	// mysqli_query($koneksi, "INSERT INTO log_barang values ('$maxid1','$id_adminlog','Wish Edit Data','$kodeb',NOW())")or die(mysqli_error());
}
mysqli_close($koneksi);
?>