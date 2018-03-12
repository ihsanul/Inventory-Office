<?php
include "header_user.php";
?>
   <section class="menu-section">
    	<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse">
                        <ul id="menu-top" class="nav navbar-nav navbar-left topnav">
                            <li><a class="menu-top-active" href="index.php">Beranda</a></li>
                            <li><a href="feedback.php">Feedback</a></li>
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
                    <h2>Beranda</h2>
                  </div>
            	  </div>
             	</div>
             	<div class="panel-body">
                     <div class="col-md-offset-1 col-md-10 datahead" style="min-height: 150px;">
                      <h3 style="font-family: impact, fantasy;text-align: center;">Data Barang</h3>
                      <div class="databarang row text-left">
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
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                               include 'koneksi.php';
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
                    
            </div>
              <div class="panel-footer">
              </div>
           </div>	
  			</div>
   		</div>
   	</div>
   </section>
    <footer id="footer">
    	<div class="row">
                <div class="col-md-12">
                   <h5><strong> &copy; 2017 Inventaris Office | By : <a href="http://www.king-atreus.blogspot.co.id/" target="_blank">Muhamad Ihsanul Qamil</a></strong></h5>
                </div>

            </div>
    </footer>
	<script src="assets/js/jquery-1.11.1.js"></script>
	<script src="assets/bootstrap/js/bootstrap.js"></script>
   <script>
     $(document).ready(function () {
        $.noConflict();
        var table = $('#example').DataTable();
    });
    </script>
    <script type="text/javascript">
      function myFunction() {
       document.getElementsByClassName("topnav")[0].classList.toggle("responsive");
      }
    </script>
  </div>
</body>
</html>