<?php
session_start();
$username = $_SESSION['username'];
// include '../../../lib/dbh.inc.php';
include '../../../lib/dbh.inc.php';



if ($_GET["action"] === "fetchData") {
  $sql = "SELECT * FROM halaman ";
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

if ($_GET["action"] === "insertData") {
  // if (!empty($_POST["judul_berita"]) && !empty($_POST["isi"]) && !empty($_POST["status"] && !empty($_POST["tanggal"])) != 0) {
  $judul = mysqli_real_escape_string($koneksi, $_POST["judul"]);
  $isi = mysqli_real_escape_string($koneksi, $_POST["isi"]);
  $nama_link = mysqli_real_escape_string($koneksi, $_POST["nama_link"]);


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
    move_uploaded_file($asal, "../../imagehalaman/$name");
    $query  = "INSERT INTO halaman(judul,isi,gambar,nama_link) VALUES('$judul','$isi','$name','$nama_link')";
    $result = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
  }
  if ($result) {
    echo json_encode([
      "statusCode" => 200,
      "message" => "Data Berhasil tersimpan"
    ]);
    header("Location: /admin/halaman");
    exit();
  }
}


if ($_GET["action"] === "fetchIsi") {
  $id = $_POST["id"];
  $sql = "SELECT isi as isihalaman FROM halaman WHERE id='$id'";
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
  $sql = "SELECT * FROM halaman WHERE id='$id'";
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

// function to update data
if ($_GET["action"] === "updateData") {
  $id = $_POST["id"];
  //   if (!empty($_POST["judul"]) && !empty($_POST["isihalaman"]) && !empty($_POST["filegambar"])) {
  // $id = mysqli_real_escape_string($conn, $_POST["id"]);
  $judul = $_POST["judul"];
  $isi = $_POST["isihalaman"];
  // $gambar = $_POST["filegambar"];
  $nama_link = $_POST["link"];
  
  $original_name = $_FILES['filegambar']['name'];
  // $masalah  = $_FILES['filegambar']['error'];
  $ukuran   = $_FILES['filegambar']['size'];
  $asal     = $_FILES['filegambar']['tmp_name'];
  // $email = mysqli_real_escape_string($conn, $_POST["email"]);
  // $country = mysqli_real_escape_string($conn, $_POST["country"]);
  // $gender = mysqli_real_escape_string($conn, $_POST["gender"]);

  if ($asal == "") {
    $kirim = mysqli_query($koneksi, "UPDATE halaman SET judul='$judul', isi='$isi',nama_link='$nama_link' WHERE id=$id") or die(mysqli_error($koneksi));
  } else {
    $data = mysqli_fetch_array(mysqli_query($koneksi, "select * from halaman where id=$id"));
    if ($data['gambar'] != "") unlink("../../imagehalaman/$data[gambar]");

    $edit = move_uploaded_file($asal, "../../imagehalaman/$original_name");
    $sql1 = "UPDATE halaman SET judul='$judul', isi='$isi', gambar='$original_name', nama_link='$nama_link' WHERE id=$id";
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
     header("Location: /admin/halaman");
    exit();
  } else {
    echo json_encode([
      "statusCode" => 500,
      "message" => "Failed to update data 😓"
    ]);
     header("Location: /admin/halaman");
    exit();
  }
  mysqli_close($koneksi);
}



// function to delete data
if ($_GET["action"] === "deleteData") {
  $id = $_POST["id"];
  // $delete_image = $_POST["delete_image"];
  $data = mysqli_fetch_array(mysqli_query($koneksi, "select * from halaman where id=$id"));
  if ($data['gambar'] != "") unlink("../../imagehalaman/" . $data['gambar']);
  $sql = "DELETE FROM halaman WHERE id=$id";

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
