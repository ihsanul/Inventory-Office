<?php
session_start();

include '../koneksi.php';
$querya = mysqli_query($koneksi, "SELECT * FROM tb_admin ORDER BY id_admin DESC");
$data=mysqli_fetch_array($querya);
$maxid = $data[0];
if ($maxid=='') {
	$maxid=1;
}else{$maxid++;}
$username = $_POST['username'];
$pass = $_POST['password'];
$nama = $_POST['nama'];
$jk = $_POST['jk_admin'];
$status= $_POST['status'];
$waktu=gmdate("Y-m-d H:i:s", time()+60*60*8);
$foto = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];
$fotobaru = date('dmYHis').$foto;
$path = "../foto/".$fotobaru;
if(move_uploaded_file($tmp, $path)){
$query = mysqli_query($koneksi, "INSERT INTO tb_admin VALUES('$maxid','$username','$pass','$nama','$jk','$status','$fotobaru','true')");
if (!$query){echo "Gagal simpan data";
}else {echo "Berhasil simpan data";}
}
mysqli_close($koneksi);
?>