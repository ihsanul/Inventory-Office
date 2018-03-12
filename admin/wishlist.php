<?php
include 'header_admin.php';
?>
    <section class="menu-section">
    	<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse">
                        <ul id="menu-top" class="nav navbar-nav navbar-left topnav">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li><a class="menu-top-active" href="wishlist.php">Wish List</a></li>
                            <li><a href="data_barang.php">Data Barang</a></li>
                            <li><a href="feedback.php">Feedback</a></li>
                            <li class="icon">
                              <a href="javascript:void(0);" onclick="myFunction()">☰</a>
                            </li>
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
                              <h2>Wish List</h2>
                            </div>
                       		 </div>
                       	</div>
                       	<div class="panel-body table-bordered">
                        <!--   <div class="row">
                            <div class="col-md-12 text-right">
                              <button class="btn btn-primary btn-success" data-toggle="modal" data-target="#modalForm">Tambah Data Admin</button>
                            </div></br></br>
                          </div> -->
                            <div class="row">
                              <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered display">
                                    <thead>
                                      <tr>
                                        <th>No &nbsp&nbsp</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Jenis</th>
                                        <th>Kondisi</th>
                                        <th>Lokasi</th>
                                        <th>Wish</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                     include '../koneksi.php';
                                     $query = mysqli_query($koneksi, "SELECT * FROM tb_wishlist AS w INNER JOIN tb_jenisbarang AS j ON w.id_jenisbarang = j.id_jenisbarang INNER JOIN tb_lokasi AS l ON w.id_lokasi = l.id_lokasi ORDER BY tanggal_wish DESC");
                                     $no=1;
                                     while($row = mysqli_fetch_array($query)) {
                                        echo '<tr>';
                                        echo '<td>'. $no.'</td>';
                                        echo '<td>'. $row['kode_barang'].'</td>';
                                        echo '<td>'. $row['nama_wishbarang'].'</td>';
                                        echo '<td>'. $row['jenis_barang'].'</td>';
                                        echo '<td>'. $row['kondisi_barangwish'].'</td>';
                                        echo '<td>'. $row['lokasi'].'</td>';
                                        echo '<td>'. $row['wish'].'</td>';
                                        echo '<td>'. $row['tanggal_wish'].'</td>';
                                        echo '<td>'. $row['status'].'</td>';
                                        echo '<td>';
                                        if($row['status']=="Belum ditanggapi"){
                                          echo '<button class="btn btn-primary btn-disable" data-toggle="modal" data-target="#modalFormedit" name="edit" data-id="'.$row['id_wish'].'"><i class="fa fa-pencil"></i> Edit</button>';}
                                        echo ' <button class="btn btn-primary btn-danger hapus" data-toggle="modal" data-target="#modalhapus" name="hapus" data-id="'.$row['id_wish'].'"><i class="fa fa-eraser"></i> Hapus</button>';
                                        echo '</td>';
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
                                       $('.submitBtn1').click(function edit(e){
                                        e.preventDefault();
                                        var Data = $("#edit_form").serialize();
                                        $.ajax({
                                              url: "wishlist_edit.php",
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
                                        $('#modalFormedit').on('show.bs.modal', function (e) {
                                          var rowid = $(e.relatedTarget).data('id');
                                          //menggunakan fungsi ajax untuk pengambilan data
                                          $.ajax({
                                              type : 'POST',
                                              url : 'wishlist_editmodal.php',
                                              data :  'rowid='+ rowid,
                                              success : function(data){
                                              $('.fetched-data1').html(data);//menampilkan data ke dalam modal
                                              }
                                            })
                                       })

                                          $('.submitBtn2').click(function hapus(e){
                                            e.preventDefault();
                                              var Data = $("#hapus_form").serialize();
                                            $.ajax({
                                                    url: "wishlist_hapus.php",
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
                                                    url : 'wishlist_hapusmodal.php',
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
    
        <!-- Modal Edit -->
    <div class="modal fade" id="modalFormedit" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Tutup</span>
                    </button>

                    <h4 class="modal-title" id="labelModalKu">Edit Data Wish Form</h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                  <div class="fetched-data1"></div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submitBtn1" name="simpan">Simpan</button>
                </div>
            </div>
        </div>
    </div>

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

                    <h4 class="modal-title" id="labelModalKu">Hapus Data Wish</h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                     <label>Apakah anda yakin menghapus data wish ?</label>
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

