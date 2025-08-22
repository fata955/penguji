<?php
session_start();
// include '../../../lib/dbh.inc.php';
include '../../lib/dbh.inc.php';



if ($_GET["action"] === "loginData") {
    // if (!empty($_POST["judul_berita"]) && !empty($_POST["isi"]) && !empty($_POST["status"] && !empty($_POST["tanggal"])) != 0) {
    // $username = mysqli_real_escape_string($koneksi, $_POST["username"]);
    // $password = mysqli_real_escape_string($koneksi, $_POST["password"]);



$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Cek user di database
$stmt = $koneksi->prepare("SELECT * FROM user WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
  if (password_verify($password, $row['password'])) {
    $_SESSION['username'] = $username;
    session_regenerate_id(); // Hindari session hijacking
    echo "✅ Login berhasil. Selamat datang, $username!";
  } else {
    echo "❌ Password salah.";
  }
} else {
  echo "❌ Username tidak ditemukan.";
}


} 


// function to delete data
if ($_GET["action"] === "logout") {
 
session_start();
session_destroy();
header("Location: /login");
exit;

}
?>