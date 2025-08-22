<?php
// include '../../../lib/dbh.inc.php';
include '../../../lib/dbh.inc.php';



if ($_GET["action"] === "registerData") {
    // if (!empty($_POST["judul_berita"]) && !empty($_POST["isi"]) && !empty($_POST["status"] && !empty($_POST["tanggal"])) != 0) {
    // $username = mysqli_real_escape_string($koneksi, $_POST["username"]);
    // $password = mysqli_real_escape_string($koneksi, $_POST["password"]);
$username = $_POST['username'] ?? '';
$namalengkap   = $_POST['namalengkap'] ?? '';
$password = $_POST['password'] ?? '';

// Validasi sederhana
if (strlen($username) < 3 || strlen($password) < 6) {
  echo "❌ Username minimal 3 karakter dan password minimal 6 karakter.";
  exit;
}

// Cek apakah username sudah ada
$stmt = $koneksi->prepare("SELECT id FROM user WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
  echo "❌ Username sudah digunakan.";
  exit;
}

// Simpan ke database
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$stmt = $koneksi->prepare("INSERT INTO user (username, nama, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $namalengkap, $hashedPassword);

if ($stmt->execute()) {
  echo "✅ Registrasi berhasil. Silakan login.";
} else {
  echo "❌ Gagal menyimpan data.";
}


} else {
    // echo '<script language="javascript">
    // 		 window.alert("LOGIN GAGAL! Silakan coba lagi");
    // 		 window.location.href="./";
    // 	  </script>';
}

