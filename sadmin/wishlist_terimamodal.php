<?php
session_start();
include '../koneksi.php';
if($_POST['rowid']) {
$id = $_POST['rowid'];         ?>
	<p class="statusMsg"></p>
	<form role="form" id="terima_form" method="POST">
	    <input type="hidden" id="id_wish" name="id_wish" value="<?php echo $id;?>" >
    </form>
<?php }  
mysqli_close($koneksi);
?>