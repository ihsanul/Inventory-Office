<?php
session_start();
include "koneksi.php";
$id=$_SESSION['id_admin'];
$query = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE id_admin='$id'") or die(mysqli_error());
$row = mysqli_fetch_array($query);
$query1 = mysqli_query($koneksi, "SELECT * FROM log_admin ORDER BY id_logadmin DESC");
$data=mysqli_fetch_array($query1);
$maxid = $data[0];
if ($maxid=='') {
	$maxid=1;
}else{$maxid++;}
mysqli_query($koneksi, "INSERT INTO log_admin (id_logadmin,id_admin,keterangan_la,log_dateadmin)values('$maxid','$id','Logout',NOW())")or die(mysqli_error());
session_destroy();
session_unset();
mysqli_close($koneksi);
header('Location: index-admin.php');
?>