<?php
session_start();
$username = $_SESSION['username'];
// echo $username ;
// include '../../../lib/dbh.inc.php';
include '../../../lib/dbh.inc.php';



if ($_GET["action"] === "fetchData") {
    $sql = "SELECT * FROM berita ORDER BY tanggal asc";
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

if ($_GET["action"] === "fetchIsi") {
  $id = $_POST["id"];
  $sql = "SELECT isi as isihalaman FROM berita WHERE id='$id'";
  $result = mysqli_query($koneksi, $sql);
  if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    header("Content-Type: application/json");
    echo json_encode([
      "statusCode" => 200,
      "data" => $data
    ]);
  } else {
    echo json_encode([
      "statusCode" => 404,
      "message" => "No user found with this id 😓"
    ]);
  }
  mysqli_close($koneksi);
}

if ($_GET["action"] === "fetchSingle") {
  $id = $_POST["id"];
  $sql = "SELECT * FROM berita WHERE id='$id'";
  $result = mysqli_query($koneksi, $sql);
  if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    header("Content-Type: application/json");
    echo json_encode([
      "statusCode" => 200,
      "data" => $data
    ]);
  } else {
    echo json_encode([
      "statusCode" => 404,
      "message" => "No user found with this id 😓"
    ]);
  }
  mysqli_close($koneksi);
}


if ($_GET["action"] === "insertData") {
    $user = $_SESSION['username'];
    // if (!empty($_POST["judul_berita"]) && !empty($_POST["isi"]) && !empty($_POST["status"] && !empty($_POST["tanggal"])) != 0) {
    $judul = mysqli_real_escape_string($koneksi, $_POST["judul_berita"]);
    $isi = mysqli_real_escape_string($koneksi, $_POST["isi"]);
    // $isi2 = mysqli_real_escape_string($koneksi, $_POST["artikel"]);

    // $user = mysqli_real_escape_string($koneksi, $_POST["user"]);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST["tanggal"]);
    $status = mysqli_real_escape_string($koneksi, $_POST["status"]);
    // $isi = $_POST["editor1"];

    $name     = $_FILES['filegambar']['name'];
    $masalah  = $_FILES['filegambar']['error'];
    $ukuran   = $_FILES['filegambar']['size'];
    $asal     = $_FILES['filegambar']['tmp_name'];

    if ($asal == "") {
        echo json_encode([
            "statusCode" => 404,
            "message" => "Data gambar masih kosong"
        ]);
    } else {
        move_uploaded_file($asal, "../../imageberita/$name");
        $query  = "INSERT INTO berita(judul_berita,isi,user,tanggal,gambar,status) VALUES('$judul','$isi','$user','$tanggal','$name','$status')";
        $result = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
    }
    if ($result) {
        echo json_encode([
            "statusCode" => 200,
            "message" => "Data Berhasil tersimpan"
        ]);
        header("Location: /admin/berita");
        exit();
    }
}


// function to update data
if ($_GET["action"] === "updateData") {
     $user = $_SESSION['username'];
  $id = $_POST["id"];
  //   if (!empty($_POST["judul"]) && !empty($_POST["isihalaman"]) && !empty($_POST["filegambar"])) {
  // $id = mysqli_real_escape_string($conn, $_POST["id"]);
  $judul = $_POST["judul_berita"];
  $isi = $_POST["isihalaman"];
    $tanggal = $_POST["tanggal"];
  // $gambar = $_POST["filegambar"];
  $status = $_POST["status"];
  
  $original_name = $_FILES['filegambar']['name'];
  // $masalah  = $_FILES['filegambar']['error'];
  $ukuran   = $_FILES['filegambar']['size'];
  $asal     = $_FILES['filegambar']['tmp_name'];
  // $email = mysqli_real_escape_string($conn, $_POST["email"]);
  // $country = mysqli_real_escape_string($conn, $_POST["country"]);
  // $gender = mysqli_real_escape_string($conn, $_POST["gender"]);

  if ($asal == "") {
    $kirim = mysqli_query($koneksi, "UPDATE berita SET judul_berita='$judul', isi='$isi',user='$user',tanggal='$tanggal',status='$status' WHERE id=$id") or die(mysqli_error($koneksi));
  } else {
    $data = mysqli_fetch_array(mysqli_query($koneksi, "select * from berita where id=$id"));
    if ($data['gambar'] != "") unlink("../../imageberita/$data[gambar]");

    $edit = move_uploaded_file($asal, "../../imageberita/$original_name");
    $sql1 = "UPDATE berita SET judul_berita='$judul', isi='$isi', user='$user', gambar='$original_name',status='$status'  WHERE id=$id";
    $kirim = mysqli_query($koneksi, $sql1) or die(mysqli_error($koneksi));
  }

  // if ($_FILES["filegambar"]["size"] != 0) {
  //   // rename the image before saving to database
  //   //   $original_name = $_FILES["filegambar"]["name"];
  //   $new_name = time() . "." . pathinfo($original_name, PATHINFO_EXTENSION);
  //   move_uploaded_file($_FILES["filegambar"]["tmp_name"], "../../imagehalaman" . $new_name);
  //   // remove the old image from uploads directory
  //   unlink("../../imagehalaman/" . $original_name);
  // } else {
  //   $new_name = mysqli_real_escape_string($koneksi, $original_name);
  // }
  // $sql = "UPDATE halaman SET judul='$judul',isi='$isi', gambar='$new_name',nama_link='$nama_link' WHERE id=$id";
  if ($kirim) {
    echo json_encode([
      "statusCode" => 200,
      "message" => "Data updated successfully 😀"
    ]);
     header("Location: /admin/berita");
    exit();
  } else {
    echo json_encode([
      "statusCode" => 500,
      "message" => "Failed to update data 😓"
    ]);
     header("Location: /admin/berita");
    exit();
  }
  mysqli_close($koneksi);
}

// function to delete data
if ($_GET["action"] === "deleteData") {
    $id = $_POST["id"];
    // $delete_image = $_POST["delete_image"];
    $data = mysqli_fetch_array(mysqli_query($koneksi, "select * from berita where id=$id"));
    if ($data['gambar'] != "") unlink("../../imageberita/" . $data['gambar']);
    $sql = "DELETE FROM berita WHERE id=$id";

    if (mysqli_query($koneksi, $sql)) {
        // remove the image
        // unlink("uploads/" . $delete_image);
        echo json_encode([
            "statusCode" => 200,
            "message" => "Data deleted successfully 😀"
        ]);
    } else {
        echo json_encode([
            "statusCode" => 500,
            "message" => "Failed to delete data 😓"
        ]);
    }
}
