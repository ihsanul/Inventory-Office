<?php
session_start();

include '../koneksi.php';
$id = $_POST['id_wish'];
$kodeb=$_POST['kode_barang'];
$nama= $_POST['nama'];
$jenis = $_POST['jenis'];
$kondisi = $_POST['kondisi'];
$lokasi = $_POST['lokasi'];

$query = mysqli_query($koneksi, "UPDATE tb_wishlist SET nama_wishbarang='$nama', id_jenisbarang='$jenis', kondisi_barangwish='$kondisi', id_lokasi='$lokasi' WHERE id_wish='$id'");
if (!$query){echo "Gagal edit data";
}else {echo "Berhasil edit data";
	// $query1 = mysqli_query($koneksi, "SELECT * FROM log_barang ORDER BY id_logbarang DESC");
	// $data1=mysqli_fetch_array($query1);
	// $maxid1 = $data1[0];
	// if ($maxid1=='') {
	// 	$maxid1=1;
	// }else{$maxid1++;}
	// $id_adminlog = $_SESSION['id_admin'];
	// mysqli_query($koneksi, "INSERT INTO log_barang values('$maxid1','$id_adminlog','Edit Data Wish','$kodeb',NOW())")or die(mysqli_error($koneksi));
}
mysqli_close($koneksi);
?>