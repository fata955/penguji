<?php
session_start();
$user = $_SESSION['username'];
include '../../lib/dbh.inc.php';

header('Content-Type: application/json'); // respons JSON

$targetDir = __DIR__ . "/uploads/";
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

$fileName = $_POST['fileName'];
$nomor    = $_POST['nomorspm'];
$id       = $_POST['id'];

$cek = mysqli_query($koneksi, "SELECT nomor_spm,tanggal_spm,jenis,id_skpd FROM tspm WHERE id_spm=$id");
$data = mysqli_fetch_assoc($cek);

$spm     = htmlspecialchars($data['nomor_spm']);
$tanggal = htmlspecialchars($data['tanggal_spm']);
$jenis   = htmlspecialchars($data['jenis']);
$skpd    = htmlspecialchars($data['id_skpd']);

$index    = intval($_POST['index']);
$total    = intval($_POST['total']);

$tmpName   = $_FILES['chunk']['tmp_name'];
$chunkData = file_get_contents($tmpName);

// Simpan chunk sementara
$chunkFile = $targetDir . $fileName . ".part" . $index;
file_put_contents($chunkFile, $chunkData);

// Jika semua chunk sudah terkirim, gabungkan
$allUploaded = true;
for ($i = 0; $i < $total; $i++) {
    if (!file_exists($targetDir . $fileName . ".part" . $i)) {
        $allUploaded = false;
        break;
    }
}

$response = [];

if ($allUploaded) {
    $ext = pathinfo($_POST['fileName'], PATHINFO_EXTENSION);

    // --- PARSING NOMOR SPM ---
    $parts = explode("/", $nomor);
    $safeNomor = "";
    if (isset($parts[2]) && isset($parts[3]) && isset($parts[4])) {
        $safeNomor = $parts[2] . "_" . $parts[3] . "_" . $parts[4];
    } else {
        $safeNomor = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $nomor);
    }

    $newName   = $safeNomor . "." . $ext;
    $finalFile = $targetDir . $newName;

    if (file_exists($finalFile)) {
        $response['warning'] = "File '$newName' sudah ada dan akan ditimpa.";
        unlink($finalFile);
    }

    // Gabungkan semua chunk
    for ($i = 0; $i < $total; $i++) {
        $chunkFile = $targetDir . $fileName . ".part" . $i;
        file_put_contents($finalFile, file_get_contents($chunkFile), FILE_APPEND);
        unlink($chunkFile);
    }

    // --- UPDATE nama berkas di database ---
    $update = mysqli_query($koneksi, "UPDATE tspmsub SET berkas='$newName' WHERE id_spm=$id");

    if ($update) {
        $response['status'] = "success";
        $response['message'] = "File '$newName' berhasil digabungkan dan database diperbarui.";
    } else {
        $response['status'] = "error";
        $response['message'] = "File berhasil digabungkan, tapi gagal update database: " . mysqli_error($koneksi);
    }

    $response['fileUrl'] = "http://localhost/proses/berkas/uploads/" . $newName;
    $response['viewMode'] = "view"; // frontend bisa tampilkan tombol View Berkas
} else {
    $response['status'] = "partial";
    $response['message'] = "Part $index berhasil diupload.";
    $response['viewMode'] = "upload"; // masih proses upload
}

mysqli_close($koneksi);

echo json_encode($response);
