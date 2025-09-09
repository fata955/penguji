<?php
// include '../../../lib/dbh.inc.php';
function rupiah($angka)
{

  $hasil_rupiah = "" . number_format($angka, 0, ',', '.');
  return $hasil_rupiah;
}
session_start();
$user = $_SESSION['username'];
include '../../lib/dbh.inc.php';
// require_once('../../assets/tcpdf/tcpdf.php');


if ($_GET["action"] === "fetchData") {
  $sql = "SELECT a.id,a.nomor_sp2d,a.nama_skpd,a.keterangan_sp2d,a.nilai_sp2d,a.tanggal_sp2d,(select sum(b.nilai) as potongan from potongan b where a.idhalaman=b.id_sp2d) as potongan FROM sp2d a where a.status='1'";
  $result = mysqli_query($koneksi, $sql);
  $data = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
  mysqli_close($koneksi);
  header('Content-Type: application/json');
  echo json_encode([
    "data" => $data
    // "potongan" => $result1
  ]);
}

if ($_GET["action"] === "fetchCart") {
  $sql = "SELECT id,nilai_sp2d,nama_skpd FROM sp2d where status='2' AND id_user='$user' ";
  $result = mysqli_query($koneksi, $sql);
  $sql1 = "SELECT sum(nilai_sp2d) as nilai FROM sp2d where status='2' AND id_user='$user' ";
  $result1 = mysqli_fetch_assoc(mysqli_query($koneksi, $sql1));
  $sql2 = "SELECT * FROM sp2d where status='2' AND id_user='$user' ";
  $jumlah = mysqli_num_rows(mysqli_query($koneksi, $sql2));

  $data = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
  mysqli_close($koneksi);
  header('Content-Type: application/json');
  echo json_encode([
    "data" => $data,
    "total" => $result1,
    "jumlah" => $jumlah
  ]);
}

if ($_GET["action"] === "fetchPenguji") {
  $sql = "SELECT a.id,a.nomor,(select sum(c.nilai_sp2d) from tb_control b, sp2d c where a.nomor=b.id_penguji AND b.id_sp2d=c.idhalaman AND c.status=3) as nilai,(select COUNT(c.nomor_sp2d) from tb_control b, sp2d c where a.nomor=b.id_penguji AND b.id_sp2d=c.idhalaman AND c.status=3 ) as count FROM tb_penguji a order by a.nomor desc";
  $result2 = mysqli_query($koneksi, $sql);
  $data = [];
  while ($row = mysqli_fetch_assoc($result2)) {
    $data[] = $row;
  }
  mysqli_close($koneksi);
  header('Content-Type: application/json');
  echo json_encode([
    "data" => $data
    // "potongan" => $result1
  ]);
}

if ($_GET["action"] === "searchpenguji") {
  $data = $_POST["dsearch"];

  $sql = "SELECT a.id,a.nomor_sp2d,a.nama_skpd,a.keterangan_sp2d,a.nilai_sp2d,a.tanggal_sp2d,(select sum(b.nilai) as potongan from potongan b where a.idhalaman=b.id_sp2d) as potongan FROM sp2d a where a.keterangan_sp2d like '%$data%' OR a.nilai_sp2d like '%$data%' AND a.status='1' AND id_user='0'";
  $result = mysqli_query($koneksi, $sql);
  $data = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
  mysqli_close($koneksi);
  header('Content-Type: application/json');
  echo json_encode([
    "data" => $data
    // "potongan" => $result1
  ]);
}

if ($_GET["action"] === "simpanpenguji") {
  if (!empty($_POST["qty"]) != 0) {
    $tanggal = date("Y-m-d");

    // cek dan buat nomor penguji
    $ceknomorpenguji = mysqli_fetch_array(mysqli_query($koneksi, "SELECT max(nomor) as nourut FROM tb_penguji"));
    $nomor = $ceknomorpenguji['nourut'];
    $nomordipake = $nomor + 1;

    // cek sp2d yg sudah dimasukkan ke list penguji
    $cek = mysqli_query($koneksi, "SELECT id as nosp2d FROM sp2d where status=2 AND id_user='$user'");

    // $value=[];
    $dataada = mysqli_num_rows($cek);
    if ($dataada > 0) {
      $datasp2d = mysqli_fetch_array($cek);
      // $id_sp2d = $datasp2d["nosp2d"];
      $sql = mysqli_query($koneksi, "INSERT INTO tb_control (id_sp2d,id_penguji) SELECT idhalaman, $nomordipake FROM sp2d WHERE status=2 AND id_user='$user'");
      $input = mysqli_query($koneksi, "INSERT INTO tb_penguji (nomor,pejabat,tanggal,status,user)value('$nomordipake','FADHILA YUNUS','$tanggal','aktif','$user')");
      $sql = "UPDATE sp2d SET status='3' where status='2' AND id_user='$user'";
      // header("Content-Type: application/json");
      if (mysqli_query($koneksi, $sql)) {
        echo json_encode([
          "statusCode" => 200,
          "message" => "Data inserted successfully 😀",

        ]);
      } else {
        echo json_encode([
          "statusCode" => 500,
          "message" => "Failed to insert data 😓"
        ]);
      }
    } else {
      echo json_encode([
        "statusCode" => 800,
        "message" => "Tidak Ada Datanya BRO",
        "data" => $datasp2d
      ]);
    }
  } else {
    echo json_encode([
      "statusCode" => 400,
      "message" => "Please fill all the required fields 🙏"
    ]);
  }
}


