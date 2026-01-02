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

if ($_GET["action"] === "sumberdana") {
  $sql = " SELECT * FROM t_sumberdana           
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


if ($_GET["action"] === "listspm") {
    $id = $_POST["id"];
    $sql = "
        SELECT 
            a.id_spm,
            a.nomor_spm,
            a.jenis,
            c.nama_opd,
            a.keterangan_spm,
            a.nilai_spm,
            a.tanggal_spm,
            d.berkas,  -- ambil nama file dari database
            COALESCE(e.namasumberdana, '-') AS namasumberdana,
            d.id_dana,
            (
                SELECT COALESCE(SUM(b.nilai), 0)
                FROM potongan b
                WHERE a.id_spm = b.id_spm
            ) AS potongan
        FROM tspm a
        LEFT JOIN tspmsub d ON a.id_spm = d.id_spm
        LEFT JOIN t_sumberdana e ON e.id = d.id_dana
        LEFT JOIN skpd c ON a.id_skpd = c.id_sipd
        WHERE a.id_skpd = $id AND d.id_sp2d = '0';
    ";

    $result = mysqli_query($koneksi, $sql);
    $data = [];

    // base URL untuk akses file dari browser
    $baseUrl = "http://localhost/proses/berkas/uploads/";

    while ($row = mysqli_fetch_assoc($result)) {
        // cek apakah file berkas ada di folder uploads
        $finalFile = __DIR__ . "/uploads/" . $row['berkas'];
        $row['file_exists'] = (!empty($row['berkas']) && file_exists($finalFile));
        $row['file_url']    = (!empty($row['berkas'])) ? $baseUrl . $row['berkas'] : null;

        $data[] = $row;
    }

    mysqli_close($koneksi);
    header('Content-Type: application/json');
    echo json_encode([
        "data" => $data
    ]);
}



if ($_GET["action"] === "updateSd") {
  // header("Content-Type: application/json");

  // $input = json_decode(file_get_contents("php://input"), true);

  // $id_spm  = $input["id_sipd"];
  // $id_dana = $input["id_dana"];
  $id = $_POST['id'];
  $id_dana = $_POST['id_dana'];

  // Jika id_dana kosong, set ke 0
  if ($id_dana == "" || $id_dana == null) {
    $id_dana = 0;
  }

  $sql = "UPDATE tspmsub SET id_dana = ? WHERE id_spm = ?";
  $stmt = $koneksi->prepare($sql);
  $stmt->bind_param("ii", $id_dana, $id);

  if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Sumber dana diperbarui"]);
  } else {
    echo json_encode(["status" => "error", "message" => $stmt->error]);
  }

  mysqli_close($koneksi);
  // header('Content-Type: application/json');
  // echo json_encode([
  //   "data" => $data
  //   // "potongan" => $result1
  // ]);
}
if ($_GET["action"] === "uploadresume") {
  $targetDir = __DIR__ . "/uploads/";
  $fileName  = $_POST['fileName'];

  // Cari chunk terakhir yang sudah ada
  $lastChunk = -1;
  for ($i = 0; $i < 10000; $i++) { // batas aman
    if (file_exists($targetDir . $fileName . ".part" . $i)) {
      $lastChunk = $i;
    } else {
      break;
    }
  }

  echo $lastChunk + 1;
}


if ($_GET["action"] === "uploadberkas") {
  $file = __DIR__ . "/uploads/largefile.pdf";

  if (!file_exists($file)) {
    header("HTTP/1.1 404 Not Found");
    exit;
  }

  $size = filesize($file);
  $length = $size;
  $start = 0;
  $end = $size - 1;

  // Cek apakah ada header Range
  if (isset($_SERVER['HTTP_RANGE'])) {
    $range = $_SERVER['HTTP_RANGE'];
    list(, $range) = explode('=', $range, 2);
    if (strpos($range, ',') !== false) {
      header("HTTP/1.1 416 Requested Range Not Satisfiable");
      exit;
    }
    if ($range == '-') {
      $start = $size - substr($range, 1);
    } else {
      $range = explode('-', $range);
      $start = intval($range[0]);
      $end = ($range[1] !== '') ? intval($range[1]) : $size - 1;
    }
    if ($start > $end || $end >= $size) {
      header("HTTP/1.1 416 Requested Range Not Satisfiable");
      exit;
    }
    $length = $end - $start + 1;
    header("HTTP/1.1 206 Partial Content");
  } else {
    header("HTTP/1.1 200 OK");
  }

  header("Content-Type: application/pdf");
  header("Content-Length: $length");
  header("Accept-Ranges: bytes");
  header("Content-Range: bytes $start-$end/$size");

  $fp = fopen($file, "rb");
  fseek($fp, $start);
  $bufferSize = 8192;
  while (!feof($fp) && ($pos = ftell($fp)) <= $end) {
    if ($pos + $bufferSize > $end) {
      $bufferSize = $end - $pos + 1;
    }
    echo fread($fp, $bufferSize);
    flush();
  }
  fclose($fp);
}
