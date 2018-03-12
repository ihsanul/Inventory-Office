<?php
session_start();
include '../koneksi.php';
if($_POST['rowid']) {
        $kodeb = $_POST['rowid'];
         ?>
                    <p class="statusMsg"></p>
                    <form role="form" id="hapus_form" method="POST">
                        <input type="hidden" id="kode_barang" name="kode_barang" value="<?php echo $kodeb;?>" >
                    </form>
        <?php }  
        mysqli_close($koneksi);
    ?>