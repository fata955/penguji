<?php

session_start();
$user = $_SESSION['username'];
include '../../lib/dbh.inc.php';

$targetDir = __DIR__ . "/uploads/";
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

$fileName = $_POST['fileName'];
$id = $_POST['id'];


$cek = mysqli_query($koneksi, "SELECT nomor_spm,tanggal_spm,jenis,id_skpd FROM tspm where id_spm=$id");
$data = mysqli_fetch_assoc($cek);

$spm = htmlspecialchars($data['nomor_spm']);
$tanggal = htmlspecialchars($data['tanggal_spm']);
$jenis = htmlspecialchars($data['jenis']);
$skpd = htmlspecialchars($data['id_skpd']);

$index    = intval($_POST['index']);
$total    = intval($_POST['total']);

$tmpName  = $_FILES['chunk']['tmp_name'];
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

if ($allUploaded) {
    $finalFile = $targetDir . $fileName;
    if (file_exists($finalFile)) unlink($finalFile);

    // Gabungkan semua chunk
    for ($i = 0; $i < $total; $i++) {
        $chunkFile = $targetDir . $fileName . ".part" . $i;
        file_put_contents($finalFile, file_get_contents($chunkFile), FILE_APPEND);
        unlink($chunkFile); // hapus chunk setelah digabung
    }
    echo "Upload selesai: " . htmlspecialchars($fileName);
} else {
    echo "Part $index berhasil diupload.";
}

mysqli_close($koneksi);
