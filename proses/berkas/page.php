<?php
session_start();
$user = $_SESSION['username'];
include '../../lib/dbh.inc.php';



if ($_GET["action"] === "fetchData") {
  $sql = "SELECT * from skpd";
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

if ($_GET["action"] === "searchopd") {
  $data = $_POST["dsearch"];
  $sql = " SELECT * FROM skpd where nama_opd like '%$data%'           
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

?>