<?php
session_start();
include '../koneksi.php';
if($_POST['rowid']) {
$id = $_POST['rowid'];         ?>
	<p class="statusMsg"></p>
	<form role="form" id="read_form" method="POST">
	    <input type="hidden" id="id_feedback" name="id_feedback" value="<?php echo $id;?>" >
    </form>
<?php }  
mysqli_close($koneksi);
?>