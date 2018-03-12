<?php
	require_once '../assets/dompdf/src/Autoloader.php';
	Dompdf\Autoloader::register();

	use Dompdf\Dompdf;

	// instantiate and use the dompdf class
	$dompdf = new Dompdf();


	$html = "<p>hello pdf dari html</p><br/>";

	include 'koneksi.php';
	
	$sql = mysqli_query($koneksi, "SELECT * FROM tb_barang ORDER BY id_barang");

	$html .= "<table border='1'><tr style='font-weight: bold'><td>Kode Barang</td><td>NAMA Barang</td>";
	while($row = mysql_fetch_assoc($sql)) {
		$html.= "<tr><td>".$row['id_barang']."</td>
		<td>".$row['nama_barang']."</td></tr>";
	}
	$html .= "</table>";

	$dompdf->loadHtml($html);

	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'portrait');

	// Render the HTML as PDF
	$dompdf->render();

	// Output the generated PDF to Browser

	// $dompdf->stream();
	$dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
?>