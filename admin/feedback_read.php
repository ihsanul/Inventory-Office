<?php
session_start();
include '../koneksi.php';
$id=$_POST['id_feedback'];
$terima="Telah dibaca";
$id_adminfeed=$_SESSION['id_admin'];
$query = mysqli_query($koneksi, "UPDATE tb_feedback SET status_feedback='$terima', id_admin='$id_adminfeed' WHERE id_feedback='$id'");

if (!$query){echo "Gagal menandai feedback";
}else {echo "Berhasil menandai feedback";}
mysqli_close($koneksi);
?>