<?php
session_start();

// if (isset($_POST['kirim'])) {
include '../koneksi.php';
if($_POST['rowid']) {
        $id = $_POST['rowid'];
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $query = mysqli_query($koneksi,"SELECT * FROM tb_admin WHERE id_admin = '$id'");
        $row = mysqli_fetch_array($query);
         ?>
          <p class="statusMsg"></p>
          <form role="form" name="atur_form" id="atur_form" method="POST">
              <input type="hidden" id="id_admin1" name="id_admin1" value="<?php echo $row['id_admin'];?>" >
              <div class="form-group">
                  <label for="username" style="color: black;">Username</label>
                  <input type="text" class="form-control" id="username1" name="username1" value="<?php echo $row['username'];?>"/>
              </div>
              <div class="form-group">
                  <label for="password" style="color: black;">Password</label>
                  <input type="text" class="form-control" id="password1" name="password1" value="<?php echo $row['password'];?>"/>
              </div>
              <div class="form-group">
                  <label for="nama" style="color: black;">Nama</label>
                  <input type="text" class="form-control" id="nama1" name="nama1" value="<?php echo $row['nama_admin'];?>"/>
              </div>
              
                <!-- <div class="col-md-12"> -->
                  <label for="jk_admin" style="color: black;">Jenis Kelamin</label>
                <!-- </div> -->
                <div class="form-group">
                  <div class="form-control">
                  <div class="col-md-6">
                    <?php if ($row['jk_admin']=="Laki-laki") { $l="checked=\"checked\" "; $p="";
                      }else if ($row['jk_admin']=="Perempuan"){$p=" checked=\"checked\" "; $l="";}
                    ?>
                  <input type='radio' id='Laki-laki1' class="jk_admin1" name='jk_admin1' ng-model='mValue' value='Laki-laki' <?php echo $l; ?>/> Laki-Laki
                </div>
                <div class="col-md-6">
                  <!-- <div class="form-control"> -->
                  <input type='radio' id='Perempuan1' class="jk_admin1" name='jk_admin1' ng-model='mValue' value='Perempuan' <?php echo $p; ?>/> Perempuan
                </div></div>
              </div>
              <div class="form-group">
                  <label for="foto" style="color: black;margin-bottom: 0px;">Pilih gambar</label>
                  <div id="checkbox_foto" style="color: black;">
                      <input type="checkbox" id="ubah_foto1" name="ubah_foto1" value="true"> Ceklis jika ingin mengubah foto
                  </div>
                  <input style="min-height: 50px;" type="file" class="form-control" id="foto1" name="foto" required>
              </div>                     
          </form>
<?php }  
mysqli_close($koneksi);
?>