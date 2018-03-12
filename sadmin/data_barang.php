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
                            <li><a class="menu-top-active" href="data_barang.php">Data Barang</a></li>
                            <li><a href="jenis_barang.php">Jenis Barang</a></li>
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
                              <h2>Data Barang</h2>
                            </div>
                       		 </div>
                       	</div>
                       	<div class="panel-body table-bordered">
                          <div class="row">
                            <div class="col-md-12 text-right">
                              <button class="btn btn-primary btn-success" data-toggle="modal" data-target="#modalForm"><i class="fa fa-plus-circle"></i> Tambah Data</button>
                              
                              <a href="cetak_databarang.php" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
                            
                            </div></br></br>
                          </div>
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
                                        <th>Aksi</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                     include '../koneksi.php';
                                     $query = mysqli_query($koneksi, "SELECT * FROM tb_barang as b INNER JOIN tb_jenisbarang as j on b.id_jenisbarang = j.id_jenisbarang INNER JOIN tb_lokasi as l on b.id_lokasi = l.id_lokasi WHERE ket_barang='true'");
                                     $no=1;
                                     while($row = mysqli_fetch_array($query)) {
                                        echo '<tr>';
                                        echo '<td>'. $no.'</td>';
                                        echo '<td>'. $row['kode_barang'].'</td>';
                                        echo '<td>'. $row['nama_barang'].'</td>';
                                        echo '<td>'. $row['jenis_barang'].'</td>';
                                        echo '<td>'. $row['kondisi_barang'].'</td>';
                                        echo '<td>'. $row['lokasi'].'</td>';
                                        echo '<td>';
                                        $kode=$row['kode_barang'];
                                        $querya = mysqli_query($koneksi, "SELECT * FROM tb_wishlist WHERE kode_barang='$kode' AND (wish='Edit Data' OR wish='Hapus Data') AND status='Belum ditanggapi'");
                                        $row2 = mysqli_fetch_array($querya);
                                        $num_row = mysqli_num_rows($querya);
                                        if ($num_row>0) {
                                          echo '<button class="btn btn-primary btn-disable" data-toggle="modal" data-target="#modalalert" name="editalert"><i class="fa fa-pencil"></i> Edit</button>
                                        <button class="btn btn-primary btn-danger hapus" data-toggle="modal" data-target="#modalalert" name="hapusalert"><i class="fa fa-eraser"></i> Hapus</button>';  
                                        }else{
                                        echo '<button class="btn btn-primary btn-disable" data-toggle="modal" data-target="#modalFormedit" name="edit" data-id="'.$row['kode_barang'].'"><i class="fa fa-pencil"></i> Edit</button>';
                                        echo ' <button class="btn btn-primary btn-danger hapus" data-toggle="modal" data-target="#modalhapus" name="hapus" data-id="'.$row['kode_barang'].'"><i class="fa fa-eraser"></i> Hapus</button>';  
                                        }
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
                                      $('.submitBtn').click(function kirim(e){
                                     e.preventDefault();
                                       
                                      if (document.tambah_form.nama.value == "") {alert("Isikan Nama Barang!");}
                                      else if (document.tambah_form.jenis.value == "") {alert("Pilih Jenis Barang!");}
                                      else if (document.tambah_form.kondisi.value == "") {alert("Pilih Kondisi Barang!");}
                                      else if (document.tambah_form.lokasi.value == "") {alert("Pilih Lokasi Barang!");}
                                      else{
                                      var Data = $("#tambah_form").serialize();
                                        // var x = tom.serialize()
                                      $.ajax({
                                              url: "barang_simpan.php",
                                              type: "POST",
                                              //data: tom,
                                              //data: $('#feedback_form').serialize() + '&kirim=' + $(".kirim").val(),
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
                                              url: "barang_edit.php",
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
                                              url : 'barang_editmodal.php',
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
                                                    url: "barang_hapus.php",
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
                                                    url : 'barang_hapusmodal.php',
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
                    <h4 class="modal-title" id="labelModalKu">Tambah Data Barang Form</h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <p class="statusMsg"></p>
                    <form role="form"  name="tambah_form" id="tambah_form" method="POST">
                        <div class="form-group">
                            <label for="nama">Nama Barang</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama barang"/>
                        </div>
                        <div class="form-group">
                            <label for="jenis">Jenis Barang</label>
                            <select class="form-control" id="jenis" name="jenis">
                               <?php
                                  include '../koneksi.php';
                                 $query1 = mysqli_query($koneksi,"SELECT * FROM tb_jenisbarang WHERE ket_jenis='true'");    
                                 echo '<option value="">--Pilih jenis barang--</option>';    
                                  while($data1 = mysqli_fetch_array($query1)) {
                                    echo '<option value="'.$data1['id_jenisbarang'].'">'.$data1['jenis_barang'].'</option>';
                                  }
                               ?>
                            </select>                           
                        </div>
                        <div class="form-group">
                          <label for="kondisi">Kondisi Barang</label>
                          <select class="form-control" id="kondisi" name="kondisi">
                             <option value="">--Pilih kondisi barang--</option>
                             <option value="Sangat Baik">Sangat Baik</option>
                             <option value="Baik">Baik</option>
                             <option value="Kurang Baik">Kurang Baik</option>
                             <option value="Rusak">Rusak</option>
                             <option value="Rusak Parah">Rusak Parah</option>
                          </select>                           
                      </div>
                      <div class="form-group">
                            <label for="lokasi">Lokasi Barang</label>
                            <select class="form-control" id="lokasi" name="lokasi">
                               <?php
                                 $query2 = mysqli_query($koneksi,"SELECT * FROM tb_lokasi WHERE ket_lokasi='true'");
                                 echo '<option value="">--Pilih lokasi barang--</option>';   
                                  while($data2 = mysqli_fetch_array($query2)) {
                                    echo '<option value="'.$data2['id_lokasi'].'">'.$data2['lokasi'].'</option>';
                                  }
                               ?>
                            </select>                           
                        </div>
                    </form>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary submitBtn">Simpan</button>
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

                    <h4 class="modal-title" id="labelModalKu">Edit Data Barang Form</h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                  <div class="fetched-data1"></div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submitBtn1">Simpan</button>
                </div>
            </div>
        </div>
    </div>

<!-- Modal alert -->
    <div class="modal fade" id="modalalert" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Tutup</span>
                    </button>

                    <h4 class="modal-title" id="labelModalKu">Warning!!!</h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                     <label>Tanggapi wish list terlebih dahulu !</label>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Ok</button>
                    <!-- <button type="button" class="btn btn-alert">OK</button> -->
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

                    <h4 class="modal-title" id="labelModalKu">Hapus Data Barang</h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                     <label>Apakah anda yakin menghapus data barang ?</label>
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

