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

if ($_GET["action"] === "cetakpenguji") {
  // $id = $_POST["id"];

  
  $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

  $pdf->setCreator(PDF_CREATOR);
  $pdf->setAuthor('Aplikasi daftar Penguji');
  $pdf->setTitle('DataPenguji');
  $pdf->setSubject('Data Penguji');
  $pdf->setKeywords('Data Penguji');

  $pdf->setFont('times', '', 11, '', true);
  $pdf->AddPAge();

  $html = file_get_contents("http://localhost/report/daftarpenguji.php",true);
  // $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
  $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

  $pdf->Output('daftarpenguji.pdf', 'I');


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
