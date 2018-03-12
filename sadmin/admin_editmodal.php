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
                    <form role="form" name="edit_form" id="edit_form" method="POST">
                        <input type="hidden" id="id_admin1" name="id_admin" value="<?php echo $row['id_admin'];?>" >
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username1" name="username" value="<?php echo $row['username'];?>"/>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" id="password1" name="password" value="<?php echo $row['password'];?>"/>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama1" name="nama" value="<?php echo $row['nama_admin'];?>"/>
                        </div>
                        
                          <!-- <div class="col-md-12"> -->
                            <label for="jk_admin">Jenis Kelamin</label>
                          <!-- </div> -->
                          <div class="form-group">
                            <div class="form-control">
                            <div class="col-md-6">
                              <?php if ($row['jk_admin']=="Laki-laki") { $l="checked=\"checked\" "; $p="";
                                }else if ($row['jk_admin']=="Perempuan"){$p=" checked=\"checked\" "; $l="";}
                              ?>
                            <input type='radio' id='Laki-laki1' class="jk_admin1" name='jk_admin' ng-model='mValue' value='Laki-laki' <?php echo $l; ?>/> Laki-Laki
                          </div>
                          <div class="col-md-6">
                            <!-- <div class="form-control"> -->
                            <input type='radio' id='Perempuan1' class="jk_admin1" name='jk_admin' ng-model='mValue' value='Perempuan' <?php echo $p; ?>/> Perempuan
                          </div></div>
                        </div>

                        
                        <div class="form-group">
                            <label for="status">Status</label>
                            <?php if ($row['status_admin']=="Super admin") { $sa="selected=\"selected\""; $a="";
                                }else if ($row['status_admin']=="Admin"){$a="selected=\"selected\""; $sa="";}
                                else{$a=""; $sa="";}
                              ?>
                            <select name="status" id="status1" class="form-control"  required>
                              <option value="">--Silahkan pilih--</option>
                              <option value="Admin" <?php echo $a;?>>Admin</option>
                              <option value="Super admin" <?php echo $sa;?>>Super admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="foto">Pilih gambar</label>
                            <div id="checkbox_foto">
                                <input type="checkbox" id="ubah_foto" name="ubah_foto" value="true"> Ceklis jika ingin mengubah foto
                            </div>
                            <input style="min-height: 50px;" type="file" class="form-control" id="foto1" name="foto" required>
                        </div>                     
                    </form>



        <!-- MEMBUAT FORM -->
       <!--  <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id_admin']; ?>">
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" class="form-control" name="nama" value="<?php echo $row['nama_admin']; ?>">
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea class="form-control" rows="5" name="alamat" ><?php echo $row['alamat_admin']; ?></textarea>
            </div>
              <button class="btn btn-primary" type="submit">Update</button>
        </form> -->
 
        <?php }  
        mysqli_close($koneksi);
    ?>