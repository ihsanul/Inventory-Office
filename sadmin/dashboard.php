<?php
include 'header_sadmin.php';
include "../koneksi.php";
?>
   <section class="menu-section">
    	<div class="container">
            <div class="row">
                <div class="col-md-12">                 
                    <div class="navbar-collapse">
                        <ul id="menu-top" class="nav navbar-nav navbar-left topnav">
                            <li><a class="menu-top-active" href="dashboard.php">Dashboard</a></li>
                            <li><a href="data_admin.php">Data Admin</a></li>
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
                    <h2>Dashboard</h2>
                  </div> 
            	  </div>
             	</div>
             	<div class="panel-body">
                <div class="col-md-12">
                  <div class="col-md-5 chartadmin" style="margin-top: 10px;">
                    <div id="canvas-holder" style="text-align: center;">Chart Admin
                      <?php
                        $queryL = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE status_admin='Super admin'");
                        $queryP = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE status_admin='Admin'");    
                        $jlhL = mysqli_num_rows($queryL);
                        $jlhP = mysqli_num_rows($queryP);
                      ?>
                      <canvas id="chart-area1" />
                    </div>
                  </div>
                  <div class="col-md-offset-2 col-md-5 chartbarang" style="margin-top: 10px;">
                    <div id="canvas-holder" style="text-align: center;">Chart Barang                   
                      <canvas id="chart-area2" />
                    </div>
                  </div>
                </div>
                <div class="col-md-12" style="margin-top: 10px;">
                  <div class="col-md-5 chartbarang1" style="margin-top: 10px;">
                    <div id="canvas-holder" style="text-align: center;">Chart Barang
                      <canvas id="chart-area3" />
                    </div>
                  </div>
                  <div class="col-md-offset-2 col-md-5 chartwishlist" style="margin-top: 10px;">
                    <div id="canvas-holder" style="text-align: center;">Chart Wish List
                      <?php
                        $j=0;$f=0;$m=0;$a=0;$me=0;$jn=0;$jl=0;$ag=0;$s=0;$o=0;$n=0;$d=0;
                        $query1 = mysqli_query($koneksi, "SELECT tanggal_wish FROM tb_wishlist"); 
                        while($b=mysqli_fetch_array($query1)){
                        $bulan = substr($b['tanggal_wish'],5,2);
                        switch ($bulan) {
                          case '1':
                            $j++;
                            break;
                          case '2':
                            $f++;
                            break;
                          case '3':
                            $m++;
                            break;
                          case '4':
                            $a++;
                            break;
                          case '5':
                            $me++;
                            break;
                          case '6':
                            $jn++;
                            break;
                          case '7':
                            $jl++;
                            break;                          
                          case '8':
                            $ag++;
                            break;
                          case '9':
                            $s++;
                            break;
                          case '10':
                            $o++;
                            break;
                          case '11':
                            $n++;
                            break;
                          case '12':
                            $d++;
                            break;
                        }
                      }
                      ?>
                      <canvas id="chart-area4" />
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
      <script>
          var ctx = document.getElementById("chart-area1").getContext("2d");
          window.myPie = new Chart(ctx, {
                type: 'pie',
                data: {
                    datasets: [{
                        <?php echo "data: [$jlhL, $jlhP], "?>
                        backgroundColor: [
                           window.chartColors.blue,
                           window.chartColors.purple,
                        ],
                        label: 'Dataset 1'
                    }],
                    labels: [
                        "Super admin",
                        "Admin",
                    ]
                },
                options: {
                    responsive: true,
                    // scales: 
                }
          });
    </script>

    <script>
          var ctx = document.getElementById("chart-area3").getContext("2d");
          window.myPie = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [<?php
                                $z=0;
                                $queryq = mysqli_query($koneksi, "SELECT DISTINCT id_lokasi FROM tb_barang where ket_barang='true' ORDER BY id_lokasi ASC");
                                while($dataq = mysqli_fetch_array($queryq)) {
                                $idlokasi = $dataq['id_lokasi'];
                                $queryil = mysqli_query($koneksi, "SELECT * FROM tb_barang WHERE id_lokasi='$idlokasi' AND ket_barang ='true'") or die(mysqli_error($koneksi));                    
                                  if ($z>0) {echo ", ";}
                                  $jlokasi = mysqli_num_rows($queryil);
                                  echo $jlokasi;
                                  $z++;
                                }?>],
                        backgroundColor: [
                           window.chartColors.blue,
                           window.chartColors.green,
                           window.chartColors.yellow,
                           window.chartColors.orange,
                           window.chartColors.red,
                           window.chartColors.purple,
                           window.chartColors.gray,
                           window.chartColors.blue,
                           window.chartColors.green,
                           window.chartColors.yellow,
                           window.chartColors.orange,
                           window.chartColors.red,
                           window.chartColors.purple,
                           window.chartColors.gray
                          
                        ],
                        label: 'Jumlah Barang Berdasarkan Lokasi'
                    }],
                    labels: [<?php $querye = mysqli_query($koneksi, "SELECT DISTINCT id_lokasi FROM tb_barang WHERE ket_barang ='true' ORDER BY id_lokasi ASC")or die(mysqli_error($koneksi));
                    $v=0;
                    while ($datae = mysqli_fetch_array($querye)) {
                    $idlokasi = $datae['id_lokasi'];
                    $queryer = mysqli_query($koneksi, "SELECT * FROM tb_lokasi WHERE id_lokasi='$idlokasi' AND ket_lokasi ='true' ORDER BY id_lokasi ASC") or die(mysqli_error($koneksi));                    
                      while($dataer = mysqli_fetch_array($queryer)) {
                        if ($v>0) {echo ", ";}
                        echo "'";
                        echo $dataer['lokasi'];
                        echo "'";
                      }
                      $v++;
                    }?>]
                },
                options: {
                    responsive: true,
                    // scales: 
                }
          });
        </script>
        <script>
          var ctx = document.getElementById("chart-area2").getContext("2d");
          var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                  labels: [<?php $queryy = mysqli_query($koneksi, "SELECT DISTINCT id_jenisbarang FROM tb_barang WHERE ket_barang ='true' ORDER BY id_jenisbarang ASC")or die(mysqli_error($koneksi));
                    $x=0;
                    while ($datay = mysqli_fetch_array($queryy)) {
                    $idjenis = $datay['id_jenisbarang'];
                    $queryui = mysqli_query($koneksi, "SELECT * FROM tb_jenisbarang WHERE id_jenisbarang='$idjenis' AND ket_jenis ='true' ORDER BY id_jenisbarang ASC") or die(mysqli_error($koneksi));                    
                      while($dataui = mysqli_fetch_array($queryui)) {
                        if ($x>0) {echo ", ";}
                        echo "'";
                        echo $dataui['jenis_barang'];
                        echo "'";
                      }
                      $x++;
                    }?>],
                  datasets: [{
                      label: 'Jumlah Barang Berdasarkan Jenis',
                      data: [<?php
                                $i=0;
                                $queryx = mysqli_query($koneksi, "SELECT DISTINCT id_jenisbarang FROM tb_barang WHERE ket_barang ='true' ORDER BY id_jenisbarang ASC") or die(mysqli_error($koneksi));
                                  while($datax = mysqli_fetch_array($queryx)) {
                                  if ($i>0) {echo ", ";}
                                  $idjenis= $datax['id_jenisbarang'];
                                  $queryt = mysqli_query($koneksi, "SELECT id_jenisbarang FROM tb_barang WHERE id_jenisbarang='$idjenis' AND ket_barang='true'");
                                  $jumlah = mysqli_num_rows($queryt);
                                  echo $jumlah;
                                  $i++;
                                }                      
                              ?>],
                      backgroundColor: 
                      [
                            // window.chartColors.blue,
                          'rgba(255, 50, 132, 0.7)',
                          'rgba(54, 162, 235, 0.7)',
                          'rgba(255, 255, 120, 0.7)',
                          'rgba(75, 192, 192, 0.7)',
                          'rgba(153, 102, 255, 0.7)',
                          'rgba(255, 159, 64, 0.7)',
                          'rgba(255, 50, 132, 0.7)',
                          'rgba(54, 162, 235, 0.7)',
                          'rgba(255, 255, 120, 0.7)',
                          'rgba(75, 192, 192, 0.7)',
                          'rgba(153, 102, 255, 0.7)',
                          'rgba(255, 159, 64, 0.7)'
                      ],
                      borderColor: 
                      // [
                          // 'rgba(255,99,132,1)',
                          'rgba(54, 162, 235, 1)',
                      //     'rgba(255, 206, 86, 1)',
                      //     'rgba(75, 192, 192, 1)',
                      //     'rgba(153, 102, 255, 1)',
                      //     'rgba(255, 159, 64, 1)'
                      // ],
                      borderWidth: 1
                  }]
              },
              options: {
                  responsive: true,
                  scales: {
                      yAxes: [{
                          ticks: {
                              beginAtZero:true
                          }
                      }]
                  }
              }
          });
      </script>
      <script>
          var ctx = document.getElementById("chart-area4").getContext("2d");
          var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                  labels: ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"],
                  datasets: [{
                      label: 'Jumlah Wish List',
                      data: [<?php echo "$j, $f, $m, $a, $me, $jn, $jl, $ag, $s, $o, $n, $d";?>],
                      backgroundColor: 'rgba(0,250,154, 1)',
                      borderColor: 'rgba(54, 162, 235, 1)',
                      borderWidth: 1
                  }]
              },
              options: {
                  responsive: true,
                  scales: {
                      yAxes: [{
                          ticks: {
                              beginAtZero:true
                          }
                      }]
                  }
              }
          });
      </script>
      <script type="text/javascript">
        function myFunction() {
         document.getElementsByClassName("topnav")[0].classList.toggle("responsive");
        }
      </script>
   </section>
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

