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
  $sql = "SELECT 
a.id_spm,
a.nomor_spm,
(select c.nama_opd from skpd c where a.id_skpd=c.id_sipd) as nama_skpd,
a.keterangan_spm,
a.nilai_spm,
a.tanggal_spm,
(select (COALESCE(sum(b.nilai),0)) as potongan from potongan b where a.id_spm=b.id_spm) as potongan
FROM tspm a,tspmsub d where a.id_spm=d.id_spm AND d.statuspenguji='1'";
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
  $sql = "SELECT a.id_spm,a.nilai_spm,c.nama_opd FROM tspm a, tspmsub b, skpd c where a.id_spm=b.id_spm AND a.id_skpd=c.id_sipd AND b.statuspenguji=2 AND b.id_user='$user'";
  $result = mysqli_query($koneksi, $sql);
  $sql1 = "SELECT sum(a.nilai_spm) as nilai FROM tspm a, tspmsub b where a.id_spm=b.id_spm AND b.statuspenguji=2 AND id_user='$user' ";
  $result1 = mysqli_fetch_assoc(mysqli_query($koneksi, $sql1));
  $sql2 = "SELECT * FROM tspmsub where statuspenguji='2' AND id_user='$user' ";
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
  $sql = "SELECT a.id,a.nomor,(select sum(c.nilai_spm) from tb_control b, tspm c, tspmsub d where a.nomor=b.id_penguji AND b.id_sp2d=c.id_spm AND c.id_spm=d.id_spm AND d.statuspenguji=3) as nilai,(select COUNT(c.nomor_spm) from tb_control b, tspm c, tspmsub d where c.id_spm=d.id_spm AND a.nomor=b.id_penguji AND b.id_sp2d=c.id_spm AND d.statuspenguji=3 ) as count FROM tb_penguji a ORDER BY a.id DESC";
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
  $sql = "SELECT 
            a.id_spm,
            a.nomor_spm,
            c.nama_opd,
            a.keterangan_spm,
            a.nilai_spm,
            a.tanggal_spm,
            (select (COALESCE(sum(b.nilai),0)) as potongan from potongan b where a.id_spm=b.id_spm) as potongan
            FROM tspm a,tspmsub d, skpd c where a.id_skpd=c.id_sipd AND a.id_spm=d.id_spm
            AND a.nomor_spm like '%$data%' AND d.id_user='0' AND d.statuspenguji='1' 
            
          ";
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
    $ceknomorpenguji = mysqli_num_rows(mysqli_query($koneksi, "SELECT nomor FROM tb_penguji"));

    if ($ceknomorpenguji == 0) {
      $nomordipake = 455;
    } else {

      $ceknomorpenguji = mysqli_fetch_array(mysqli_query($koneksi, "SELECT max(nomor) as nourut FROM tb_penguji"));
      $nomor = $ceknomorpenguji['nourut'];
      $nomordipake = $nomor + 1;
    }


    // cek sp2d yg sudah dimasukkan ke list penguji
    $cek = mysqli_query($koneksi, "SELECT a.id_spm as nospm FROM tspm a, tspmsub b where a.id_spm=b.id_spm AND b.statuspenguji=2 AND b.id_user='$user'");

    // $value=[];
    $dataada = mysqli_num_rows($cek);
    if ($dataada > 0) {
      $datasp2d = mysqli_fetch_array($cek);
      // $id_sp2d = $datasp2d["nosp2d"];
      $id_sp2d = '0';
      $status = '1';
      $sql = mysqli_query($koneksi, "INSERT INTO tb_control (id_sp2d,id_penguji) SELECT b.id_spm, $nomordipake FROM tspmsub b WHERE b.statuspenguji=2 AND b.id_user='$user'");
      $input = mysqli_query($koneksi, "INSERT INTO tb_penguji (nomor,pejabat,tanggal,status,user)value('$nomordipake','FADHILA YUNUS','$datew','aktif','$user')");
      $sql = "UPDATE tspmsub SET statuspenguji='3' where statuspenguji='2' AND id_user='$user'";
      // header("Content-Type: application/json");
      if (mysqli_query($koneksi, $sql)) {
        $ambilid = mysqli_fetch_array(mysqli_query($koneksi, "SELECT nomor from tb_penguji where user='$user' order by id desc limit 1"));
        $idpenguji = $ambilid['nomor'];
        echo json_encode([
          "statusCode" => 200,
          "message" => "Data inserted successfully 😀",
          "data" => $idpenguji

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
  $status = $_POST["radio_data"];
  $sp2d = $_POST["sp2d"];
  $tanggalsp2d = $_POST["tanggal"];

  $sql = "UPDATE tspmsub SET statuspenguji='2',id_user='$user',status_berkas='$status',id_sp2d=$sp2d,tanggal_sp2d='$tanggalsp2d' WHERE id_spm='$id'";
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
  $sql = "UPDATE tspmsub SET statuspenguji='1',id_user='0' WHERE id_spm='$id'";
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
  $idspm = $_POST["id"];

  // Cek koneksi
  if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
  }


  //?ery dengan 2 kondisi
  $sql = "SELECT id_sp2d as nomor_sp2d FROM tb_control where id_penguji= ? ";

  // Siapkan statement
  $stmt = mysqli_prepare($koneksi, $sql);

  // Bind parameter (dua kali input yang sama)
  mysqli_stmt_bind_param($stmt, "s", $idspm);

  // Eksekusi
  mysqli_stmt_execute($stmt);

  // Ambil hasil
  $result = mysqli_stmt_get_result($stmt);

  // Tampilkan data
  while ($data = mysqli_fetch_assoc($result)) {
    $id_spm = $data['nomor_sp2d'];
    $pindah = mysqli_query($koneksi, "UPDATE tspmsub SET statuspenguji='1', id_user='0' where id_spm='$id_spm' ");
  }

  // Tutup koneksi


  // // Query SELECT
  // $sql = "SELECT id_sp2d as nomor_sp2d FROM tb_control where id_penguji=$idspm";
  // $result = mysqli_query($koneksi, $sql);
  // $row = mysqli_fetch_array($result);
  // foreach ($row as $data){
  //   echo $data;
  // }
  // $data =$row['nomor_sp2d'];
  // Ambil semua data sebagai array
  // $data = [];
  // if (mysqli_num_rows($result) > 0) {
  //   $row = mysqli_fetch_array($result);
  //   foreach ($row as $data) {
  //     $sql1 = "UPDATE tsmpsub SET statuspenguji=1, id_user=0 WHERE id_spm = '.$row.'";
  //     $eksekusi = mysqli_query($koneksi, $sql1);
  //     // var_dump($row[0]);

  //   }
  // }
  $deletepenguji = mysqli_query($koneksi, "DELETE from tb_penguji where nomor=$idspm");
  $deletekontrol = mysqli_query($koneksi, "DELETE FROM tb_control where id_penguji=$idspm");

  // $sql = "UPDATE sp2d SET status='1',id_user='0' WHERE id='$id'";
  // $result = mysqli_query($koneksi, $sql);
  if ($result) {
    // $data = mysqli_fetch_assoc($result);
    // header("Content-Type: application/json");
    echo json_encode([
      "statusCode" => 200,
      "message" => "Data updated successfully 😀",
      "data" => $id_spm
    ]);
  } else {
    echo json_encode([
      "statusCode" => 404,
      "message" => "No user found with this id 😓"
    ]);
  }
  mysqli_stmt_close($stmt);
  mysqli_close($koneksi);
  // mysqli_close($koneksi);
}

if ($_GET["action"] === "cetakpenguji") {
  $id = $_GET["id"];
  $tahun = date('Y');
  // $tanggal = date('d-M-Y');
  $sql = mysqli_fetch_row(mysqli_query($koneksi, "SELECT * FROM tb_penguji where nomor=$id"));
  // $row = mysqli_fetch_row($sql);
  if ($sql != null) {
    $sql = mysqli_query(
      $koneksi,
      "SELECT 
        a.nomor,
        a.pejabat,
        a.tanggal,
        a.user,
        c.keterangan_spm,
        c.no_rek_pihak_ketiga as nomor_rekening,
        c.nomor_spm,
        g.id_sp2d,
        g.tanggal_sp2d,
        g.status_berkas,
        c.tanggal_spm,
        c.nama_rek_pihak_ketiga,
        (select f.nama_rekening from skpd f where c.id_skpd=f.id_sipd) as namarek,
        (select f.no_rekening from skpd f where c.id_skpd=f.id_sipd) as nomorrek,
        c.nilai_spm,
        c.id_spm, 
        (select sum(d.nilai) from belanja d where d.id_spm=c.id_spm AND d.norekening like '%5.%') as belanja, 
        (select sum(e.nilai) from potongan e where e.id_spm=c.id_spm AND e.uraian like '%Pajak Pertambahan%') as ppn,
        (select sum(e.nilai) from potongan e where e.id_spm=c.id_spm AND e.uraian like '%PPH 21%') as pph,
        (select sum(e.nilai) from potongan e where e.id_spm=c.id_spm AND e.uraian != 'PPH 21' AND e.uraian != 'Pajak Pertambahan Nilai') as lainnya,
        c.nilai_spm - (select sum(e.nilai) from potongan e where e.id_spm=c.id_spm) as netto, 
        (select sum(a.nilai_spm) from tspm a, tb_control b where b.id_sp2d=a.id_spm AND b.id_penguji=$id) as totalsp2d 
        from tb_penguji a, tb_control b, tspm c, tspmsub g
        where a.nomor=$id AND 
        id_penguji=$id AND 
        b.id_sp2d=c.id_spm AND
        c.id_spm=g.id_spm;"
    );

    $tanggalpenguji = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tb_penguji where nomor=$id"));
    $tanggalpenguji = $tanggalpenguji['tanggal'];
    $no = 1;

    require_once('../../assets/tcpdf/tcpdf.php');
    // $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf = new TCPDF('L', 'px', 'F4', true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Fatahillah');
    $pdf->SetTitle('Daftar Penguji');
    $pdf->SetSubject('Pemerintah Kota Palu');
    $pdf->SetKeywords('Pemerintah Kota pAlu');

    // $data1 = mysqli_fetch_array($sql);
    //  $data1       = date($data1['tanggal']);
    $pdf->setPrintHeader(false);
    $pdf->SetPrintFooter(false);
    $pdf->SetAutoPageBreak(false, 0);
    // $pdf->AddPage('L', 'cm', 'f4');
    $pdf->AddPage();
    $pdf->SetFont('', 'B', 8);
    $pdf->Image('../../palu1.jpg', 30, 30, 27, 30, 'JPG', '', '', true, 80, '', false, false, '', false, false, false);
    $pdf->Cell(800, 1, "PEMERINTAH KOTA PALU", 0, 1, 'C');
    $pdf->Cell(800, 1, "DAFTAR PENGUJI", 0, 1, 'C');
    $pdf->Cell(800, 1, "Nomor : $id/MANDIRI/BPKAD/$tahun : Tanggal : $tanggalpenguji  ", 0, 1, 'C');
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
    $pdf->Cell(20, 9, "No", 1, 0, 'C');
    $pdf->Cell(42, 8, "Tanggal", 1, 0, 'C');
    $pdf->Cell(187, 8, "No SP2D", 1, 0, 'C');
    $pdf->Cell(70, 8, "Bruto", 1, 0, 'C');
    $pdf->Cell(60, 8, "PPN", 1, 0, 'C');
    $pdf->Cell(60, 8, "PPH", 1, 0, 'C');
    $pdf->Cell(60, 8, "LAINNYA", 1, 0, 'C');
    $pdf->Cell(70, 8, "Netto", 1, 0, 'C');
    $pdf->Cell(210, 8, "Nama OPD", 1, 0, 'C');
    $pdf->Cell(90, 8, "No Rekening / Bank", 1, 1, 'C');

    $pdf->SetFont('times', '', 8);
    // $pegawai = $this->db->get('pegawai')->result();
    $no = 0;


    while ($data = mysqli_fetch_array($sql)) {
      $datasp2d = $data['id_sp2d'];
      $dataspm = $data['nomor_spm'];
      $spm = $data['id_spm'];
      $hitung = mysqli_num_rows(mysqli_query($koneksi, "SELECT idpotongan FROM potongan where id_spm=$spm"));
      $parts = explode("/", $dataspm);

      //hitung total netto 
      



      $no++;
      // $tanggalspm = substr($data['tanggal_spm'], 0, 10);
      // setting tanggal sp2d
      $tanggalsp2d = substr($data['tanggal_sp2d'], 0, 10);
      $timestamp = strtotime($tanggalsp2d);
      $datenya = date('d-m-Y', $timestamp);
      $bulan = date('m', $timestamp);
      $tahun = date('Y', $timestamp);


      $pdf->Cell(20, 8, $no, 1, 0, 'C');
      $pdf->Cell(42, 8, $datenya, 1, 0);
      $pdf->Cell(187, 8, "72.71/04.0/$datasp2d/$parts[3]/$parts[4]/$parts[5]/$bulan/$tahun", 1, 0);
      $pdf->Cell(70, 8, rupiah($data['nilai_spm']), 1, 0, 'R');
      $pdf->Cell(60, 8, rupiah($data['ppn']), 1, 0, 'R');
      $pdf->Cell(60, 8, rupiah($data['pph']), 1, 0, 'R');
      $pdf->Cell(60, 8, rupiah($data['lainnya']), 1, 0, 'R');
      if ($hitung > 0) {
        $pdf->Cell(70, 8, rupiah($data['netto']), 1, 0, 'R');
      } else {
        $pdf->Cell(70, 8, rupiah($data['nilai_spm']), 1, 0, 'R');
      }

      $status = $data['status_berkas'];
      if ($status == 4) {
        $pdf->Cell(210, 8, $data['nama_rek_pihak_ketiga'], 1, 0);
        $pdf->Cell(90, 8, $data['nomor_rekening'], 1, 1, 'C');
      } else {
        $pdf->Cell(210, 8, $data['namarek'], 1, 0);
        $pdf->Cell(90, 8, $data['nomorrek'], 1, 1, 'C');
      }

      // $pdf->Cell(120,8,$data->nomor_sp2d,1,0);
      // $pdf->Cell(37,8,$data->nilai_sp2d,1,1);
    }

    $sql4 = mysqli_query(
      $koneksi,
      " SELECT 
          (select sum(a.nilai_spm) from tspm a, tb_control b where b.id_sp2d=a.id_spm AND b.id_penguji=$id) as totalspm, 
          (select sum(e.nilai) from potongan e, tb_control b where b.id_sp2d=e.id_spm AND b.id_penguji=$id  AND e.uraian  like  '%Pajak Pertambahan Nilai%') as totalppn, 
          (select sum(e.nilai) from potongan e, tb_control b where b.id_sp2d=e.id_spm AND b.id_penguji=$id  AND e.uraian like  '%PPH%') as totalpph, 
          (select sum(e.nilai) from potongan e where e.id_spm=c.id_spm) as totalpotongan,
          (select sum(e.nilai) from potongan e, tb_control b where b.id_sp2d=e.id_spm AND b.id_penguji=$id AND e.uraian != 'PPH 21' AND e.uraian != 'Pajak Pertambahan Nilai') as totallainnya,
          sum((select sum(d.nilai) from belanja d where d.id_spm=c.id_spm AND d.norekening like '%5.1.%') - (select sum(e.nilai) from potongan e where e.id_spm=c.id_spm)) as totalnetto 
          from 
          tb_penguji a, 
          tb_control b, 
          tspm c 
          where 
          a.nomor=$id AND 
          b.id_penguji=$id AND 
          b.id_sp2d=c.id_spm;
      "
    );
    
    $data2 = mysqli_fetch_array($sql4);
    // $totalnetto = $data['belanja'] - $data2['totalpotongan'];
     $totalspm = $data2['totalspm'];
    $totalpotongan = $data2['totalpotongan'];
    $totalnetto = $totalspm - ($data2['totalppn']+$data2['totalpph']+$data2['totallainnya']);

    $pdf->SetFont('times', 'B', 10);
    $pdf->Cell(20, 8, "", 1, 0, 'C');
    $pdf->Cell(42, 8, "", 1, 0, 'C');
    $pdf->Cell(187, 8, "TOTAL", 1, 0, 'C');
    $pdf->Cell(70, 8, rupiah($data2['totalspm']), 1, 0, 'R');
    $pdf->Cell(60, 8, rupiah($data2['totalppn']), 1, 0, 'R');
    $pdf->Cell(60, 8, rupiah($data2['totalpph']), 1, 0, 'R');
    $pdf->Cell(60, 8, rupiah($data2['totallainnya']), 1, 0, 'R');
   

    // $pdf->Cell(21, 8, "", 1, 0, 'C');
    //  $pdf->Cell(21, 8, "", 1, 0, 'C');
    //    $pdf->Cell(21, 8, "", 1, 0, 'C');
     $pdf->Cell(70, 8, rupiah($totalnetto), 1, 0, 'R');
    // $pdf->Cell(70, 8, rupiah($data2['totalnetto']), 1, 0, 'R');
    $pdf->Cell(210, 8, "", 1, 0, 'C');
    $pdf->Cell(90, 8, "", 1, 1, 'C');
    $nilaisp2dsampaihariini = mysqli_fetch_array(mysqli_query($koneksi, "SELECT sum(a.nilai_spm) as nilai_total from tspm a,tspmsub b where b.statuspenguji=$id"));
    $nilaisp2dsampaipengujiini = mysqli_fetch_array(mysqli_query($koneksi, "SELECT sum(a.nilai_spm) as sampaipengujiini from tspm a, tb_control b, tspmsub c where a.id_spm=c.id_spm AND b.id_sp2d=a.id_spm AND b.id_penguji<$id "));
    $satu = $nilaisp2dsampaipengujiini['sampaipengujiini'];
    $dua = $data2['totalspm'];
    $tiga = $satu + $dua;
    $tiga = rupiah($tiga);
    $nilainyapengujisebelumnya = rupiah($nilaisp2dsampaipengujiini['sampaipengujiini']);
    // $nilaihinggasekarang = $nilainya+ $nilainyapengujisebelumnya;
    // $nilaihinggasekarang = $nilaisp2dsampaipengujiini['sampaipengujiini'] + $nilaisp2dsampaihariini['nilai_total'];
    // $nilaihinggasekarang = rupiah($nilaihinggasekarang);  
    $totalspm = rupiah($data2['totalspm']);
    // $nilaisp2dsampaihariini = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT sum(a.nilai_sp2d) as nilai_total from sp2d a where status=3 AND "));


    $pdf->Ln(2);
    $pdf->SetFont('times', '', 8);
    $pdf->Cell(50, 1, "Total SP2D S/D Daftar Penguji Yang Lalu  ", 0, 0, 'L');
    $pdf->Cell(2, 1, ":", 0, 0, 'L');
    $pdf->Cell(200, 1, "$nilainyapengujisebelumnya", 0, 1, 'R');
    $pdf->Cell(50, 1, "Total SP2D Daftar Penguji Ini", 0, 0, 'L');
    $pdf->Cell(2, 1, ":", 0, 0, 'L');
    $pdf->Cell(200, 1, "$totalspm", 0, 1, 'R');
    $pdf->Cell(50, 1, "Total SP2D S/D Daftar penguji Ini ", 0, 0, 'L');
    $pdf->Cell(2, 1, ":", 0, 0, 'L');
    $pdf->Cell(200, 1, "$tiga", 0, 1, 'R');


    $pdf->Ln(10);

    $pdf->Cell(250, 8, "Mengetahui", 0, 0, 'C');
    $pdf->Cell(20, 8, "", 0, 0, 'C');
    $pdf->Cell(20, 8, "", 0, 0, 'C');
    $pdf->Cell(20, 8, "", 0, 0, 'C');
    $pdf->Cell(650, 8, "Palu, $tanggal,", 0, 0, 'C');
    $pdf->Cell(30, 8, "", 0, 1, 'C');
    $pdf->Ln(-1);
    $pdf->Cell(7, 8, "", 0, 0, 'C');
    $pdf->Cell(18, 8, "", 0, 0, 'C');
    $pdf->Cell(68, 8, "", 0, 0, 'C');
    $pdf->Cell(20, 8, "", 0, 0, 'C');
    $pdf->Cell(20, 8, "", 0, 0, 'C');
    $pdf->Cell(20, 8, "", 0, 0, 'C');
    $pdf->Cell(965, 8, "Kuasa Bendahara Umum Daerah Kota Palu", 0, 0, 'C');
    $pdf->Cell(30, 8, "", 0, 1, 'C');
    $pdf->Ln(50);

    $pdf->Cell(7, 8, "", 0, 0, 'C');
    $pdf->Cell(18, 8, "", 0, 0, 'C');
    $pdf->Cell(200, 8, "Nip.", 0, 0, 'C');
    $pdf->Cell(20, 8, "", 0, 0, 'C');
    $pdf->Cell(20, 8, "", 0, 0, 'C');
    $pdf->Cell(20, 8, "", 0, 0, 'C');
    $pdf->Cell(700, 8, "FADHILA,SE,", 0, 0, 'C');
    $pdf->Cell(30, 8, "", 0, 1, 'C');
    $pdf->Cell(1280, 8, "Nip.19791113 200804 2 001", 0, 0, 'C');

    $pdf->Output('daftarpenguji.pdf', 'I');
  } else {
    echo "DATA TIDAK DITEMUKAN";
  }
}

if ($_GET["action"] === "cetakbillyit") {
  $id = $_GET["id"];
  $tahun = date('Y');
  // $tanggal = date('d-M-Y');
  $sql = mysqli_fetch_row(mysqli_query($koneksi, "SELECT * FROM tb_penguji where nomor=$id"));
  // $row = mysqli_fetch_row($sql);
  if ($sql != null) {
    $sql = mysqli_query(
      $koneksi,
      "SELECT 
      a.nama_opd, 
      (SELECT COALESCE(sum(b.nilai_spm),0) from tspm b where b.id_skpd=a.id_sipd) as nilai,  
      (SELECT COALESCE(sum(c.nilai),0) from potongan c where c.id_spm=b.id_spm AND c.uraian like '%PPH 21%') as PPH_21
       FROM 
       skpd a,
       tspm b, 
       potongan c 
       where  
       a.id_sipd=b.id_skpd 
       GROUP by a.nama_opd 
       ORDER BY a.id;"
    );

    $tanggalpenguji = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tb_penguji where nomor=$id"));
    $tanggalpenguji = $tanggalpenguji['tanggal'];
    $no = 1;

    require_once('../../assets/tcpdf/tcpdf.php');
    // $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf = new TCPDF('L', 'px', 'F4', true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Fatahillah');
    $pdf->SetTitle('Daftar Penguji');
    $pdf->SetSubject('Pemerintah Kota Palu');
    $pdf->SetKeywords('Pemerintah Kota pAlu');

    // $data1 = mysqli_fetch_array($sql);
    //  $data1       = date($data1['tanggal']);
    $pdf->setPrintHeader(false);
    $pdf->SetPrintFooter(false);
    $pdf->SetAutoPageBreak(false, 0);
    // $pdf->AddPage('L', 'cm', 'f4');
    $pdf->AddPage();
    $pdf->SetFont('', 'B', 8);
    $pdf->Image('../../palu1.jpg', 30, 30, 27, 30, 'JPG', '', '', true, 80, '', false, false, '', false, false, false);
    $pdf->Cell(800, 1, "PEMERINTAH KOTA PALU", 0, 1, 'C');
    $pdf->Cell(800, 1, "REKAPAN POTONGAN", 0, 1, 'C');
    // $pdf->Cell(800, 1, "Nomor : $id/MANDIRI/BPKAD/$tahun : Tanggal : $tanggalpenguji  ", 0, 1, 'C');
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
    $pdf->Cell(20, 9, "No", 1, 0, 'C');
    $pdf->Cell(42, 8, "Tanggal", 1, 0, 'C');
    $pdf->Cell(187, 8, "No SP2D", 1, 0, 'C');
    $pdf->Cell(70, 8, "Bruto", 1, 0, 'C');
    $pdf->Cell(60, 8, "PPN", 1, 0, 'C');
    $pdf->Cell(60, 8, "PPH", 1, 0, 'C');
    $pdf->Cell(60, 8, "LAINNYA", 1, 0, 'C');
    $pdf->Cell(70, 8, "Netto", 1, 0, 'C');
    $pdf->Cell(210, 8, "Nama OPD", 1, 0, 'C');
    $pdf->Cell(90, 8, "No Rekening / Bank", 1, 1, 'C');

    $pdf->SetFont('times', '', 8);
    // $pegawai = $this->db->get('pegawai')->result();
    $no = 0;


    while ($data = mysqli_fetch_array($sql)) {
      $datasp2d = $data['id_sp2d'];
      $dataspm = $data['nomor_spm'];
      $spm = $data['id_spm'];
      $hitung = mysqli_num_rows(mysqli_query($koneksi, "SELECT idpotongan FROM potongan where id_spm=$spm"));
      $parts = explode("/", $dataspm);

      //hitung total netto 
      



      $no++;
      // $tanggalspm = substr($data['tanggal_spm'], 0, 10);
      // setting tanggal sp2d
      $tanggalsp2d = substr($data['tanggal_sp2d'], 0, 10);
      $timestamp = strtotime($tanggalsp2d);
      $datenya = date('d-m-Y', $timestamp);
      $bulan = date('m', $timestamp);
      $tahun = date('Y', $timestamp);


      $pdf->Cell(20, 8, $no, 1, 0, 'C');
      $pdf->Cell(42, 8, $datenya, 1, 0);
      $pdf->Cell(187, 8, "72.71/04.0/$datasp2d/$parts[3]/$parts[4]/$parts[5]/$bulan/$tahun", 1, 0);
      $pdf->Cell(70, 8, rupiah($data['nilai_spm']), 1, 0, 'R');
      $pdf->Cell(60, 8, rupiah($data['ppn']), 1, 0, 'R');
      $pdf->Cell(60, 8, rupiah($data['pph']), 1, 0, 'R');
      $pdf->Cell(60, 8, rupiah($data['lainnya']), 1, 0, 'R');
      if ($hitung > 0) {
        $pdf->Cell(70, 8, rupiah($data['netto']), 1, 0, 'R');
      } else {
        $pdf->Cell(70, 8, rupiah($data['nilai_spm']), 1, 0, 'R');
      }

      $status = $data['status_berkas'];
      if ($status == 4) {
        $pdf->Cell(210, 8, $data['nama_rek_pihak_ketiga'], 1, 0);
        $pdf->Cell(90, 8, $data['nomor_rekening'], 1, 1, 'C');
      } else {
        $pdf->Cell(210, 8, $data['namarek'], 1, 0);
        $pdf->Cell(90, 8, $data['nomorrek'], 1, 1, 'C');
      }

      // $pdf->Cell(120,8,$data->nomor_sp2d,1,0);
      // $pdf->Cell(37,8,$data->nilai_sp2d,1,1);
    }

    $sql4 = mysqli_query(
      $koneksi,
      " SELECT 
          (select sum(a.nilai_spm) from tspm a, tb_control b where b.id_sp2d=a.id_spm AND b.id_penguji=$id) as totalspm, 
          (select sum(e.nilai) from potongan e, tb_control b where b.id_sp2d=e.id_spm AND b.id_penguji=$id  AND e.uraian  like  '%Pajak Pertambahan Nilai%') as totalppn, 
          (select sum(e.nilai) from potongan e, tb_control b where b.id_sp2d=e.id_spm AND b.id_penguji=$id  AND e.uraian like  '%PPH%') as totalpph, 
          (select sum(e.nilai) from potongan e where e.id_spm=c.id_spm) as totalpotongan,
          (select sum(e.nilai) from potongan e, tb_control b where b.id_sp2d=e.id_spm AND b.id_penguji=$id AND e.uraian != 'PPH 21' AND e.uraian != 'Pajak Pertambahan Nilai') as totallainnya,
          sum((select sum(d.nilai) from belanja d where d.id_spm=c.id_spm AND d.norekening like '%5.1.%') - (select sum(e.nilai) from potongan e where e.id_spm=c.id_spm)) as totalnetto 
          from 
          tb_penguji a, 
          tb_control b, 
          tspm c 
          where 
          a.nomor=$id AND 
          b.id_penguji=$id AND 
          b.id_sp2d=c.id_spm;
      "
    );
    
    $data2 = mysqli_fetch_array($sql4);
    // $totalnetto = $data['belanja'] - $data2['totalpotongan'];
     $totalspm = $data2['totalspm'];
    $totalpotongan = $data2['totalpotongan'];
    $totalnetto = $totalspm - ($data2['totalppn']+$data2['totalpph']+$data2['totallainnya']);

    $pdf->SetFont('times', 'B', 10);
    $pdf->Cell(20, 8, "", 1, 0, 'C');
    $pdf->Cell(42, 8, "", 1, 0, 'C');
    $pdf->Cell(187, 8, "TOTAL", 1, 0, 'C');
    $pdf->Cell(70, 8, rupiah($data2['totalspm']), 1, 0, 'R');
    $pdf->Cell(60, 8, rupiah($data2['totalppn']), 1, 0, 'R');
    $pdf->Cell(60, 8, rupiah($data2['totalpph']), 1, 0, 'R');
    $pdf->Cell(60, 8, rupiah($data2['totallainnya']), 1, 0, 'R');
   

    // $pdf->Cell(21, 8, "", 1, 0, 'C');
    //  $pdf->Cell(21, 8, "", 1, 0, 'C');
    //    $pdf->Cell(21, 8, "", 1, 0, 'C');
     $pdf->Cell(70, 8, rupiah($totalnetto), 1, 0, 'R');
    // $pdf->Cell(70, 8, rupiah($data2['totalnetto']), 1, 0, 'R');
    $pdf->Cell(210, 8, "", 1, 0, 'C');
    $pdf->Cell(90, 8, "", 1, 1, 'C');
    $nilaisp2dsampaihariini = mysqli_fetch_array(mysqli_query($koneksi, "SELECT sum(a.nilai_spm) as nilai_total from tspm a,tspmsub b where b.statuspenguji=$id"));
    $nilaisp2dsampaipengujiini = mysqli_fetch_array(mysqli_query($koneksi, "SELECT sum(a.nilai_spm) as sampaipengujiini from tspm a, tb_control b, tspmsub c where a.id_spm=c.id_spm AND b.id_sp2d=a.id_spm AND b.id_penguji<$id "));
    $satu = $nilaisp2dsampaipengujiini['sampaipengujiini'];
    $dua = $data2['totalspm'];
    $tiga = $satu + $dua;
    $tiga = rupiah($tiga);
    $nilainyapengujisebelumnya = rupiah($nilaisp2dsampaipengujiini['sampaipengujiini']);
    // $nilaihinggasekarang = $nilainya+ $nilainyapengujisebelumnya;
    // $nilaihinggasekarang = $nilaisp2dsampaipengujiini['sampaipengujiini'] + $nilaisp2dsampaihariini['nilai_total'];
    // $nilaihinggasekarang = rupiah($nilaihinggasekarang);  
    $totalspm = rupiah($data2['totalspm']);
    // $nilaisp2dsampaihariini = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT sum(a.nilai_sp2d) as nilai_total from sp2d a where status=3 AND "));


    $pdf->Ln(2);
    $pdf->SetFont('times', '', 8);
    $pdf->Cell(50, 1, "Total SP2D S/D Daftar Penguji Yang Lalu  ", 0, 0, 'L');
    $pdf->Cell(2, 1, ":", 0, 0, 'L');
    $pdf->Cell(200, 1, "$nilainyapengujisebelumnya", 0, 1, 'R');
    $pdf->Cell(50, 1, "Total SP2D Daftar Penguji Ini", 0, 0, 'L');
    $pdf->Cell(2, 1, ":", 0, 0, 'L');
    $pdf->Cell(200, 1, "$totalspm", 0, 1, 'R');
    $pdf->Cell(50, 1, "Total SP2D S/D Daftar penguji Ini ", 0, 0, 'L');
    $pdf->Cell(2, 1, ":", 0, 0, 'L');
    $pdf->Cell(200, 1, "$tiga", 0, 1, 'R');


    $pdf->Ln(10);

    $pdf->Cell(250, 8, "Mengetahui", 0, 0, 'C');
    $pdf->Cell(20, 8, "", 0, 0, 'C');
    $pdf->Cell(20, 8, "", 0, 0, 'C');
    $pdf->Cell(20, 8, "", 0, 0, 'C');
    $pdf->Cell(650, 8, "Palu, $tanggal,", 0, 0, 'C');
    $pdf->Cell(30, 8, "", 0, 1, 'C');
    $pdf->Ln(-1);
    $pdf->Cell(7, 8, "", 0, 0, 'C');
    $pdf->Cell(18, 8, "", 0, 0, 'C');
    $pdf->Cell(68, 8, "", 0, 0, 'C');
    $pdf->Cell(20, 8, "", 0, 0, 'C');
    $pdf->Cell(20, 8, "", 0, 0, 'C');
    $pdf->Cell(20, 8, "", 0, 0, 'C');
    $pdf->Cell(965, 8, "Kuasa Bendahara Umum Daerah Kota Palu", 0, 0, 'C');
    $pdf->Cell(30, 8, "", 0, 1, 'C');
    $pdf->Ln(50);

    $pdf->Cell(7, 8, "", 0, 0, 'C');
    $pdf->Cell(18, 8, "", 0, 0, 'C');
    $pdf->Cell(200, 8, "Nip.", 0, 0, 'C');
    $pdf->Cell(20, 8, "", 0, 0, 'C');
    $pdf->Cell(20, 8, "", 0, 0, 'C');
    $pdf->Cell(20, 8, "", 0, 0, 'C');
    $pdf->Cell(700, 8, "FADHILA,SE,", 0, 0, 'C');
    $pdf->Cell(30, 8, "", 0, 1, 'C');
    $pdf->Cell(1280, 8, "Nip.19791113 200804 2 001", 0, 0, 'C');

    $pdf->Output('daftarpenguji.pdf', 'I');
  } else {
    echo "DATA TIDAK DITEMUKAN";
  }
}

