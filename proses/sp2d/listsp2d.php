<?php
session_start();
$user = $_SESSION['username'];
include '../../lib/dbh.inc.php';




if ($_GET["action"] === "fetchData") {
  $sql = "SELECT a.nomor_spm,a.keterangan_spm,a.nilai_spm,a.jenis,b.status_berkas,b.id_sp2d,c.id_penguji as nomorpenguji FROM tspm a, tspmsub b, tb_control c where a.id_spm=b.id_spm AND status_berkas>0 AND c.id_sp2d=b.id_spm";
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

    $keyword = $koneksi->real_escape_string($_POST['sp2d'] ?? '');
    // $jenis = $koneksi->real_escape_string($_POST['jenis'] ?? '');
    // $category = $koneksi->real_escape_string($_POST['status_berkas'] ?? '');
    // $status = $koneksi->real_escape_string($_POST['statuspenguji'] ?? '');
    // $sumberdana = $koneksi->real_escape_string($_POST['sumberdana'] ?? '');
    // $bulan = $koneksi->real_escape_string($_POST['bulan'] ?? '');

    // $year = $koneksi->real_escape_string($_POST['year'] ?? '');


    // Bangun query dinamis
    $where = [];
    if ($keyword) $where[] = "id_spm LIKE '%$keyword%'";
    // if ($location) $where[] = "a.jenis LIKE '%$location%'";
    // if ($category) $where[] = "b.status_berkas = '$category'";
    // if ($status) $where[] = "b.statuspenguji = '$status'";
    // if ($sumberdana) $where[] = "b.id_dana = '$status'";
    // if ($bulan && $year) {
    //     $where[] = "MONTH(a.tanggal_sp2d) = '$bulan' ";
    // } elseif ($bulan) {
    //     $where[] = "MONTH(a.tanggal_sp2d) = '$bulan'";
    // } 


    $sql = "SELECT * FROM tspm";
    if ($where) {
        $sql .= " WHERE " . implode(" AND ", $where);
    }

    $result = $koneksi->query($sql);
    $data = [];

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($data);
}