if ($_GET["action"] === "fetchSingle") {
  $id = $_POST["id"];
  $sql = "UPDATE sp2d SET status='2',id_user='$user' WHERE id='$id'";
  // $result = mysqli_query($koneksi, $sql);
  if (mysqli_query($koneksi, $sql)) {
    // $data = mysqli_fetch_assoc($result);
    // header("Content-Type: application/json");
    echo json_encode([
      "statusCode" => 200,
      "message" => "Data updated successfully 😀"
    ]);
  } else {
    echo json_encode([
      "statusCode" => 404,
      "message" => "No user found with this id 😓"
    ]);
  }
  mysqli_close($koneksi);
}

if ($_GET["action"] === "kembali") {
  $id = $_POST["id"];
  $sql = "UPDATE sp2d SET status='1',id_user='0' WHERE id='$id'";
  // $result = mysqli_query($koneksi, $sql);
  if (mysqli_query($koneksi, $sql)) {
    // $data = mysqli_fetch_assoc($result);
    // header("Content-Type: application/json");
    echo json_encode([
      "statusCode" => 200,
      "message" => "Data updated successfully 😀"
    ]);
  } else {
    echo json_encode([
      "statusCode" => 404,
      "message" => "No user found with this id 😓"
    ]);
  }
  mysqli_close($koneksi);
}


if ($_GET["action"] === "deletepenguji") {
  $id = $_POST["id"];
  $sql = "UPDATE sp2d SET status='1',id_user='0' WHERE id='$id'";
  // $result = mysqli_query($koneksi, $sql);
  if (mysqli_query($koneksi, $sql)) {
    // $data = mysqli_fetch_assoc($result);
    // header("Content-Type: application/json");
    echo json_encode([
      "statusCode" => 200,
      "message" => "Data updated successfully 😀"
    ]);
  } else {
    echo json_encode([
      "statusCode" => 404,
      "message" => "No user found with this id 😓"
    ]);
  }
  mysqli_close($koneksi);
}

