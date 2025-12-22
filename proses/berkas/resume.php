<?php
$targetDir = __DIR__ . "/uploads/";
$fileName  = $_POST['fileName'];
$id  = $_POST['id'];

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
?>