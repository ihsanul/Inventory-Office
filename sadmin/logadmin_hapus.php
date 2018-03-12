<?php
session_start();
include '../koneksi.php';
$id=$_POST['id_log'];
$query = mysqli_query($koneksi, "DELETE FROM log_admin WHERE id_logadmin ='$id'");
if (!$query){echo "Gagal menghapus data";
}else {echo "Berhasil menghapus data";}
mysqli_close($koneksi);
?>