if ($_GET["action"] === "cetakpenguji") {
  $id = $_GET["id"];

  $sql = mysqli_query($koneksi, "SELECT a.nomor,a.pejabat,a.tanggal,a.user,b.id_sp2d,c.keterangan_sp2d,c.nomor_rekening,c.nomor_sp2d,c.tanggal_sp2d,c.nama_skpd,c.nilai_sp2d, (select sum(d.nilai) from belanja d where d.id_sp2d=c.idhalaman AND d.uraian like '%belanja%') as belanja, (select sum(e.nilai) from potongan e where e.id_sp2d=c.idhalaman) as potongan,(select sum(d.nilai) from belanja d where d.id_sp2d=c.idhalaman AND d.uraian like '%belanja%') - (select sum(e.nilai) from potongan e where e.id_sp2d=c.idhalaman) as netto, (select sum(a.nilai_sp2d) from sp2d a, tb_control b where b.id_sp2d=a.idhalaman AND b.id_penguji=$id) as totalsp2d from tb_penguji a, tb_control b, sp2d c where a.nomor=$id AND id_penguji=$id AND b.id_sp2d=c.idhalaman");
  $no = 1;

  require_once('../../assets/tcpdf/tcpdf.php');
  $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

  // set document information
  $pdf->SetCreator(PDF_CREATOR);
  $pdf->SetAuthor('Fatahillah');
  $pdf->SetTitle('Daftar Penguji');
  $pdf->SetSubject('Pemerintah Kota Palu');
  $pdf->SetKeywords('Pemerintah Kota pAlu');


  $pdf->setPrintHeader(false);
  $pdf->AddPage('L', 'cm', 'F4');
  $pdf->SetFont('', 'B', 8);
  $pdf->Image('../../palukota.jpg', 10, 10, 14, 15, 'JPG', '', '', true, 50, '', false, false, '', false, false, false);
  $pdf->Cell(277, 1, "PEMERINTAH KOTA PALU", 0, 1, 'C');
  $pdf->Cell(277, 1, "DAFTAR PENGUJI", 0, 1, 'C');
  $pdf->Cell(277, 1, "Nomor", 0, 1, 'C');
  $pdf->Ln(2);
  $html = '<div style="text-align:left;line-height:7px"><h3>Bank : Bank Mandiri</h3>
          <h3>No Rekening : 151-000-000-009-8</h3>
          </div>';
  $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
  $pdf->SetCellPadding(-1);
  $pdf->SetAutoPageBreak(true, 0);


  // Add Header
  $pdf->Ln(1);
  $pdf->SetFont('times', 'B', 8);
  $pdf->Cell(7, 8, "No", 1, 0, 'C');
  $pdf->Cell(16, 8, "Tanggal", 1, 0, 'C');
  $pdf->Cell(68, 8, "No Sp2d", 1, 0, 'C');
  $pdf->Cell(25, 8, "Bruto", 1, 0, 'C');
  $pdf->Cell(25, 8, "Potongan", 1, 0, 'C');
  $pdf->Cell(25, 8, "Netto", 1, 0, 'C');
  $pdf->Cell(90, 8, "Nama OPD", 1, 0, 'C');
  $pdf->Cell(25, 8, "No Rekening / Bank", 1, 1, 'C');

  $pdf->SetFont('times', '', 8);
  // $pegawai = $this->db->get('pegawai')->result();
  $no = 0;
    while ($data = mysqli_fetch_array($sql)) {
      $no++;

      $pdf->Cell(7, 8, $no, 1, 0, 'C');
      $pdf->Cell(16, 8, '20/12/2025', 1, 0);
      $pdf->Cell(68, 8, $data['nomor_sp2d'], 1, 0);
      $pdf->Cell(25, 8, rupiah($data['belanja']), 1, 0, 'C');
      $pdf->Cell(25, 8, rupiah($data['potongan']), 1, 0, 'C');
      $pdf->Cell(25, 8, rupiah($data['netto']), 1, 0, 'C');
      $pdf->Cell(90, 8, $data['nama_skpd'], 1, 0);
      $pdf->Cell(25, 8, $data['nomor_rekening'], 1, 1);
      // $pdf->Cell(120,8,$data->nomor_sp2d,1,0);
      // $pdf->Cell(37,8,$data->nilai_sp2d,1,1);
    }
    $sql = mysqli_query($koneksi, "SELECT (select sum(a.nilai_sp2d) from sp2d a, tb_control b where b.id_sp2d=a.idhalaman AND b.id_penguji=$id) as totalsp2d, (select sum(e.nilai) from potongan e, tb_control b where b.id_sp2d=e.id_sp2d AND b.id_penguji=$id) as totalpotongan, sum((select sum(d.nilai) from belanja d where d.id_sp2d=c.idhalaman AND d.uraian like '%belanja%') - (select sum(e.nilai) from potongan e where e.id_sp2d=c.idhalaman)) as totalnetto from tb_penguji a, tb_control b, sp2d c where a.nomor=$id AND id_penguji=$id AND b.id_sp2d=c.idhalaman");
 
  $data2 = mysqli_fetch_array($sql);
  $pdf->Cell(7, 8, "", 1, 0, 'C');
  $pdf->Cell(16, 8, "", 1, 0, 'C');
  $pdf->Cell(68, 8, "Total", 1, 0, 'C');
  $pdf->Cell(25, 8, rupiah($data2['totalsp2d']), 1, 0, 'C');
  $pdf->Cell(25, 8, rupiah($data2['totalpotongan']), 1, 0, 'C');
  $pdf->Cell(25, 8, rupiah($data2['totalnetto']), 1, 0, 'C');
  $pdf->Cell(90, 8, "", 1, 0, 'C');
  $pdf->Cell(25, 8, "", 1, 1, 'C');
  // $nilaisp2dsampaihariini = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT sum(a.nilai_sp2d) as nilai_total from sp2d a where status=3"));
  // $nilaisp2dsampaihariini = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT sum(a.nilai_sp2d) as nilai_total from sp2d a where status=3 AND "));



  $pdf->SetFont('times', '', 8);
  $pdf->Cell(277, 1, "Total SP2D S/D Daftar Penguji Yang Lalu : ", 0, 1, 'L');
  $pdf->Cell(277, 1, "Total SP2D Daftar Penguji Ini : ", 0, 1, 'L');
  $pdf->Cell(277, 1, "Total SP2D S/D Daftar penguji Ini : ", 0, 1, 'L');
  // $pdf->Output('Laporan-Tcpdf-CodeIgniter.pdf'); 
  // $pdf->ln(120);br

  $pdf->Cell(7, 8, "", 0, 0, 'C');
  $pdf->Cell(18, 8, "", 0, 0, 'C');
  $pdf->Cell(68, 8, "Mengetahui", 0, 0, 'C');
  $pdf->Cell(20, 8, "", 0, 0, 'C');
  $pdf->Cell(20, 8, "", 0, 0, 'C');
  $pdf->Cell(20, 8, "", 0, 0, 'C');
  $pdf->Cell(90, 8, "Palu, 18 Agustus 2025,", 0, 0, 'C');
  $pdf->Cell(30, 8, "", 0, 1, 'C');
  $pdf->Ln(15);

  $pdf->Cell(7, 8, "", 0, 0, 'C');
  $pdf->Cell(18, 8, "", 0, 0, 'C');
  $pdf->Cell(68, 8, "Nip.", 0, 0, 'C');
  $pdf->Cell(20, 8, "", 0, 0, 'C');
  $pdf->Cell(20, 8, "", 0, 0, 'C');
  $pdf->Cell(20, 8, "", 0, 0, 'C');
  $pdf->Cell(90, 8, "Fadhila Yunus,SE,", 0, 0, 'C');
  $pdf->Cell(30, 8, "", 0, 1, 'C');

  // $pdf->setFont('times', '', 11, '', true);
  // $pdf->SetMargins(15, 20, 15);


  // $html = '<div style="text-align:center;line-height:7px"><h3>PEMERINTAH KOTA PALU</h3>
  //               <h3>DAFTAR PENGUJI</h3>
  //               <h5>Nomor :000 Tanggal :</h5></div>';
  // $html .= '<div style="text-align:left;line-height:7px"><h3>Bank</h3>
  //         <h3>No Rekening</h3>
  //         </div>';
  //   $html .= '
  // <table border="1" cellpadding="0" cellspacing="0" nobr="true" style="font-size:8px">
  //  <tr>
  //   <th width="20" rowspan="2" align="center">NO</th>
  //   <th rowspan="2" align="center" width="40">Tanggal</th>
  //   <th rowspan="2" align="center" width="198">No Sp2d</th>
  //   <th width="50" rowspan="2" align="center">Bruto</th>
  //   <th colspan="3" align="center">Potongan</th>
  //   <th rowspan="2" align="center">Netto</th>
  //   <th rowspan="2" align="center">Nama OPD</th>
  //   <th rowspan="2" align="center">No Rekening / Bank </th>
  //  </tr>
  //  <tr>
  //    <th  align="center">PPN</th>
  //    <th  align="center">PPH</th>
  //    <th  align="center">Lainnya</th>
  //   </tr>
  //  <tbody>
  //   <tr align="center">' . 
  //   $id = $_GET['id'];
  //     foreach($q as $row){
  //       echo "<td>1</td>";
  //   }
  //    '';




  // $html .= file_get_contents("../../report/daftarpenguji.php");


  // $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
  // $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
  //  $pdf->writeHTML($html, true, false, true, false, '');

  // $pdf->Ln(1);
  // $pdf->setJPEGQuality(75);
  // $pdf->Image('../assets/images/palu.png', '', '', 40, 40, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
  // $pdf->SetFont('', 12);
  // $pdf->SetCellPadding(2);
  // $pdf->Cell(13, 8, "No", 1, 0, 'C');
  // $pdf->Cell(60, 8, "No Sp2d", 1, 0, 'C');
  // $pdf->Cell(60, 8, "Potongan", 1, 3, 'C');
  // $pdf->Cell(60, 8, "PPN", 1, 0, 'C');
  //  $pdf->Cell(60, 8, "PPH 21", 1, 0, 'C');
  //   $pdf->Cell(60, 8, "Lainnya", 1, 0, 'C');
  //      $pdf->Cell(60, 8, "Lainnya", 1, 1, 'C');
  $pdf->Output('daftarpenguji.pdf', 'I');

  // header("location:http:localhost/report/daftarpenguji.php");


  // $sql = "UPDATE sp2d SET status='1',id_user='0' WHERE id='$id'";
  // // $result = mysqli_query($koneksi, $sql);
  // if (mysqli_query($koneksi, $sql)) {
  //   // $data = mysqli_fetch_assoc($result);
  //   // header("Content-Type: application/json");
  //   echo json_encode([
  //     "statusCode" => 200,
  //     "message" => "Data updated successfully 😀"
  //   ]);
  // } else {
  //   echo json_encode([
  //     "statusCode" => 404,
  //     "message" => "No user found with this id 😓"
  //   ]);
  // }
  // mysqli_close($koneksi);

}
