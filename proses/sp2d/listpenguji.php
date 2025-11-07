<?php
session_start();
$user = $_SESSION['username'];
include '../../lib/dbh.inc.php';




if ($_GET["action"] === "fetchData") {
  $sql = "SELECT a.id,a.nomor,a.pejabat,a.tanggal,(select sum(c.nilai_spm) from tb_control b, tspm c, tspmsub d where a.nomor=b.id_penguji AND b.id_sp2d=c.id_spm AND c.id_spm=d.id_spm AND d.statuspenguji=3) as nilai,(select COUNT(c.nomor_spm) from tb_control b, tspm c, tspmsub d where c.id_spm=d.id_spm AND a.nomor=b.id_penguji AND b.id_sp2d=c.id_spm AND d.statuspenguji=3 ) as count FROM tb_penguji a ORDER BY a.id DESC ";
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
    if ($keyword) $where[] = "id_sp2d LIKE '%$keyword%'";
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
