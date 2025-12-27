<?php
// session_start();

// include '../../lib/dbh.inc.php';
ini_set('session.cookie_httponly', 1); // Cegah pencurian session via Javascript (XSS)
ini_set('session.use_only_cookies', 1);
session_start();

include '../../lib/dbh.inc.php';

// Gunakan POST untuk aksi sensitif, bukan GET
$action = $_GET["action"] ?? '';

if ($action === "loginData" && $_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        die("❌ Mohon isi semua kolom.");
    }

    // 2. Prepared Statement (Sudah Bagus)
    $stmt = $koneksi->prepare("SELECT iduser,username,namalengkap, password FROM user WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            
            
            session_regenerate_id(true); 
            
            $_SESSION['user_id'] = $row['iduser'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['nama'] = $row['namalengkap'];
            // $_SESSION['id_opd'] = $row['id_opd'];
            $_SESSION['last_activity'] = time();

            echo "✅ Login berhasil.";
  
            exit;
        }
    }
    
    // 4. Pesan Error Generic (Membingungkan Hacker)
    echo "❌ Username atau Password salah.";
}


// if ($_GET["action"] === "loginData") {
 

// $username = $_POST['username'] ?? '';
// $password = $_POST['password'] ?? '';

// $stmt = $koneksi->prepare("SELECT * FROM user WHERE username = ?");
// $stmt->bind_param("s", $username);
// $stmt->execute();
// $result = $stmt->get_result();

// if ($row = $result->fetch_assoc()) {
//   if (password_verify($password, $row['password'])) {
//     $_SESSION['username'] = $username;
//     session_regenerate_id(); // Hindari session hijacking
//     echo "✅ Login berhasil. Selamat datang, $username!";
//   } else {
//     echo "❌ Password salah.";
//   }
// } else {
//   echo "❌ Username tidak ditemukan.";
// }


// } 


// function to delete data
// if ($_GET["action"] === "logout") {
 
// session_start();
// session_destroy();
// header("Location: /login");
// exit;

// }
if ($action === "logout") {
    // Hapus semua data session secara bersih
    $_SESSION = array();
    session_destroy();
    header("Location: /login");
    exit;
}
?>