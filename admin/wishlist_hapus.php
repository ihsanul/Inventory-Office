<?php
session_start();
include '../koneksi.php';
$id=$_POST['id_wish'];
$querya = mysqli_query($koneksi, "SELECT * FROM tb_wishlist WHERE id_wish='$id'");
$data=mysqli_fetch_array($querya);
$kodeb=$data['kode_barang'];
$query = mysqli_query($koneksi, "DELETE FROM tb_wishlist WHERE id_wish='$id'");
if (!$query){echo "Gagal menghapus data";
}else {echo "Berhasil menghapus data";
	// $query1 = mysqli_query($koneksi, "SELECT * FROM log_barang ORDER BY id_logbarang DESC");
	// $data1=mysqli_fetch_array($query1);
	// $maxid1 = $data1[0];
	// if ($maxid1=='') {
	// 	$maxid1=1;
	// }else{$maxid1++;}
	// $id_adminlog = $_SESSION['id_admin'];
	// mysqli_query($koneksi, "INSERT INTO log_barang values ('$maxid1','$id_adminlog','Hapus Data Wish','$kodeb',NOW())")or die(mysqli_error($koneksi));
}
mysqli_close($koneksi);
?>