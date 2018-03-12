<?php
include 'koneksi.php';

$id_kabupaten=$_POST['id_kabupaten'];
$query =mysqli_query($koneksi, "SELECT * FROM kabupaten WHERE id_kabupaten='$id_kabupaten'");
$data=mysqli_fetch_array($query);
$kode=$data['kode_kabupaten'];

$queryy = mysqli_query($koneksi, "SELECT * FROM pendaftar WHERE id_pendaftar LIKE '$kode%' ORDER BY id_pendaftar DESC");
	$data2=mysqli_fetch_array($queryy);
	if($data2['id_pendaftar']=='')
		{
			$id_pendaftar=$kode.1;
		}
	else{
			$id_pendaftar++;
	}
?>