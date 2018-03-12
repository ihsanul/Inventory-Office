<?php
session_start();
include '../koneksi.php';
$id=$_POST['id_admin'];
$querya = mysqli_query($koneksi, "SELECT foto FROM tb_admin WHERE id_admin ='$id'");
$data = mysqli_fetch_array($querya);
if(is_file("../foto/".$data['foto'])) // Jika foto ada
	unlink("../foto/".$data['foto']);
$query = mysqli_query($koneksi, "DELETE FROM tb_admin WHERE id_admin ='$id'");
if (!$query){echo "Gagal menghapus data";
}else {echo "Berhasil menghapus data";}
mysqli_close($koneksi);
?>