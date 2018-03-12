<?php
session_start();
include '../koneksi.php';
if($_POST['rowid']) {
        $id = $_POST['rowid'];
         ?>
                    <p class="statusMsg"></p>
                    <form role="form" id="hapus_form" method="POST">
                        <input type="hidden" id="id_log" name="id_log" value="<?php echo $id;?>" >
                    </form>
        <?php }  
        mysqli_close($koneksi);
    ?>