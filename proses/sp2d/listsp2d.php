<?php
session_start();
$user = $_SESSION['username'];
include '../../lib/dbh.inc.php';


if ($_GET["action"] === "fetchData") {
  $sql = "SELECT a.nomor_spm,a.keterangan_spm,a.nilai_spm,a.jenis,b.status_berkas,b.id_sp2d,c.id_penguji as nomorpenguji, (select COALESCE(sum(d.nilai),0) from potongan d where d.id_spm=a.id_spm) as potongan  FROM tspm a, tspmsub b, tb_control c where a.id_spm=b.id_spm AND status_berkas>0 AND c.id_sp2d=b.id_spm";
  $result = mysqli_query($koneksi, $sql);
  $data = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
  mysqli_close($koneksi);
  header('Content-Type: application/json');
  echo json_encode([
    "data" => $data
  ]);
}


if ($_GET["action"] === "cariData") {
  $sp2d  = $_POST['sp2d'];
  // $jenis = trim($_POST['jenis'] ?? '');

  $sql = "SELECT a.nomor_spm,a.keterangan_spm,a.nilai_spm,a.jenis,b.status_berkas,b.id_sp2d,c.id_penguji as nomorpenguji, (select COALESCE(sum(d.nilai),0) from potongan d where d.id_spm=a.id_spm) as potongan  FROM tspm a, tspmsub b, tb_control c where a.id_spm=b.id_spm AND status_berkas>0 AND c.id_sp2d=b.id_spm AND a.nomor_spm LIKE '%$sp2d%'";
  
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
  // $types = '';
  // $params = [];

  // if ($sp2d !== '') {
  //   $sql .= " AND a.nomor_spm LIKE ?";
  //   $types .= 's';
  //   $params[] = "%$sp2d%";
  // }
  // // if ($jenis !== '') {
  // //   $sql .= " AND a.jenis LIKE ?";
  // //   $types .= 's';
  // //   $params[] = "%$jenis%";
  // // }

  // // $sql .= " ORDER BY tanggal DESC LIMIT 50";

  // $stmt = $koneksi->prepare($sql);
  // if ($types !== '') {
  //   $stmt->bind_param($types, ...$params);
  // }
  // $stmt->execute();
  // $data = $stmt->get_result();


  // header('Content-Type: application/json');
  // echo json_encode($data);
}
