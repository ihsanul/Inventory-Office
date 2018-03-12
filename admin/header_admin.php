<?php
session_start();
// cek apakah user sudah login
include '../koneksi.php';
if(isset($_SESSION['id_admin'])){
	$iden=$_SESSION['id_admin'];
	$queryhead = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE id_admin='$iden'") or die(mysqli_error());
	$rowhead = mysqli_fetch_array($queryhead);
	$_SESSION['foto']=$rowhead['foto'];
	$_SESSION['nama_admin']=$rowhead['nama_admin'];
	if($_SESSION['login'] != 'Admin' && $_SESSION['id_amin']!=$rowhead['id_admin']){
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
    <script src="../assets/datatables/js/jquery.dataTables.min.js"></script>
    <!-- <script src="../assets/datatables/js/dataTables.bootstrap4.min.js"></script> -->
    <script src="../assets/datatables/js/dataTables.bootstrap.js"></script>
    
   
	<title>Admin-Inventaris Office</title>
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
                <div class="    col-md-12">
                    <div class="col-sm-5"><strong>Welcome, </strong><?php echo $_SESSION['nama_admin'];?></div>
                    <div class="col-sm-7 text-right">
                        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalatur" data-id=<?php echo '"'.$iden.'"' ?>><i class="fa fa-cog"></i><strong> Pengaturan</strong></a>
                        <a href="../logout.php" class="btn btn-danger btn-sm"><i class="fa fa-power-off"></i> <strong>Logout</strong></a>
                    </div>
                </div>
            </div>
        </div>
         <script>
        $(function(){
          $('.submitBtn3').click(function atur(e){
                     e.preventDefault();
                     
                     var data = new FormData();
                     data.append('id_admin', $("#id_admin1").val());
                     data.append('username', $("#username1").val()); // Ambil data judul foto
                     data.append('password', $("#password1").val());
                     data.append('nama', $("#nama1").val());
                     if($("#Laki-laki1").is(":checked")){data.append('jk_admin', $("#Laki-laki1").val());}
                     else if($("#Perempuan1").is(":checked")){data.append('jk_admin', $("#Perempuan1").val());}
                     data.append('foto', $("#foto1")[0].files[0]);
                     if($("#ubah_foto1").is(":checked")) // Jika di ceklis
                       {data.append('ubah_foto', $("#ubah_foto1").val());}
                     $.ajax({
                          url: "atur.php",
                          type: "POST",
                          data: data,
                          processData: false,
                          contentType: false,
                          success: function(msg){
                          alert(msg);
                          window.location.reload();
                          },
                          error: function(msg){
                          alert(msg);
                          }
                        })
                      })
                     $('#modalatur').on('show.bs.modal', function (e) {
                       var rowid = $(e.relatedTarget).data('id');
                       $.ajax({
                          type : 'POST',
                          url : 'aturmodal.php',
                          data :  'rowid='+ rowid,
                          success : function(data){
                          $('.fetched-data').html(data);//menampilkan data ke dalam modal
                       }
                      })
                     })
            });
    </script>
        <!-- Modal Atur -->
    <div class="modal fade" id="modalatur" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Tutup</span>
                    </button>
                    <h4 class="modal-title" id="labelModalKu" style="color: black;">Pengaturan</h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                  <div class="fetched-data"></div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submitBtn3">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    </header>