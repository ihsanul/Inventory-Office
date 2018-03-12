<?php
session_start();
// echo $username;
$username = $_POST['username'];
$password = $_POST['password'];

// echo $password;
// $username = mysqli_real_escape_string($db,$_POST['username']);
// $password = mysqli_real_escape_string($db,$_POST['password']);

// menentukan user yang bisa login
include "koneksi.php";
$query = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE username='$username' AND password='$password' AND ket_admin!='hapus'") or die(mysqli_error());
$row = mysqli_fetch_array($query);
$pass= $row['password'];
$num_row = mysqli_num_rows($query);
if( $num_row > 0 && ($password==$pass) ) { 
		$_SESSION['nama_admin']=$row['nama_admin'];
		$_SESSION['login']=$row['status_admin'];
		$_SESSION['id_admin']=$row['id_admin'];
		$query1 = mysqli_query($koneksi, "SELECT * FROM log_admin ORDER BY id_logadmin DESC");
		$data=mysqli_fetch_array($query1);
		$maxid = $data[0];
		if ($maxid=='') {
			$maxid=1;
		}else{$maxid++;}
		$id_adminlog = $row['id_admin'];
		mysqli_query($koneksi, "INSERT INTO log_admin (id_logadmin, id_admin, keterangan_la, log_dateadmin) values('$maxid', '$id_adminlog','Login', NOW())")or die(mysqli_error($koneksi));
		echo $row['status_admin'];}
		else {echo 'false';}
mysqli_close($koneksi);
?>