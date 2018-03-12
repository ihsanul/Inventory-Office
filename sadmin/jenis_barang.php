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
                            <li><a class="menu-top-active" href="jenis_barang.php">Jenis Barang</a></li>
                            <li><a href="lokasi.php">Lokasi Barang</a></li>
                            <li><a href="log_admin.php">Log Admin</a></li>
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
                              <h2>Jenis Barang</h2>
                            </div>
                       		 </div>
                       	</div>
                       	<div class="panel-body table-bordered">
                          <div class="row">
                            <div class="col-md-12 text-right">
                              <button class="btn btn-primary btn-success" data-toggle="modal" data-target="#modalForm"><i class="fa fa-plus-circle"></i> Tambah Jenis Barang</button>
                            </div></br></br>
                          </div>
                            <div class="row">
                              <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered display">
                                    <thead>
                                      <tr>
                                        <th>No</th>
                                        <th>Jenis Barang</th>
                                        <th>Kode Jenis Barang</th>
                                        <th>Aksi</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                     include '../koneksi.php';
                                     $query = mysqli_query($koneksi, "SELECT * FROM tb_jenisbarang WHERE ket_jenis ='true'");
                                     $no=1;
                                     while($row = mysqli_fetch_array($query)) {
                                        echo '<tr>';
                                        echo '<td>'. $no.'</td>';
                                        echo '<td>'. $row['jenis_barang'].'</td>';
                                        echo '<td>'. $row['default_kodebarang'].'</td>';
                                        echo '<td>
                                          <button class="btn btn-primary btn-disable" data-toggle="modal" data-target="#modalFormedit" name="edit" data-id="'.$row['id_jenisbarang'].'"><i class="fa fa-pencil"></i> Edit</button>
                                          <button class="btn btn-primary btn-danger hapus" data-toggle="modal" data-target="#modalhapus" name="hapus" data-id="'.$row['id_jenisbarang'].'"><i class="fa fa-eraser"></i> Hapus</button>  
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
                                      $('.submitBtn').click(function kirim(e){
                                      e.preventDefault();
                                      if (document.tambah_form.jenis.value == "") {alert("Isikan Jenis Barang!");}
                                      else if (document.tambah_form.kode.value == "") {alert("Isikan Kode Jenis Barang!");}
                                      else{
                                      var Data = $("#tambah_form").serialize();
                                      $.ajax({
                                              url: "jenis_simpan.php",
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
                                      }
                                      })

                                      $('.submitBtn1').click(function edit(e){
                                      e.preventDefault();
                                      var Data = $("#edit_form").serialize();
                                      $.ajax({
                                              url: "jenis_edit.php",
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
                                      // }
                                      })
                                        $('#modalFormedit').on('show.bs.modal', function (e) {
                                          var rowid = $(e.relatedTarget).data('id');
                                          //menggunakan fungsi ajax untuk pengambilan data
                                          $.ajax({
                                              type : 'POST',
                                              url : 'jenis_editmodal.php',
                                              data :  'rowid='+ rowid,
                                              success : function(data){
                                              $('.fetched-data1').html(data);//menampilkan data ke dalam modal
                                              }
                                            })
                                       })

                                          $('.submitBtn2').click(function hapus(e){
                                            e.preventDefault();
                                              var Data = $("#hapus_form").serialize();
                                              // var tom = $(this).attr(
                                            $.ajax({
                                                    url: "jenis_hapus.php",
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
                                                    url : 'jenis_hapusmodal.php',
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
    <!-- Modal Simpan -->
    <div class="modal fade" id="modalForm" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Tutup</span>
                    </button>
                    <h4 class="modal-title" id="labelModalKu">Tambah Jenis Barang Form</h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <p class="statusMsg"></p>
                    <form role="form"  name="tambah_form" id="tambah_form" method="POST">
                        <div class="form-group">
                            <label for="jenis">Jenis Barang</label>
                            <input type="text" class="form-control" id="jenis" name="jenis" placeholder="Masukkan jenis barang"/>
                        </div>
                        <div class="form-group">
                            <label for="kode">Kode Jenis Barang</label>
                            <input type="text" class="form-control" id="kode" name="kode" placeholder="Masukkan kode jenis barang"/>
                        </div>
                    </form>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary submitBtn" onclick="kirim()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    
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

                    <h4 class="modal-title" id="labelModalKu">Edit Jenis Barang Form</h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                  <div class="fetched-data1"></div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submitBtn1" onclick="edit()">Simpan</button>
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
                    <h4 class="modal-title" id="labelModalKu">Hapus Jenis Barang</h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                     <label>Apakah anda yakin menghapus jenis barang ?</label>
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

