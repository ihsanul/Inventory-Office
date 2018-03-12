<?php
include 'header_sadmin.php';
?>
    <section class="menu-section">
    	<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse">
                        <ul id="menu-top" class="nav navbar-nav navbar-left topnav">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li><a href="data_admin.php">Data Admin</a></li>
                            <li><a href="wishlist.php">Wish List</a></li>
                            <li><a href="data_barang.php">Data Barang</a></li>
                            <li><a href="jenis_barang.php">Jenis Barang</a></li>
                            <li><a href="lokasi.php">Lokasi Barang</a></li>
                            <li><a class="menu-top-active" href="log_admin.php">Log Admin</a></li>
                            <li><a href="log_barang.php">Log Barang</a></li>
                            <li class="icon">
                              <a href="javascript:void(0);" onclick="myFunction()">☰</a>
                            </li>
                        </ul>
                    </div>
                </div>
	        </div>
	    </div>
    </section>
    <section>
	   	<div class="container">
    	<div class="row">
    		<div class="col-md-12">
    			 <div class="notice-board">
                        <div class="panel panel-default">
                           <div class="panel-heading">
                            <div class="w-title">
                              <h2>Log User</h2>
                            </div>
                       		 </div>
                       	</div>
                       	<div class="panel-body table-bordered">
                          <div class="row">
                            <div class="col-md-12 text-right">
                              <a href="cetak_logadmin.php" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
                            </div></br></br>
                          </div>
                            <div class="row">
                              <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered display">
                                    <thead>
                                      <tr>
                                        <th>No &nbsp&nbsp</th>
                                        <th>Nama</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                     include '../koneksi.php';
                                     $query = mysqli_query($koneksi, "SELECT * FROM log_admin as a inner join tb_admin as d on a.id_admin=d.id_admin ORDER BY a.log_dateadmin DESC");
                                     $no=1;
                                     while($row = mysqli_fetch_array($query)) {
                                        echo '<tr>';
                                        echo '<td>'. $no.'</td>';
                                        echo '<td>'. $row['nama_admin'].'</td>';
                                        echo '<td>'. $row['status_admin'].'</td>';
                                        echo '<td>'. $row['keterangan_la'].'</td>';
                                        echo '<td>'. $row['log_dateadmin'].'</td>';
                                        // echo '<td>'. $row['lokasi_barang'].'</td>';
                                        echo '<td>
                                          <button class="btn btn-primary btn-danger hapus" data-toggle="modal" data-target="#modalhapus" name="hapus" data-id="'.$row['id_logadmin'].'"><i class="fa fa-eraser"></i> Hapus</button>  
                                        </td>';
                                        echo '</tr>';
                                        $no++;
                                     }
                                     mysqli_close($koneksi);
                                    ?>
                                    </tbody>
                                </table>
                              </div>
                            </div>
                        </div>
                         <script>
                                     $(document).ready(function () {
                                        $.noConflict();
                                        var table = $('#example').DataTable();
                                    });

                                    $(function(){
                                          $('.submitBtn2').click(function hapus(e){
                                            e.preventDefault();
                                              var Data = $("#hapus_form").serialize();
                                              // var tom = $(this).attr(
                                            $.ajax({
                                                    url: "logadmin_hapus.php",
                                                    type: "POST",
                                                    data: Data,
                                                    success: function(msg){
                                                    alert(msg);
                                                    window.location.reload();
                                                    },
                                                    error: function(msg){
                                                    alert(msg);
                                                    }
                                                  })
                                            })
                                              $('#modalhapus').on('show.bs.modal', function (e) {
                                                var rowid = $(e.relatedTarget).data('id');
                                                //menggunakan fungsi ajax untuk pengambilan data
                                                $.ajax({
                                                    type : 'POST',
                                                    url : 'logadmin_hapusmodal.php',
                                                    data :  'rowid='+ rowid,
                                                    success : function(data){
                                                    $('.fetched-data2').html(data);//menampilkan data ke dalam modal
                                                    }
                                                  })
                                             })
                                     });
                        </script>
                        <script type="text/javascript">
                          function myFunction() {
                           document.getElementsByClassName("topnav")[0].classList.toggle("responsive");
                          }
                        </script>
                        <div class="panel-footer">
                        </div>
                </div>	
  			</div>
   		</div>
   		</div>
    </section>

            <!-- Modal Hapus -->
    <div class="modal fade" id="modalhapus" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Tutup</span>
                    </button>

                    <h4 class="modal-title" id="labelModalKu">Hapus Data Log Admin</h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                     <label>Apakah anda yakin menghapus data log admin ?</label>
                     <div class="fetched-data2"></div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger submitBtn2" onclick="hapus()">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <footer id="footer">
    	<div class="row">
                <div class="col-md-12">
                   <h5><strong> &copy; 2017 Inventaris Office | By : <a href="http://www.king-atreus.blogspot.co.id/" target="_blank">Muhamad Ihsanul Qamil</a></strong></h5>
                </div>
      </div>
    </footer>

	<script src="../assets/js/jquery-1.11.1.js"></script>
	<script src="../assets/bootstrap/js/bootstrap.js"></script>
    </div>
</body>
</html>

