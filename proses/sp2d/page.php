<?php
// include '../../../lib/dbh.inc.php';
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
if ($_GET["action"] === "cetakproduct"){
require_once('../../assets/tcpdf/tcpdf.php');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Programming di Rumahrafif');
$pdf->SetTitle('Data Customer');
$pdf->SetSubject('Data Customer');
$pdf->SetKeywords('Data Customer');

$pdf->SetFont('times', '', 11, '', true);

$pdf->setPrintHeader(false);

$pdf->AddPage('L','F4');

$html = file_get_contents("http://localhost/report/tes.php");

$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('Data Customer.pdf', 'I');
}



if ($_GET["action"] === "cetakpenguji") {
  $id = $_GET["id"];

  require_once('../../assets/tcpdf/tcpdf.php');
  $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

  $pdf->setCreator(PDF_CREATOR);
  $pdf->setAuthor('Aplikasi daftar Penguji');
  $pdf->setTitle('DataPenguji');
  $pdf->setSubject('Data Penguji');
  $pdf->setKeywords('Data Penguji');

  $pdf->setFont('times', '', 11, '', true);
  // $pdf->SetMargins(15, 20, 15);

  $pdf->AddPAge('L','F4');
  $html = '<div style="text-align:center;line-height:7px"><h3>PEMERINTAH KOTA PALU</h3>
                <h3>DAFTAR PENGUJI</h3>
                <h5>Nomor :000'.$id. 'Tanggal :</h5></div>';
  $html .= '<div style="text-align:left;line-height:7px"><h3>Bank</h3>
          <h3>No Rekening</h3>
          </div>';
$pdf->writeHTML($html, true, false, true, false, '');
  $pdf->Ln(1);
		$pdf->SetFont('',12);
		$pdf->Cell(13,8,"No",1,0,'C');
		$pdf->Cell(60,8,"Nama",1,3,'C');
    


  $html .= '
      <?php
// session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Penguji</title>
</head>

<body>

    <!-- 
    <style>
        .cop {
            justify-items: center;
            line-height: 8px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            /* height: 10px; */
            /* height:10px; */
            height: min-content;
            line-height: 8px;
            font-size: 8px;
        }

        table,
        th,
        td {
            border: 1px solid black;

        }

        th,
        td {
            padding: 10px;

        }

        th {
            /* background-color: rgb(19, 110, 170); */
            background-color: rgb(90, 150, 170);
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
    <style type="text/css">
        .tg {
            border-collapse: collapse;
            border-spacing: 0;
            line-height: 20px;
            text-align: center;
            vertical-align: middle;
            border-style: solid;
            width: 100%;
        }

        .tg td {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: times, sans-serif;
            font-size: 8px;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg th {
            border-color: black;
            border-style: solid;
          
            border-width: 1px;
            font-family: times, sans-serif;
            font-size: 8px;
            font-weight: normal;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg .tg-c3ow {
            text-align: center;
            vertical-align: top;
            
        }

        .tg .tg-0pky {
            text-align: center;
            vertical-align: top
        }

        .tg .tg-0lax {
            text-align: center;
            vertical-align: top
        }
    </style> -->
    <style>
        th {
            background-color: #dedede;
            color: #333333;
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 8px;
        }

        tr {
            text-align: center;
            line-height: 12px;
        }

        .tbrekap {
            text-align: left;
        }
    </style>


    <table border="1">
        <thead>
            <tr>
                <th rowspan="2" style="width: 2%">No</th>
                <th rowspan="2" style="width: 8%">Tanggal</th>
                <th rowspan="2" style="width: 22%">Nomor Sp2d</th>
                <th rowspan="2">Brutto</th>
                <th colspan="3">Potongan</th>
                <th rowspan="2">Netto</th>
                <th rowspan="2">OPD</th>
                <th rowspan="2">No Rekening</th>
            </tr>
            <tr>
                <th style="">PPN</th>
                <th style="">PPh</th>
                <th style="">Lainnya</th>
            </tr>
        </thead>
        <tbody>
            <tr>'.
            $id = $_GET['id'];
            $sql1       = "SELECT a.nomor,a.pejabat,a.tanggal,a.user,b.id_sp2d,c.keterangan_sp2d,c.nomor_rekening,c.nomor_sp2d,c.tanggal_sp2d,c.nama_skpd,c.nilai_sp2d, (select sum(d.nilai) from belanja d where d.id_sp2d=c.idhalaman AND d.uraian like '%belanja%') as belanja, (select sum(e.nilai) from potongan e where e.id_sp2d=c.idhalaman) as potongan,(select sum(d.nilai) from belanja d where d.id_sp2d=c.idhalaman AND d.uraian like '%belanja%') - (select sum(e.nilai) from potongan e where e.id_sp2d=c.idhalaman) as netto from tb_penguji a, tb_control b, sp2d c where a.nomor=$id AND id_penguji=$id AND b.id_sp2d=c.idhalaman;";
            $q1         = mysqli_query($koneksi, $sql1);
                $no = 0;
                while ($q2 = mysqli_fetch_array($q1)){ '<td style="width: 2%">'.$no;'</td>
                <td style="width: 8%">'.$q2["tanggal_sp2d"];'</td>
                <td style="width: 22%">'.$q2['nomor_sp2d'];'</td>
                <td>'.$q2['nilai_sp2d'];'</td>
                <td>'.$q2['potongan'];'</td>
                <td></td>
                <td></td>
                <td>'.$q2['netto'];'</td>
                <td>'.$q2['nama_skpd'];'</td>
                <td>'.$q2['nomor_rekening'];'</td>
                '. 
                $no++;}
                '
            </tr>
        </tbody>
    </table>
    <br>
    <br>

    <table class="tbrekap" style="text-align:left">
        <tr>
            <td style="width:200px">Total SP2D S/D DAFTAR PENGUJI YANG LALU</td>
            <td style="width:10px">:</td>
            <td style="width:200px">Rp. 2.000.000</td>
        </tr>
        <tr>
            <td style="width:200px">Total SP2D DAFTAR PENGUJI INI</td>
            <td style="width:10px">:</td>
            <td style="width:200px">Rp. 2.000.000</td>
        </tr>
        <tr>
            <td>Total SP2D S/D DAFTAR PENGUJI INI</td>
            <td>:</td>
            <td>Rp. 2.000.000</td>
        </tr>
    </table>

    <br><br>
    <table style="text-align:center">
        <tr>
            <td>Mengetahui,<br><br><br><br><br>Nip.
            </td>
            <td>Mengetahui,<br>Kuasa Bendahara Umum Daerah Kota Palu<br><br><br><br><br>FADHILA,SE<br>Nip.19791113 200804 2 001
            </td>
        </tr>

    </table>

</body>

</html>
  ';
  // $html .= file_get_contents("../../report/daftarpenguji.php");
  // $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
  // $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
  


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
