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


  $sp2d = $_POST['sp2d'] ?? '';
  $jenis = $_POST['jenis'] ?? '';
  $statusberkas= $_POST['status'] ?? '';

  // Query dengan prepared statement
  $sql = "
SELECT 
a.nomor_spm,
a.keterangan_spm,
a.nilai_spm,
a.jenis,
b.status_berkas,
b.id_sp2d,
c.id_penguji as nomorpenguji, 
(select COALESCE(sum(d.nilai),0) from potongan d where d.id_spm=a.id_spm) as potongan 
FROM 
tspm a, 
tspmsub b, 
tb_control c 
where 
a.id_spm=b.id_spm 
AND status_berkas>0 
AND c.id_sp2d=b.id_spm 
AND a.nomor_spm
  AND a.nomor_spm LIKE ?
  AND a.jenis LIKE ?
  AND b.status_berkas LIKE ?
";

  // Eksekusi query
  $stmt = $koneksi->prepare($sql);
  $param_sp2d = "%$sp2d%";
  $param_jenis = "%$jenis%";
  $param_statusberkas = "%$statusberkas%";
  $stmt->bind_param("sss", $param_sp2d, $param_jenis, $param_statusberkas);
  $stmt->execute();
  $result = $stmt->get_result();
  while ($row = mysqli_fetch_assoc($result)) {
      $data[] = $row;
    }
    $count = mysqli_num_rows($result);
  if ($count < 1) {
   header('Content-Type: application/json');
    echo json_encode([
      "message" => "Data Tidak Ditemukan"
    ]);
    
  } else {
     
    header('Content-Type: application/json');
    echo json_encode([
      "data" => $data
    ]);
  }
  $stmt->close();
  $koneksi->close();





  // $sp2d  = $_POST['sp2d'];
  // $jenis  = $_POST['jenis'];

  // $sql = "SELECT a.nomor_spm,a.keterangan_spm,a.nilai_spm,a.jenis,b.status_berkas,b.id_sp2d,c.id_penguji as nomorpenguji, (select COALESCE(sum(d.nilai),0) from potongan d where d.id_spm=a.id_spm) as potongan  FROM tspm a, tspmsub b, tb_control c where a.id_spm=b.id_spm AND status_berkas>0 AND c.id_sp2d=b.id_spm AND a.nomor_spm LIKE '%$sp2d%' AND a.jenis LIKE '%$jenis%'";

  // $result = mysqli_query($koneksi, $sql);
  // $data = [];
  // while ($row = mysqli_fetch_assoc($result)) {
  //   $data[] = $row;
  // }
  // mysqli_close($koneksi);
  // header('Content-Type: application/json');
  // echo json_encode([
  //   "data" => $data
  // ]);

}
