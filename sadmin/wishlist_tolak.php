<?php
session_start();
include '../koneksi.php';
$id=$_POST['id_wish'];
$tolak="Ditolak";
$query = mysqli_query($koneksi, "UPDATE tb_wishlist SET status='$tolak' WHERE id_wish='$id'");
$querya = mysqli_query($koneksi, "SELECT * FROM tb_wishlist WHERE id_wish='$id'");
$row = mysqli_fetch_array($querya);
$kodeb=$row['kode_barang'];
if (!$query){echo "Gagal menolak wish";
}else {echo "Berhasil menolak wish";
	// $query1 = mysqli_query($koneksi, "SELECT * FROM log_barang ORDER BY id_logbarang DESC");
	// $data1=mysqli_fetch_array($query1);
	// $maxid1 = $data1[0];
	// if ($maxid1=='') {
	// 	$maxid1=1;
	// }else{$maxid1++;}
	// $id_adminlog = $_SESSION['id_admin'];
	// mysqli_query($koneksi, "INSERT INTO log_barang values('$maxid1','$id_adminlog','Tolak Wish','$kodeb',NOW())")or die(mysqli_error($koneksi));
}
mysqli_close($koneksi);
?>