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
                            <li><a class="menu-top-active" href="data_admin.php">Data Admin</a></li>
                            <li><a href="wishlist.php">Wish List</a></li>
                            <li><a href="data_barang.php">Data Barang</a></li>
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
                              <h2>Data Admin</h2>
                            </div>
                       		 </div>
                       	</div>
                       	<div class="panel-body table-bordered">
                          <div class="row">
                            <div class="col-md-12 text-right">
                              <button class="btn btn-primary btn-success" data-toggle="modal" data-target="#modalForm"><i class="fa fa-plus-circle"></i> Tambah Data</button>
                            </div></br></br>
                          </div>
                            <div class="row">
                              <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered display">
                                    <thead>
                                      <tr>
                                        <th>No &nbsp&nbsp</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Status</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                     include '../koneksi.php';
                                     $query = mysqli_query($koneksi, "SELECT * FROM tb_admin");
                                     $no=1;
                                     while($row = mysqli_fetch_array($query)) {
                                        echo '<tr>';
                                        echo '<td>'. $no.'</td>';
                                        echo '<td>'. $row['username'].'</td>';
                                        echo '<td>'. $row['password'].'</td>';
                                        echo '<td>'. $row['nama_admin'].'</td>';
                                        echo '<td>'. $row['jk_admin'].'</td>';
                                        echo '<td>'. $row['status_admin'].'</td>';
                                        echo '<td class="text-center">'. 
                                            '<img src="../foto/'. $row['foto'] .'" width="80" height="80">'
                                           .'</td>';
                                        echo '<td>
                                          <button class="btn btn-primary btn-disable" data-toggle="modal" data-target="#modalFormedit" name="edit" data-id="'.$row['id_admin'].'"><i class="fa fa-pencil"></i> Edit</button>';
                                        if($_SESSION['id_admin']!=$row['id_admin'])
                                          {echo ' <button class="btn btn-primary btn-danger hapus" data-toggle="modal" data-target="#modalhapus" name="hapus" data-id="'.$row['id_admin'].'"><i class="fa fa-eraser"></i> Hapus</button>';}
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
                                        // var tom = $(this).attr('id');
                                      if (document.tambah_form.username.value == "") {alert("Isikan Username!");}
                                      else if (document.tambah_form.password.value == "") {alert("Isikan Password!");}
                                      else if (document.tambah_form.nama.value == "") {alert("Isikan Nama!");}
                                      // if (document.tambah_form.status.value == "") {alert("Pilih Status!");}
                                      else if (document.tambah_form.status.value == "") {alert("Pilih Status!");}
                                      else if (document.tambah_form.foto.value == "") {alert("Pilih Foto!");}
                                      else{

                                        var data = new FormData();
                                        data.append('username', $("#username").val()); // Ambil data judul foto
                                        data.append('password', $("#password").val());
                                        data.append('nama', $("#nama").val());

                                        if($("#Laki-laki").is(":checked")){data.append('jk_admin', $("#Laki-laki").val());}
                                        else if($("#Perempuan").is(":checked")){data.append('jk_admin', $("#Perempuan").val());}

                                        data.append('status', $("#status").val());
                                        data.append('foto', $("#foto")[0].files[0]);
                                      // var Data = $("#tambah_form").serialize();
                                        // var x = tom.serialize()
                                      $.ajax({
                                              url: "admin_simpan.php",
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
                                      }
                                    })

                                      $('.submitBtn1').click(function edit(e){
                                      e.preventDefault();
                                       // var Data = $("#edit_form").serialize();
                                      
                                       var data = new FormData();
                                        data.append('id_admin', $("#id_admin1").val());
                                        data.append('username', $("#username1").val()); // Ambil data judul foto
                                        data.append('password', $("#password1").val());
                                        data.append('nama', $("#nama1").val());

                                        if($("#Laki-laki1").is(":checked")){data.append('jk_admin', $("#Laki-laki1").val());}
                                        else if($("#Perempuan1").is(":checked")){data.append('jk_admin', $("#Perempuan1").val());}

                                        data.append('status', $("#status1").val());
                                        data.append('foto', $("#foto1")[0].files[0]);
                                        if($("#ubah_foto").is(":checked")) // Jika di ceklis
                                        data.append('ubah_foto', $("#ubah_foto").val());
                                      // if (document.edit_form.status.value == "") {alert("Pilih Status!");}
                                      // else{
                                      
                                        // var x = tom.serialize()
                                      $.ajax({
                                              url: "admin_edit.php",
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
                                      // }
                                      })
                                        $('#modalFormedit').on('show.bs.modal', function (e) {
                                          var rowid = $(e.relatedTarget).data('id');
                                          //menggunakan fungsi ajax untuk pengambilan data
                                          $.ajax({
                                              type : 'POST',
                                              url : 'admin_editmodal.php',
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
                                                    url: "admin_hapus.php",
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
                                                    url : 'admin_hapusmodal.php',
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
                    <h4 class="modal-title" id="labelModalKu">Tambah Data Admin Form</h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <p class="statusMsg"></p>
                    <form role="form"  name="tambah_form" id="tambah_form" method="POST">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username"/>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" id="password" name="password" placeholder="Masukkan password"/>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama"/>
                        </div>
                        
                          <!-- <div class="col-md-12"> -->
                            <label for="jk_admin">Jenis Kelamin</label>
                          <!-- </div> -->
                          <div class="form-group">
                            <div class="form-control">
                            <div class="col-md-6">
                            <input type='radio' name='jk_admin' id="Laki-laki" ng-model='mValue' value='Laki-laki' checked="true"/> Laki-Laki
                          </div>
                          <div class="col-md-6">
                            <!-- <div class="form-control"> -->
                            <input type='radio' name='jk_admin' id="Perempuan" ng-model='mValue' value='Perempuan'/> Perempuan
                          </div></div>
                        </div>
                        <div class="form-group">
                            <label for="status">Status <span class="required"></span></label>
                            <select name="status" id="status" class="form-control"  required >
                              <option value="">--Silahkan pilih--</option>
                              <option value="Admin">Admin</option>
                              <option value="Super admin">Super admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="foto">Pilih gambar</label>
                            <input style="min-height: 50px;" type="file" class="form-control" id="foto" name="foto" required>
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

                    <h4 class="modal-title" id="labelModalKu">Edit Data Admin Form</h4>
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

                    <h4 class="modal-title" id="labelModalKu">Hapus Data Admin</h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                     <label>Apakah anda yakin menghapus data admin ?</label>
                     <div class="fetched-data2"></div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger submitBtn2">Hapus</button>
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

