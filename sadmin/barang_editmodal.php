<?php
session_start();

// if (isset($_POST['kirim'])) {
include '../koneksi.php';
if($_POST['rowid']) {
        $id = $_POST['rowid'];
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $query = mysqli_query($koneksi,"SELECT * FROM tb_barang WHERE kode_barang = '$id' AND ket_barang='true'");        
        $row = mysqli_fetch_array($query);
         ?>
                    <p class="statusMsg"></p>
                    <form role="form" name="edit_form" id="edit_form" method="POST">
                        <input type="hidden" id="kode_barang" name="kode_barang" value="<?php echo $row['kode_barang'];?>" >
                        <div class="form-group">
                            <label for="nama">Nama Barang</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama_barang'];?>"/>
                        </div>
                        <div class="form-group">
                            <label for="jenis">Jenis Barang</label>
                            <select class="form-control" id="jenis" name="jenis">
                               <?php
                                 $query1 = mysqli_query($koneksi,"SELECT * FROM tb_jenisbarang WHERE ket_jenis='true'");   
                                  while($data = mysqli_fetch_array($query1)) {
                                    if($data['id_jenisbarang']==$row['id_jenisbarang']){
                                      $select='selected';
                                    }else{$select='';}
                                    echo '<option '.$select.' value="'.$data['id_jenisbarang'].'">'.$data['jenis_barang'].'</option>';
                                  }
                               ?>
                            </select>                           
                        </div>
                        <div class="form-group">
                          <label for="kondisi">Kondisi Barang</label>
                          <select class="form-control" id="kondisi" name="kondisi">
                             <option <?php if($row['kondisi_barang']=="Sangat Baik") {echo "selected";} ?> value="Sangat Baik">Sangat Baik</option>
                             <option <?php if($row['kondisi_barang']=="Baik") {echo "selected";} ?> value="Baik">Baik</option>
                             <option <?php if($row['kondisi_barang']=="Kurang Baik") {echo "selected";} ?> value="Kurang Baik">Kurang Baik</option>
                             <option <?php if($row['kondisi_barang']=="Rusak") {echo "selected";} ?> value="Rusak">Rusak</option>
                             <option <?php if($row['kondisi_barang']=="Rusak Parah") {echo "selected";} ?> value="Rusak Parah">Rusak Parah</option>
                          </select>                           
                      </div>
                      <div class="form-group">
                            <label for="lokasi">Lokasi Barang</label>
                            <select class="form-control" id="lokasi" name="lokasi">
                               <?php
                                 $query2 = mysqli_query($koneksi,"SELECT * FROM tb_lokasi WHERE ket_lokasi='true'");
                                 while($data2 = mysqli_fetch_array($query2)) {
                                    if($data2['id_lokasi']==$row['id_lokasi']){
                                      $select2='selected';
                                    }else{$select2="";}
                                  echo '<option '.$select2.' value="'.$data2['id_lokasi'].'">'.$data2['lokasi'].'</option>';
                                  }
                               ?>
                            </select>                           
                        </div>
                      </form> 
        <?php }  
        mysqli_close($koneksi);
    ?>