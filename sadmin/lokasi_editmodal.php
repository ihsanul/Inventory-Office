<?php
session_start();

include '../koneksi.php';
if($_POST['rowid']) {
        $id = $_POST['rowid'];
        $query = mysqli_query($koneksi,"SELECT * FROM tb_lokasi WHERE id_lokasi = '$id'");        
        $row = mysqli_fetch_array($query);
         ?>
                    <p class="statusMsg"></p>
                    <form role="form" name="edit_form" id="edit_form" method="POST">
                        <input type="hidden" id="id_lokasi" name="id_lokasi" value="<?php echo $row['id_lokasi'];?>" >
                        <div class="form-group">
                            <label for="lokasi">Lokasi</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?php echo $row['lokasi'];?>"/>
                        </div>
                    </form>
    <?php }  
    mysqli_close($koneksi);
?>