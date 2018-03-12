<?php
session_start();

include '../koneksi.php';
$waktu=gmdate("Y-m-d H:i:s", time()+60*60*8);

$id = $_POST['id_admin'];
$username= $_POST['username'];
$pass = $_POST['password'];
$nama = $_POST['nama'];
$jk = $_POST['jk_admin'];
$status = $_POST['status'];

if(isset($_POST['ubah_foto'])){
$foto = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];
$fotobaru = date('dmYHis').$foto;
$path = "../foto/".$fotobaru;
 if(move_uploaded_file($tmp, $path)){
	$query = mysqli_query($koneksi, "SELECT foto FROM tb_admin WHERE id_admin='$id'");
	$data = mysqli_fetch_array($query);
	// Cek apakah file foto sebelumnya ada di folder foto
	if(is_file("../foto/".$data['foto'])) // Jika foto ada
		unlink("../foto/".$data['foto']); // Hapus file foto sebelumnya yang ada di folder foto

	$query = mysqli_query($koneksi, "UPDATE tb_admin SET username='$username',password='$pass',nama_admin='$nama',jk_admin='$jk',status_admin='$status',foto='$fotobaru' WHERE id_admin='$id'");
	if (!$query){echo "Gagal edit data";
	}else {echo "Berhasil edit data";}
 }
}else{
	$query = mysqli_query($koneksi, "UPDATE tb_admin SET username='$username',password='$pass',nama_admin='$nama',jk_admin='$jk',status_admin='$status' WHERE id_admin='$id'");
	if (!$query){echo "Gagal edit data";
	}else {echo "Berhasil edit data";}
}

mysqli_close($koneksi);
?>