<?php


require_once '../assets/dompdf/src/Autoloader.php';
  Dompdf\Autoloader::register();

  use Dompdf\Dompdf;
  $dompdf = new DOMPDF();
// date_default_timezone_set('Asia/Jakarta');
  $tanggal=date('d-m-Y', time()+60*60*8);
  $day = date('D', strtotime($tanggal));
  $dayList = array(
    'Sun' => 'Minggu',
    'Mon' => 'Senin',
    'Tue' => 'Selasa',
    'Wed' => 'Rabu',
    'Thu' => 'Kamis',
    'Fri' => 'Jumat',
    'Sat' => 'Sabtu'
  );
  $hari=$dayList[$day];
  $waktu=$hari.', '.$tanggal;
  $html = "<html>
  <head style='margin-bottom: 50px;height: 150px'>
  <style>
    @page { margin: 160px 50px; }
    header { position: fixed; top: -120px; left: 0px; right: 0px; background-color: #ddd; height: 100px; border: 2px solid #aaa;}
    footer { position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }
    p { page-break-after: always; }
    p:last-child { page-break-after: never; }
    d {font-family: arial, sans-serif;
      text-align: center;
      margin: 0px;
      font-size: 25px;
    }
    f {font-family: arial, sans-serif;
      text-align: center;
      margin: 0px;
      font-size: 15px;
    }
    tgl {
      font-family: arial, sans-serif;
      text-align: left;
      margin: 0px;
      font-size: 12px;
      padding: 5px;
    }
    table {
    font-family: arial, sans-serif;
    font-size: 12px;
    border-collapse: collapse;
    width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 5px;
    }

    tr:nth-child(even) {
        background-color: #cccccc;
    }
  </style>
  </head>
  <body>
  <header>
  <center><br><d><b>Inventaris Office</b></d></center>
  <center><f>Laporan Log User</f></center>
  <tgl><br>&nbsp;&nbsp;".$waktu."</tgl>
  </header>
  <main>";
  include "../koneksi.php";
  $query = mysqli_query($koneksi, "SELECT * FROM log_admin as a inner join tb_admin as d on a.id_admin=d.id_admin ORDER BY a.log_dateadmin ASC");
  $no=1;
  
  $html .= "<table border='1px' border-color='black' width='100%'><tr><th>No.</th><th>Nama</th><th>Status</th><th>Keterangan</th><th>Tanggal</th></tr>";
  while ($data = mysqli_fetch_assoc($query)) {
  $nama=$data['nama_admin'];
  $status=$data['status_admin'];
  $ket=$data['keterangan_la'];
  $date=$data['log_dateadmin'];
  $html .= '<tr><td>'.$no.'</td>'.
    '<td>'.$nama.'</td>'.
    '<td>'.$status.'</td>'.
    '<td>'.$ket.'</td>'.
    '<td>'.$date.'</td></tr>';
    $no++;
 }
$html .= '</table></main</body></html>';


$dompdf->load_html($html);
$dompdf->setPaper('A4', 'portrait');
$font = $dompdf->getFontMetrics()->get_font("helvetica", "bold");
$dompdf->getCanvas()->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0,0,0));
$dompdf->render();
// $dompdf->stream();
$dompdf->stream("Log_User.pdf", array("Attachment" => false));
// $dompdf->stream('Data_'.$nama.'.pdf');

?>