<?php
session_start();
include '../koneksi.php';
$id=$_POST['id_feedback'];
$query = mysqli_query($koneksi, "DELETE FROM tb_feedback WHERE id_feedback='$id'");

if (!$query){echo "Gagal menghapus feedback";
}else {echo "Berhasil menghapus feedback";}
mysqli_close($koneksi);
?>