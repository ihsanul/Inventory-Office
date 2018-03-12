<?php
$host = "localhost";
$user = "root";
$pass = "";
$koneksi = mysqli_connect($host,$user,$pass);
mysqli_select_db($koneksi,"db_inventaris");
?>