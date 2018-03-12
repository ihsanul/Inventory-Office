<?php
session_start();

include '../koneksi.php';
if($_POST['rowid']) {
        $id = $_POST['rowid'];
        $query = mysqli_query($koneksi,"SELECT * FROM tb_jenisbarang WHERE id_jenisbarang = '$id'");        
        $row = mysqli_fetch_array($query);
         ?>
                    <p class="statusMsg"></p>
                    <form role="form" name="edit_form" id="edit_form" method="POST">
                        <input type="hidden" id="id_jenis" name="id_jenis" value="<?php echo $row['id_jenisbarang'];?>" >
                        <div class="form-group">
                            <label for="jenis">Jenis Barang</label>
                            <input type="text" class="form-control" id="jenis" name="jenis" value="<?php echo $row['jenis_barang'];?>"/>
                        </div>
                        <div class="form-group">
                            <label for="kode">Kode Jenis Barang</label>
                            <input type="text" class="form-control" id="kode" name="kode" value="<?php echo $row['default_kodebarang'];?>"/>
                        </div>
                    </form>
    <?php }  
    mysqli_close($koneksi);
?>