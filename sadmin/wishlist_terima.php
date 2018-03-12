<?php
session_start();
include '../koneksi.php';
$id=$_POST['id_wish'];
$terima="Diterima";
$query = mysqli_query($koneksi, "UPDATE tb_wishlist SET status='$terima' WHERE id_wish='$id'");
$querya = mysqli_query($koneksi, "SELECT * FROM tb_wishlist WHERE id_wish='$id'");
$row = mysqli_fetch_array($querya);
$kodeb=$row['kode_barang'];
$nama=$row['nama_wishbarang'];
$jenis=$row['id_jenisbarang'];
$kondisi=$row['kondisi_barangwish'];
$lokasi=$row['id_lokasi'];
$wish=$row['wish'];

if ($wish=='Tambah Data') {
	$queryx = mysqli_query($koneksi, "SELECT * FROM tb_jenisbarang WHERE id_jenisbarang='$jenis'");
	$datax=mysqli_fetch_array($queryx);
	$kode=$datax['default_kodebarang'];

	$queryy = mysqli_query($koneksi, "SELECT * FROM tb_barang WHERE kode_barang LIKE '$kode%' ORDER BY kode_barang DESC");
	$datay=mysqli_fetch_array($queryy);
	$maxid = $datay['kode_barang'];
	if ($maxid==''||$maxid==$kode) {
		$x=1;
		$maxid=$kode.$x;
	}else{$maxid++;}
	$kodeb=$maxid;
	mysqli_query($koneksi, "INSERT INTO tb_barang VALUES ('$kodeb','$nama','$jenis','$kondisi','$lokasi','true')");
	$keterangan_lb='Tambah Data';
}else if ($wish=='Edit Data') {
	$querym =mysqli_query($koneksi, "SELECT * FROM tb_barang WHERE kode_barang='$kodeb'");
	$datam=mysqli_fetch_array($querym);
	if($datam['id_jenisbarang']==$jenis){$maxid=$kodeb;}
	else{
		$queryx = mysqli_query($koneksi, "SELECT default_kodebarang FROM tb_jenisbarang WHERE id_jenisbarang='$jenis'");
		$datax=mysqli_fetch_array($queryx);
		$kode=$datax['default_kodebarang'];

		$queryy = mysqli_query($koneksi, "SELECT * FROM tb_barang WHERE kode_barang LIKE '$kode%' ORDER BY kode_barang DESC");
		$datay=mysqli_fetch_array($queryy);
		$maxid = $datay['kode_barang'];
		if ($maxid==''||$maxid==$kode) {
			$x=1;
			$maxid=$kode.$x;
		}else{$maxid++;}
	}
	mysqli_query($koneksi, "UPDATE tb_barang SET kode_barang='$maxid', nama_barang='$nama',id_jenisbarang='$jenis',kondisi_barang='$kondisi',id_lokasi='$lokasi' WHERE kode_barang='$kodeb'");
		$id_barang=$maxid;
		$keterangan_lb='Edit Data';
	
}else if ($wish=='Hapus Data') {
	mysqli_query($koneksi, "UPDATE tb_barang SET ket_barang='false' WHERE kode_barang='$kodeb'");
	$keterangan_lb='Hapus Data';
}

if (!$query){echo "Gagal menerima wish";
}else {echo "Berhasil menerima wish";
	$query1 = mysqli_query($koneksi, "SELECT * FROM log_barang ORDER BY id_logbarang DESC");
	$data1=mysqli_fetch_array($query1);
	$maxid1 = $data1[0];
	if ($maxid1=='') {
		$maxid1=1;
	}else{$maxid1++;}
	$id_adminlog = $_SESSION['id_admin'];
	mysqli_query($koneksi, "INSERT INTO log_barang values ('$maxid1','$id_adminlog','$keterangan_lb','$kodeb',NOW())")or die(mysqli_error($koneksi));
}
mysqli_close($koneksi);
?>