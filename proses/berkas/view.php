<?php
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
?>