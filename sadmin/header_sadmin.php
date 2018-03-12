<?php
session_start();
// cek apakah user sudah login
include '../koneksi.php';
if(isset($_SESSION['id_admin'])){
    $id=$_SESSION['id_admin'];
    $queryhead = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE id_admin='$id'") or die(mysqli_error());
    $rowhead = mysqli_fetch_array($queryhead);
    $_SESSION['foto']=$rowhead['foto'];
    $_SESSION['nama_admin']=$rowhead['nama_admin'];

    if($_SESSION['login'] != 'Super admin'&& $_SESSION['id_amin']!=$rowhead['id_admin']){
        header('Location: ../index-admin.php');
    } 
}else{header('Location: ../index-admin.php');}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link href="../assets/bootstrap/css/bootstrap.css" rel="stylesheet" />
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="style.css" rel="stylesheet" />
    <link href="../assets/datatables/css/dataTables.bootstrap.css" rel="stylesheet" media="screen">
    <link href="../assets/datatables/css/buttons.dataTables.css" rel="stylesheet" media="screen">
    <!-- <link href="../assets/bootstrap/css/bootstrap-table.min.css" rel="stylesheet"> -->
    <!-- <link href="../assets/datatables/css/dataTables.bootstrap4.min.css" rel="stylesheet" media="screen"> -->
    <!-- <link href="../assets/datatables/css/DT_bootstrap.css" rel="stylesheet" media="screen"> -->
    <!-- <link href="../assets/datatables/css/jquery.dataTables.min.css" rel="stylesheet" media="screen"> -->


    <script src="../assets/js/jquery-2.1.4.min.js"></script>
    <script src="../assets/js/placeholder.js"></script>
    <script src="../assets/js/Chart.bundle.js"></script>
    <script src="../assets/js/utils.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/bootstrap-table.min.js"></script>
    <script src="../assets/js/jquery.validate.min.js"></script>
    <script src="../assets/js/jquery-validate.bootstrap-tooltip.js"></script>
    <!-- <script src="../assets/datatables/js/DT_bootstrap.js"></script> -->
    <!-- <script src="../assets/datatables/js/jquery.dataTables.min.js"></script> -->
    <script src="../assets/datatables/js/jquery.dataTables.js"></script>
    <!-- <script src="../assets/datatables/js/dataTables.bootstrap4.min.js"></script> -->
    <script src="../assets/datatables/js/dataTables.bootstrap.js"></script>
<!-- 
  <script src="../assets/datatables/js/dataTables.buttons.js"></script>
    <script src="../assets/datatables/js/buttons.bootstrap.js"></script>
    <script src="../assets/datatables/js/buttons.colVis.js"></script>
    <script src="../assets/datatables/js/buttons.print.js"></script>
 -->
    
   
	<title>Super Admin-Inventaris Office</title>
</head>
<body>
    <div id="full">
	<header>
		<div class="container">
            <div class="row">
                <div class="col-sm-2 text-center" style="padding-top: 15px;">
                        <img class="img-rounder" src=<?php echo '"../foto/'.$_SESSION['foto'].'"';?> >
                </div>
            	<div class="col-sm-offset-2 col-sm-4">
                    <!-- <div class="col-sm-4"> -->
                        <h3 class="text-center"><strong>Inventaris Office</strong></h3>
                    <!-- </div> -->
                </div>
                 
                
                <div class="col-md-12">
                    <div class="col-sm-5"><strong>Welcome, </strong><?php echo $_SESSION['nama_admin'];?></div>
                    <div class="col-sm-7 text-right"><a href="../logout.php" class="btn btn-danger btn-sm"><i class="fa fa-power-off"></i><strong> Logout</strong></a></div>
                </div>
            </div>
        </div>
    </header>