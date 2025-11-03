<?php
// include '../../../lib/dbh.inc.php';

$bulan = array(
  '01' => 'JANUARI',
  '02' => 'FEBRUARI',
  '03' => 'MARET',
  '04' => 'APRIL',
  '05' => 'MEI',
  '06' => 'JUNI',
  '07' => 'JULI',
  '08' => 'AGUSTUS',
  '09' => 'SEPTEMBER',
  '10' => 'OKTOBER',
  '11' => 'NOVEMBER',
  '12' => 'DESEMBER',
);

$tanggal = date('d') . ' ' . (strtolower($bulan[date('m')])) . ' ' . date('Y');
$datew = date('Y-m-d');



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
  $sql = "SELECT a.id,a.nomor,(select sum(c.nilai_sp2d) from tb_control b, sp2d c where a.nomor=b.id_penguji AND b.id_sp2d=c.idhalaman AND c.status=3) as nilai,(select COUNT(c.nomor_sp2d) from tb_control b, sp2d c where a.nomor=b.id_penguji AND b.id_sp2d=c.idhalaman AND c.status=3 ) as count FROM tb_penguji a ORDER BY a.id DESC";
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

  $sql = "SELECT a.id,a.nomor_sp2d,a.nama_skpd,a.keterangan_sp2d,a.nilai_sp2d,a.tanggal_sp2d,(select sum(b.nilai) as potongan from potongan b where a.idhalaman=b.id_sp2d) as potongan FROM sp2d a where a.status='1' AND id_user='0' AND a.keterangan_sp2d like '%$data%' OR a.nilai_sp2d like '%$data%' OR a.nomor_sp2d like '%$data%' OR a.nama_skpd like '%$data%' AND status='1' ";
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
      $input = mysqli_query($koneksi, "INSERT INTO tb_penguji (nomor,pejabat,tanggal,status,user)value('$nomordipake','FADHILA YUNUS','$datew','aktif','$user')");
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
  $tahun = date('Y');
  // $tanggal = date('d-M-Y');
  $sql = mysqli_fetch_row(mysqli_query($koneksi, "SELECT * FROM tb_penguji where nomor=$id"));
  // $row = mysqli_fetch_row($sql);
  if ($sql != null) {
    $sql = mysqli_query($koneksi, "SELECT a.nomor,a.pejabat,a.tanggal,a.user,b.id_sp2d,c.keterangan_sp2d,c.no_rek_pihak_ketiga,c.bank_pihak_ketiga as nomor_rekening,c.nomor_sp2d,c.tanggal_sp2d,c.nama_skpd,c.nilai_sp2d, (select sum(d.nilai) from belanja d where d.id_sp2d=c.idhalaman AND d.uraian like '%belanja%') as belanja, (select sum(e.nilai) from potongan e where e.id_sp2d=c.idhalaman) as potongan,(select sum(d.nilai) from belanja d where d.id_sp2d=c.idhalaman AND d.uraian like '%belanja%') - (select sum(e.nilai) from potongan e where e.id_sp2d=c.idhalaman) as netto, (select sum(a.nilai_sp2d) from sp2d a, tb_control b where b.id_sp2d=a.idhalaman AND b.id_penguji=$id) as totalsp2d from tb_penguji a, tb_control b, sp2d c where a.nomor=$id AND id_penguji=$id AND b.id_sp2d=c.idhalaman");
    $tanggalpenguji = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tb_penguji where nomor=$id"));
    $tanggalpenguji = $tanggalpenguji['tanggal'];
    $no = 1;

    require_once('../../assets/tcpdf/tcpdf.php');
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Fatahillah');
    $pdf->SetTitle('Daftar Penguji');
    $pdf->SetSubject('Pemerintah Kota Palu');
    $pdf->SetKeywords('Pemerintah Kota Palu');

    // $data1 = mysqli_fetch_array($sql);
    //  $data1       = date($data1['tanggal']);
    $pdf->setPrintHeader(false);
    $pdf->AddPage('L', 'cm', 'F4');
    $pdf->SetFont('', 'B', 8);
    $pdf->Image('../../palu1.jpg', 10, 10, 14, 15, 'JPG', '', '', true, 50, '', false, false, '', false, false, false);
    $pdf->Cell(277, 1, "PEMERINTAH KOTA PALU", 0, 1, 'C');
    $pdf->Cell(277, 1, "DAFTAR PENGUJI", 0, 1, 'C');
    $pdf->Cell(277, 1, "Nomor : 00$id/MANDIRI/BPKAD/$tahun : Tanggal : $tanggalpenguji  ", 0, 1, 'C');
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
      $tanggalsp2d = substr($data['tanggal_sp2d'], 0, 10);
      $pdf->Cell(7, 8, $no, 1, 0, 'C');
      $pdf->Cell(16, 8, "2025-09-09", 1, 0);
      $pdf->Cell(68, 8, $data['nomor_sp2d'], 1, 0);
      $pdf->Cell(25, 8, rupiah($data['belanja']), 1, 0, 'C');
      $pdf->Cell(25, 8, rupiah($data['potongan']), 1, 0, 'C');
      $pdf->Cell(25, 8, rupiah($data['netto']), 1, 0, 'C');
      $pdf->Cell(90, 8, $data['nama_skpd'], 1, 0);
      $pdf->Cell(25, 8, $data['bank_pihak_ketiga'], 1, 1);
      // $pdf->Cell(120,8,$data->nomor_sp2d,1,0);
      // $pdf->Cell(37,8,$data->nilai_sp2d,1,1);
    }
    $sql4 = mysqli_query($koneksi, "SELECT (select sum(a.nilai_sp2d) from sp2d a, tb_control b where b.id_sp2d=a.idhalaman AND b.id_penguji=$id) as totalsp2d, (select sum(e.nilai) from potongan e, tb_control b where b.id_sp2d=e.id_sp2d AND b.id_penguji=$id) as totalpotongan, sum((select sum(d.nilai) from belanja d where d.id_sp2d=c.idhalaman AND d.uraian like '%belanja%') - (select sum(e.nilai) from potongan e where e.id_sp2d=c.idhalaman)) as totalnetto from tb_penguji a, tb_control b, sp2d c where a.nomor=$id AND id_penguji=$id AND b.id_sp2d=c.idhalaman");

    $data2 = mysqli_fetch_array($sql4);
    $pdf->SetFont('times', 'B', 10);
    $pdf->Cell(7, 8, "", 1, 0, 'C');
    $pdf->Cell(16, 8, "", 1, 0, 'C');
    $pdf->Cell(68, 8, "TOTAL", 1, 0, 'C');
    $pdf->Cell(25, 8, rupiah($data2['totalsp2d']), 1, 0, 'C');
    $pdf->Cell(25, 8, rupiah($data2['totalpotongan']), 1, 0, 'C');
    $pdf->Cell(25, 8, rupiah($data2['totalnetto']), 1, 0, 'C');
    $pdf->Cell(90, 8, "", 1, 0, 'C');
    $pdf->Cell(25, 8, "", 1, 1, 'C');
    $nilaisp2dsampaihariini = mysqli_fetch_array(mysqli_query($koneksi, "SELECT sum(a.nilai_sp2d) as nilai_total from sp2d a where status=$id"));
    $nilaisp2dsampaipengujiini = mysqli_fetch_array(mysqli_query($koneksi, "SELECT sum(a.nilai_sp2d) as sampaipengujiini from sp2d a, tb_control b where b.id_sp2d=a.idhalaman AND b.id_penguji<$id "));
    $satu = $nilaisp2dsampaipengujiini['sampaipengujiini'];
    $dua = $data2['totalsp2d'];
    $tiga = $satu + $dua;
    $tiga = rupiah($tiga);
    $nilainyapengujisebelumnya = rupiah($nilaisp2dsampaipengujiini['sampaipengujiini']);
    // $nilaihinggasekarang = $nilainya+ $nilainyapengujisebelumnya;
    // $nilaihinggasekarang = $nilaisp2dsampaipengujiini['sampaipengujiini'] + $nilaisp2dsampaihariini['nilai_total'];
    // $nilaihinggasekarang = rupiah($nilaihinggasekarang);  
    $totalsp2d = rupiah($data2['totalsp2d']);
    // $nilaisp2dsampaihariini = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT sum(a.nilai_sp2d) as nilai_total from sp2d a where status=3 AND "));


    $pdf->Ln(2);
    $pdf->SetFont('times', '', 8);
    $pdf->Cell(50, 1, "Total SP2D S/D Daftar Penguji Yang Lalu  ", 0, 0, 'L');
    $pdf->Cell(2, 1, ":", 0, 0, 'L');
    $pdf->Cell(20, 1, "$nilainyapengujisebelumnya", 0, 1, 'R');
    $pdf->Cell(50, 1, "Total SP2D Daftar Penguji Ini", 0, 0, 'L');
    $pdf->Cell(2, 1, ":", 0, 0, 'L');
    $pdf->Cell(20, 1, "$totalsp2d", 0, 1, 'R');
    $pdf->Cell(50, 1, "Total SP2D S/D Daftar penguji Ini ", 0, 0, 'L');
    $pdf->Cell(2, 1, ":", 0, 0, 'L');
    $pdf->Cell(20, 1, "$tiga", 0, 1, 'R');


    $pdf->Cell(7, 8, "", 0, 0, 'C');
    $pdf->Cell(18, 8, "", 0, 0, 'C');
    $pdf->Cell(68, 8, "Mengetahui", 0, 0, 'C');
    $pdf->Cell(20, 8, "", 0, 0, 'C');
    $pdf->Cell(20, 8, "", 0, 0, 'C');
    $pdf->Cell(20, 8, "", 0, 0, 'C');
    $pdf->Cell(90, 8, "Palu, $tanggal,", 0, 0, 'C');
    $pdf->Cell(30, 8, "", 0, 1, 'C');
    $pdf->Ln(-1);
    $pdf->Cell(7, 8, "", 0, 0, 'C');
    $pdf->Cell(18, 8, "", 0, 0, 'C');
    $pdf->Cell(68, 8, "", 0, 0, 'C');
    $pdf->Cell(20, 8, "", 0, 0, 'C');
    $pdf->Cell(20, 8, "", 0, 0, 'C');
    $pdf->Cell(20, 8, "", 0, 0, 'C');
    $pdf->Cell(90, 8, "Kuasa Bendahara Umum Daerah Kota Palu", 0, 0, 'C');
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

    $pdf->Output('daftarpenguji.pdf', 'I');
  } else {
    echo "DATA TIDAK DITEMUKAN";
  }
}
